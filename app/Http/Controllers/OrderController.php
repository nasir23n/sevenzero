<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Order $order) {
        $info = Customer::find($order->customer_id);
        $data = [
            'info' => $info,
            'order' => $order,
            'sell' => $order->sell
        ];
        return view('order.view', $data);
    }
    public function update(Order $order, Request $request) {
        $order->update([
            'paid' => ($request->paid) ? $request->paid : 0,
            'combo_disc' => ($request->combo_disc) ? $request->combo_disc : 0,
            'referrer' => ($request->referrer) ? $request->referrer : '',
            'varifide_by' => ($request->varifide_by) ? $request->varifide_by : '',
            'done' => ($request->done) ? 1 : 0,
        ]);
        return redirect('order/'.$order->id.'/view')->with('success', 'Order updated successfully');
    }
    public function delete(Order $order, Request $request) {
        $order->delete();
        return redirect('customer/'.$order->customer_id.'/sell')->with('sell_delete', 'Order deleted successfully');
    }
    public function print(Order $order) {
        $info = Customer::find($order->customer_id);
        $data = [
            'info' => $info,
            'order' => $order,
            'sell' => $order->sell
        ];
        return view('order.print', $data);
    }
    public function new_order(Customer $customer) {
        $customer->order()->create([
            'paid' => 0,
            'combo_disc' => 0,
            'referrer' => '',
            'varifide_by' => '',
            'done' => 0,
        ]);
        $latest = $customer->order()->latest()->first();
        return redirect('order/'.$latest->id.'/view');
    }
}
