<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function take(Order $order) {
        $data = [
            'order' => $order
        ];
        return view('order.take', $data);
    }
    public function update_form(Sell $sell) {
        $data = [
            'sell' => $sell
        ];
        return view('order.update_form', $data);
    }
    public function update(Sell $sell, Request $request) {
        $sell->update([
            'product_name' => $request->product_name,
            'unit_price' => $request->unit_price,
            'quantity' => ($request->quantity) ? $request->quantity : 1,
            'discount' => ($request->discount) ? $request->discount : 0,
            'warranty' => ($request->warranty) ? $request->warranty : 'N/A',
        ]);
        return redirect('order/'.$sell->order_id.'/view')->with('success', 'Product updated successfully');
    }
    public function delete(Sell $sell) {
        $sell->delete();
        return back()->with('danger', 'Product deleted successfully');
    }
    public function add(Order $order, Request $request) {
        $order->sell()->create([
            'product_name' => $request->product_name,
            'unit_price' => $request->unit_price,
            'quantity' => ($request->quantity) ? $request->quantity : 1,
            'discount' => ($request->discount) ? $request->discount : 0,
            'warranty' => ($request->warranty) ? $request->warranty : 'N/A',
        ]);
        return redirect('order/'.$order->id.'/view')->with('product_add_status', 'Product added successfully');
    }
    public function all_togather() {
        $orders = DB::table('orders')->paginate(20);
        $data = [
            'sell_active' => 'active',
            'orders' => $orders,
        ];
        return view('sell.all_togather', $data);
    }
}
