<?php

namespace App\Http\Controllers\Front;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Traits\InvoiceTrait;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CheckoutController extends Controller
{
    use InvoiceTrait;
    //
    public function index()
    {
        $cartItems = Cart::content();
        
        $Cart = new \stdClass();
        $Cart->total = Cart::total();
        $Cart->count = Cart::count();
        $Cart->subtotal = Cart::subtotal();
        $Cart->tax = Cart::tax();
        $Cart->discount = 0;


        if ($cartItems->count() == 0) {
            return redirect()->route('cart.store')->with('error', 'Your cart is empty');
        }

        if (auth()->check()) {
            $user = auth()->user();
            return view('front.checkout', compact('Cart', 'cartItems', 'user'));
        }
    

        return view('front.checkout', compact('Cart','cartItems'));
    }

    public function store(OrderRequest $request){

        if(auth()->check()){

            // $address = auth()->user()->addresses()->create([
            //     'address' => $request->shipping_address,
            //     'city' => $request->shipping_city,
            //     'phone' => $request->shipping_phone,
            //     'fullname' => $request->shipping_fullname,
            // ]);

            $order = Order::create([
            'costumer_id' => auth()->user()->id,
            'total' => str_replace(',', '', Cart::total()),
            'status' => 'pending',
            'payment_method' => $request->pay_method,
            'payment_status' => 'pending',
            'shipping_fullname' => $request->name,
            'shipping_method' => $request->chip_method,
            'shipping_address' => $request->address,
            'shipping_city' => $request->wilaya,
            'shipping_municipality' => $request->municipality,
            'shipping_phone' => $request->phone,
            'shipping_email' => $request->email,
            'shipping_status' => 'pending',
        ]);

        $this->decreaseStock();

        return response()->json([
            'message' => 'Order has been placed successfully',
            'url' => '/invoice/'.$order->ord_id,	
        ]);


        }

        else {
            $order = Order::create([
                'costumer_id' => 0,
                'total' => str_replace(',', '', Cart::total()),
                'status' => 'pending',
                'payment_method' => $request->pay_method,
                'payment_status' => 'pending',
                'shipping_fullname' => $request->name,
                'shipping_method' => $request->chip_method,
                'shipping_address' => $request->address,
                'shipping_city' => $request->wilaya,
                'shipping_municipality' => $request->municipality,
                'shipping_phone' => $request->phone,
                'shipping_email' => $request->email,
                'shipping_status' => 'pending',
            ]);

            if(!$order){
                return response()->json([
                    'message' => 'Order has not been placed',
                ]);
            }

            $this->decreaseStock();

            return response()->json([
                'message' => 'Order has been placed successfully',
                'url' => '/invoice/'.$order->ord_id,
            ]);


        }
   }

    private function decreaseStock() {
        $cartItems = Cart::content();
        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            if ($product) {
                $product->stock -= $item->qty;
                $product->save();
            }
        }
    }

    public function invoice($ord_id){

        $order = Order::find($ord_id);
        if(!$order){
            return redirect()->route('checkout.index')->with('error', 'Order not found');
        }

       $invoice = $this->newInvoice($order);

       if($invoice == false){
           return redirect()->route('checkout.index')->with('error', 'Invoice not generated');
       }

       $invoiceTable = \App\Models\Invoice::create([
           'inv_order_id' => $order->ord_id,
           'inv_costumer_id' => $order->costumer_id,
            'inv_path' => 'invoice_'.$invoice->getSerialNumber().'.pdf',
         ]);

        $invoice->save('invoices');

        Cart::destroy();
                  
        return redirect()->route('index')->with('success', 'Order has been created successfully');
    }
}
