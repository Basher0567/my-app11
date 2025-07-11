<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use DB;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function InvoiceListPage(Request $request){
        $user_id=$request->header('user_id');
        $list=Invoice::where('user_id',$user_id)->with('customer','invoiceProduct.product')->get();
        return Inertia::render('InvoiceListPage',['list'=>$list]);
        //return $list;
    }
    public function InvoiceCreate(Request $request){
        DB::beginTransaction();
        try{
            $user_id=$request->header('user_id');
            $total=$request->input('total');
            $discount=$request->input('discount');
            $vat=$request->input('vat');
            $payable=$request->input('payable');
            $customer_id=$request->input('customer_id');
            $Invoice=Invoice::create([
                'total'=>$total,
                'discount'=>$discount,
                'vat'=>$vat,
                'payable'=>$payable,
                'user_id'=>$user_id,
                'customer_id'=>$customer_id
            ]);
            $InvoiceId=$Invoice->id;
            $products=$request->input('products');
            foreach($products as $EachProduct){
                InvoiceProduct::create([
                    'invoice_id'=>$InvoiceId,
                    'user_id'=>$user_id,
                    'product_id'=>$EachProduct['product_id'],
                    'qty'=>$EachProduct['qty'],
                    'sale_price'=>$EachProduct['sale_price']
                ]);
            }
            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollBack();
            return 0;
        }
    }

    public function InvoiceSelect(Request $request){
        $user_id=$request->header('user_id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }

    public function InvoiceDetails(Request $request){
        $user_id=$request->header('user_id');
        $customerDetails=Customer::where('user_id',$user_id)->where('id',$request->input('customer_id'))->first();
        $invoiceTotals=Invoice::where('user_id',$user_id)->where('id',$request->input('invoice_id'))->first();
        $invoiceProduct=InvoiceProduct::where('invoice_id',$request->input('invoice_id'))->where('user_id',$user_id)->with('product')->get();
        return array(
            'customer'=>$customerDetails,
            'invoice'=>$invoiceTotals,
            'product'=>$invoiceProduct
        );
    }

    public function InvoiceDelete(Request $request){
        DB::beginTransaction();
        try{
            $user_id=$request->header('user_id');
            $invoice_id=$request->id;
            InvoiceProduct::where('invoice_id',$request->input('invoice_id'))->where('user_id',$user_id)->delete();
            Invoice::where('id',$invoice_id)->delete();
            DB::commit();
            //return 1;
            $data=['message'=>'Invoice Delete Successful','status'=>true,'error'=>''];
            return redirect()->route('InvoiceListPage')->with($data);
        }catch(Exception $e){
            DB::rollBack();
            $data=['message'=>'Invoice Delete not Successful','status'=>false,'error'=>$e->getMessage()];
            return redirect()->route('InvoiceListPage')->with($data);
            //return 0;
        }
    }
}
