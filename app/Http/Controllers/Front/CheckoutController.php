<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Account;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TomatoPHP\FilamentEcommerce\Models\Order;
use TomatoPHP\FilamentEcommerce\Models\OrdersItem;
use TomatoPHP\FilamentEcommerce\Models\Branch;
// use App\Mail\NewOrderAdminNotification;
// use App\Models\User;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    // ─── Show Checkout Page ───────────────────────────────────────
    public function index()
    {
        $cartItems = Cart::content();

        $Cart            = new \stdClass();
        $Cart->total     = Cart::total();
        $Cart->count     = Cart::count();
        $Cart->subtotal  = Cart::subtotal();
        $Cart->tax       = Cart::tax();
        $Cart->discount  = 0;

        if ($cartItems->count() == 0) {
            return redirect()->route('cart.store')->with('error', 'Your cart is empty');
        }

        if (auth()->check()) {
            $user = auth()->user();
            return view('front.checkout', compact('Cart', 'cartItems', 'user'));
        }

        return view('front.checkout', compact('Cart', 'cartItems'));
    }

    // ─── Place Order ─────────────────────────────────────────────
    public function store(OrderRequest $request)
    {
        // Resolve the guest/walk-in account used for online orders
        $account = Account::firstOrCreate(
            ['username' => 'online-guest'],
            [
                'name'      => 'Online Guest',
                'type'      => 'account',
                'is_active' => true,
                'loginBy'   => 'email',
            ]
        );

        // Use the first (or only) branch
        $branch = Branch::first();
        if (! $branch) {
            return response()->json([
                'message' => 'No branch configured. Please create a branch in the admin panel first.',
            ], 500);
        }

        // Parse the total (remove commas injected by the cart package)
        $total = (float) str_replace(',', '', Cart::total());

        // Build the flat address note
        $addressNote = implode(', ', array_filter([
            $request->address,
            $request->municipality,
            $request->wilaya,
        ]));

        // Create the order in the Filament/POS orders table
        $order = Order::create([
            'uuid'           => Str::uuid(),
            'account_id'     => $account->id,
            'branch_id'      => $branch->id,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $addressNote,
            'source'         => 'website',
            'type'           => 'delivery',
            'total'          => $total,
            'discount'       => 0,
            'shipping'       => 0,
            'vat'            => 0,
            'status'         => 'pending',
            'is_approved'    => false,
            'is_closed'      => false,
            'is_payed'       => false,
            'payment_method' => $request->pay_method,
            'notes'          => 'Shipping: ' . $request->chip_method
                                . ($request->email ? ' | Email: ' . $request->email : ''),
        ]);

        // Save each cart line as an orders_item
        foreach (Cart::content() as $item) {
            OrdersItem::create([
                'order_id'   => $order->id,
                'account_id' => $account->id,
                'product_id' => $item->id,
                'item'       => $item->name,
                'price'      => (float) $item->price,
                'discount'   => 0,
                'vat'        => 0,
                'total'      => (float) $item->subtotal,
                'qty'        => $item->qty,
            ]);
        }

        // Decrease product stock
        $this->decreaseStock();

        // Clear cart
        Cart::destroy();

        // Send Email Notification to Admin
        // try {
        //     $adminEmail = setting('site_email')
        //         ?: (User::first()?->email ?: config('mail.from.address'));

        //     if ($adminEmail) {
        //         Mail::to($adminEmail)->send(new NewOrderAdminNotification($order));
        //     }
        // } catch (\Exception $e) {
        //     Log::error('Failed to send admin order notification email: ' . $e->getMessage());
        // }

        return response()->json([
            'message' => 'Order placed successfully!',
            'url'     => route('index'),
            'order_id'=> $order->id,
        ]);
    }

    // ─── Decrease Stock After Order ───────────────────────────────
    private function decreaseStock(): void
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            if ($product && isset($product->attributes['stock'])) {
                // Only decrease if the column exists on this model
                try {
                    \Illuminate\Support\Facades\DB::table('products')
                        ->where('id', $item->id)
                        ->decrement('stock', $item->qty);
                } catch (\Exception $e) {
                    // stock column may not exist — silently skip
                }
            }
        }
    }

    // ─── Legacy Invoice Route (kept for backward-compat) ─────────
    public function invoice($id)
    {
        $order = Order::find($id);
        if (! $order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found');
        }

        return redirect()->route('index')->with('success', 'Order #' . $order->id . ' confirmed. Thank you!');
    }
}
