<?php 

namespace App\Traits;

use App\Models\Store;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Seller;
use LaravelDaily\Invoices\Facades\Invoice;

Trait InvoiceTrait {

   function newInvoice($order){

      $costumer = $order->shipping_fullname;
      $shipping = new \stdClass();
      $shipping->fullname = $order->shipping_fullname;
      $shipping->address = $order->shipping_address;
      $shipping->city = $order->shipping_city;
      $shipping->municipality = $order->shipping_municipality;
      $shipping->phone = $order->shipping_phone;
      $shipping->email = $order->shipping_email;


      $cartItems = Cart::content();
      $Cart = new \stdClass();
      $Cart->total = Cart::total();
      $Cart->count = Cart::count();
      $Cart->subtotal = Cart::subtotal();
      $Cart->tax = Cart::tax();
      $Cart->discount = 0;

        $data = [
          'order' => $order,
          'costumer' => $costumer,
          'shipping' => $shipping,
          'cartItems' => $cartItems,
          'Cart' => $Cart,
          ];
       

          $customer = new Buyer([
              'name'          => $costumer,
              'custom_fields' => [
                  'email' => $shipping->email,
                  'phone' => $shipping->phone,
                  'address' => $shipping->address,
                  'city' => $shipping->city,
                  'municipality' => $shipping->municipality,
              ],
          ]);

          $store = Store::find(1);

          $seller = new Seller();
          $seller->name = $store->name;
          $seller->address = $store->address;
            $seller->phone = $store->phone;
            // $seller->vat = $store->vat;
            // $seller->custom_fields = [
            //     'SWIFT' => $store->swift,
            // ];

          $invoice = Invoice::make()
              ->buyer($customer)
              ->seller($seller)
              ->discountByPercent($Cart->discount)
              ->taxRate($Cart->tax)
              ->shipping(0);

          // $invoiceTb = \App\Models\Invoice::create([
          // ]);

          // generate a serial number


          $serialCode = $this->RandomSerial($order->ord_id);
          


          foreach ($cartItems as $item) {
              $invoiceItem = (new InvoiceItem())
                  ->title($item->name)
                  ->pricePerUnit($item->price)
                  ->quantity($item->qty);

              $invoice->addItem($invoiceItem);
          }

          // search for the order_id in the invoices table

          $invoice_exist = \App\Models\Invoice::where('inv_order_id', $order->ord_id)->first();

            if($invoice_exist){
                return false;
            }

            $invoice->serialNumberFormat($serialCode)
                       ->filename('invoice_'.$serialCode)
                       ->save('invoices');
                   

          
          return $invoice;

   }
   function RandomSerial($order_id) {
       $serial = date("Ymd").'_'.$order_id;
      return $serial;
   }

}