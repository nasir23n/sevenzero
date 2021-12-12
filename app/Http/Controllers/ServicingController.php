<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Servicing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicingController extends Controller
{
    public function add_servicing($id) {
        $info = Customer::find(['id'=>$id])->first();
        $data = [
            'info' => $info
        ];
        return view('servicing.add_servicing', $data);
    }
    public function servicing_details($id) {
        $servicing = Servicing::find(['id' => $id])->first();
        $info = Customer::find(['id'=>$servicing->customer_id])->first();
        $data = [
            'info' => $info,
            'servicing' => $servicing
        ];
        return view('servicing.servicing_details', $data);
    }
    public function details_from_all($id) {
        $servicing = Servicing::find(['id' => $id])->first();
        $info = Customer::find(['id'=>$servicing->customer_id])->first();
        $data = [
            'info' => $info,
            'servicing' => $servicing
        ];
        return view('servicing.details_from_all', $data);
    }
    public function add_process(Customer $customer, Request $request) {
        $customer->servicing()->create([
            'title' => $request->title,
            'description' => ($request->description) ? $request->description : '',
            'charge' => ($request->charge) ? $request->charge : 0,
            'paid' => ($request->paid) ? $request->paid : 0,
        ]);
        return redirect('customer/'.$customer->id.'/servicing')->with('servicing_add', 'Servicing created successfully!');
    }
    public function servicing_update(Servicing $servicing , Request $request) {
        $servicing->update([
            'title' => $request->title,
            'description' => ($request->description) ? $request->description : '',
            'charge' => ($request->charge) ? $request->charge : 0,
            'paid' => ($request->paid) ? $request->paid : 0,
            'done' => ($request->done) ? 1 : 0
        ]);
        return back()->with('servicing_update', 'Servicing updated successfully!');
    }
    public function servicing_delete(Servicing $servicing) {
        $servicing->delete();
        return back()->with('servicing_delete', 'Servicing deleted successfully!');
    }
    public function all_togather() {
        $servicing = Servicing::latest()->paginate(20);
        $data = [
            'servicing_active' => 'active',
            'servicing' => $servicing
        ];
        return view('servicing.all_togather', $data);
    }
}
