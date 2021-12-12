<?php

namespace App\Http\Controllers;

use App\Models\Servicing;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

// $this_week = Servicing::where('created_at','like', '%'.$some.'%')->get();
class DeshboardController extends Controller
{
    public function index() {
        $servicing_this_month = array();
        $servicing = DB::table('servicings')->get();

        foreach ($servicing as $key => $value) {
            $monthNum = date('m', strtotime($value->created_at));
            if ($monthNum == date('m')) {
                array_push($servicing_this_month, $value);
            }
        }

        $sell_this_month = array();
        $sell = DB::table('orders')->get();
        foreach ($sell as $key => $value) {
            $monthNum = date('m', strtotime($value->created_at));
            if ($monthNum == date('m')) {
                array_push($sell_this_month, $value);
            }
        }
        // print_r(date('m', strtotime('2020-12-4')));
        $customer = DB::table('customers')->get();
        $order = DB::table('orders')->get();
        $data = [
            'deshboard_active'=> 'active',
            'servicing' => $servicing,
            'servicing_this_month' => $servicing_this_month,
            'customer' => $customer,
            'order' => $order,
            'sell_this_month' => $sell_this_month
        ];
        return view('deshboard.deshboard', $data);
    }
}
