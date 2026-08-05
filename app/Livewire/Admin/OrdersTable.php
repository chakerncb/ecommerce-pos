<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Rawilk\Printing\Printing;

class OrdersTable extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $listeners = ['orderStatusUpdated' => 'render'];
    public $status = 'pending';
    public $searchContent = '';
    public $orderStatus = [];

    public $start = 1;

    public function filterByStatus()
    {
        $this->resetPage();
        $this->dispatch('orderStatusUpdated');
    }

    public function search()
    {
        $this->resetPage();
        $this->dispatch('orderStatusUpdated');
    }

    public function updateOrderStatus($order_id)
    {
        $status = $this->orderStatus[$order_id] ?? null;
        if ($status) {
            $order = Order::find($order_id);
            $order->status = $status;
            $order->save();
            $this->alert('success', 'Order status updated successfully');
            $this->dispatch('orderStatusUpdated');
        }
    }

    public function deleteOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->delete();
            $this->alert('success', 'Order deleted successfully');
            $this->dispatch('orderStatusUpdated');
        }
    }

    public function streamPdf($order_id)
    {

        $invoice = Invoice::select(
            'inv_path',
            'inv_order_id',
        )->where('inv_order_id', $order_id)->first();

        if ($invoice) {
            // return response()->file(storage_path("app/invoices/{$invoice->inv_path}"), [
            //     'Content-Type' => 'application/pdf',
            //     'Content-Disposition' => "inline; filename=\"{$invoice->inv_path}\"",
            //     'Target' => '_blank'
            // ]);

            redirect()->route('invoice.print',$invoice->inv_path);

        } else {
            // session()->flash('error', 'Invoice not found');
            $this->alert('error', 'Invoice not found');
        }


    }

    public function render()
    {
        $query = Order::select([
            'ord_id',
            'costumer_id',
            'total',
            'status',
            'payment_method',
            'payment_status',
            'shipping_fullname',
            'shipping_address',
            'shipping_city',
            'shipping_municipality',
            'shipping_phone',
            'shipping_email',
            'shipping_method',
            'shipping_status',
            'created_at'
        ]);

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        if ($this->searchContent) {
            $query->where('shipping_fullname', 'like', '%' . $this->searchContent . '%');
        }

        $subsetOrders = $query->simplePaginate(10);
        foreach ($subsetOrders as $order) {
            $this->orderStatus[$order->ord_id] = $order->status;
        }

        return view('livewire.admin.orders-table', compact('subsetOrders'));
    }

}
