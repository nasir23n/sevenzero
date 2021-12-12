<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Servicing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CustomerController extends Controller
{
    public function add(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:customers'
        ]);
        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => ($request->address) ? $request->address : '',
            'email' => ($request->email) ? $request->email : ''
        ]);
        return back()->with('status', 'User created successfully');
    }
    public function update(Customer $customer, Request $request) {
        $customer->update([
            'name' => ($request->name) ? $request->name : $customer->name,
            'phone' => ($request->phone) ? $request->phone : $customer->phone,
            'address' => ($request->address) ? $request->address : $customer->address,
            'email' => ($request->email) ? $request->email : $customer->email,
        ]);
        return back()->with('status', 'User updated successfully');
    }
    public function all() {
        $customers = Customer::latest()->paginate(20);
        $data = [
            'customer_active' => 'active',
            'customer_all_active' => 'active',
            'customers' => $customers
        ];
        return view('customer.all', $data);
    }
    public function servicing_view(Customer $customer) {
        $servicing = Servicing::where(['customer_id' => $customer->id])->latest()->get();
        $data = [
            'info' => $customer,
            'servicing' => $servicing
        ];
        return view('servicing.servicing', $data);
    }
    public function sell_view(Customer $customer) {
        $orders = Order::where(['customer_id' => $customer->id])->latest()->get();
        $data = [
            'info' => $customer,
            'orders' => $orders
        ];
        return view('servicing.sell', $data);
    }
    public function profile(Customer $customer) {
        $data = [
            'info' => $customer
        ];
        return view('customer.profile', $data);
    }
}
