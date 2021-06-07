<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Category;
use App\Supplier;
use App\Unit;
use App\Purchase;
use DB;
use PDF;

class PurchaseController extends Controller
{
    public function addPurchase(){
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units     = Unit::all();
        return view('back-end.purchase.add-purchase',[
            'suppliers'=>$suppliers,
            'categories'=>$categories,
            'units'    =>$units
        ]);
    }
    public function savePurchase(Request $request){
        if($request->category_id==null){
            return redirect()->back()->with('message','Please select an item!!!');
        }else{
            $countCategory = count($request->category_id);
            for($i=0; $i<$countCategory; $i++){
                $purchase = new Purchase();
                $purchase->date = date('y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_quantity   = $request->buying_quantity[$i];
                $purchase->buying_price  = $request->buying_price[$i];
                $purchase->unit_price  = $request->unit_price[$i];
                $purchase->description  = $request->description[$i];
                $purchase->created_by   = Auth::User()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }
        return redirect()->route('view-purchase')->with('message','Information saved successfully!!!');

    }
    public function viewPurchase(){
        $purchases = Purchase::orderBy('date','desc')->orderBy('id', 'desc')->get();
        return view('back-end.purchase.view-purchase',['purchases'=>$purchases]);

    }
    public function editPurchase($id){

    }
    public function updatePurchase(Request $request){

    }
    public function deletePurchase($id){
        $purchase = Purchase::find($id);
        $purchase->delete();
        return redirect()->route('view-purchase')->with('message','Your Information deleted successfully!!!');
    }
    public function pendingPurchase(){
        $purchases = Purchase::orderBy('date','desc')->orderBy('id', 'desc')->where('status','0')->get();
        return view('back-end.purchase.view-approval',['purchases'=>$purchases]);
    }
    public function approvePurchase($id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_quantity = ((float)($purchase->buying_quantity)) + ((float)($product->quantity));
        $product->quantity = $purchase_quantity;
        if($product->save()){
            DB::table('purchases')->where('id',$id)->update(['status' => 1]);
        }
        return redirect('purchase/pending')->with('message',"Purchase has been approved");
    }
    public function dailyPurchase(){
        return view('back-end.purchase.daily-purchase-report');
    }
    public function dailyPurchasePDF(Request $request){
        $startDate = date('Y-m-d',strtotime($request->start_date));
        $endDate   = date('Y-m-d',strtotime($request->end_date));
        $reports = Purchase::whereBetween('date',[$startDate,$endDate])->where('status','1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $pdf = PDF::loadView('back-end.pdf.daily-purchase-report-pdf',[
            'reports'=>$reports,
            'startDate' => $startDate,
            'endDate'  => $endDate
        ]);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
