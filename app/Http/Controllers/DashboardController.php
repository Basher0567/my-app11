<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function DashboardPage(Request $request){
        $user_id = $request->header('user_id');
        $Product=Product::where('user_id',$user_id)->count();
        //dd($Product);
        $Category=Category::where('user_id',$user_id)->count();
        $Customer=Customer::where('user_id',$user_id)->count();
        $Invoice=Invoice::where('user_id',$user_id)->count();
        $total=Invoice::where('user_id',$user_id)->sum('total');
        $vat=Invoice::where('user_id',$user_id)->sum('vat');
        $payable=Invoice::where('user_id',$user_id)->sum('payable');
        $data=[
            'product'=>$Product,
            'category'=>$Category,
            'customer'=>$Customer,
            'invoice'=>$Invoice,
            'total'=>round($total,2),
            'vat'=>round($vat,2),
            'payable'=>round($payable,2)
        ];
        return Inertia::render('DashboardPage',['list'=>$data]);
    }
    public function Summary(Request $request){
        /*$user_id=$request->header('id');
        $Product=Product::where('user_id',$user_id)->count();
        $Category=Category::where('user_id',$user_id)->count();
        $Customer=Customer::where('user_id',$user_id)->count();
        $Invoice=Invoice::where('user_id',$user_id)->count();
        $total=Invoice::where('user_id',$user_id)->sum('total');
        $vat=Invoice::where('user_id',$user_id)->sum('vat');
        $payable=Invoice::where('user_id',$user_id)->sum('payable');
        return[
            'product'=>$Product,
            'category'=>$Category,
            'customer'=>$Customer,
            'invoice'=>$Invoice,
            'total'=>round($total,2),
            'vat'=>round($vat,2),
            'payable'=>round($payable,2)
        ];*/
    }
}
