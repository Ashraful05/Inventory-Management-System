<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Category;
use App\Supplier;
use App\Unit;
use App\Purchase;
use App\Invoice;
use App\InvoiceDetail;
use App\Payment;
use App\PaymentDetail;
use App\Customer;
use DB;
use PDF;

class InvoiceController extends Controller
{
    public function addInvoice(){
        $customers = Customer::all();
        $categories = Category::all();
        $date = date('d-m-Y');
        $invoice = Invoice::orderBy('id','desc')->first();
        if($invoice==null){
            $firstRegistration = '0';
//            $data['invoiceNumber'] = $firstRegistration+1;
            $invoiceNumber = $firstRegistration  + 1;
        }else{
            $invoice = Invoice::orderBy('id','desc')->first()->invoice_no;
//            $data['invoiceNumber'] = $invoice+1;
            $invoiceNumber = $invoice + 1;
        }
        return view('back-end.invoice.add-invoice',[
            'invoiceNumber'=>$invoiceNumber,
            'categories'   =>$categories,
            'customers'   =>$customers,
            'date'        =>$date
        ]);
    }
    public function saveInvoice(Request $request){
//        return $request->all();
        if($request->category_id == null){
            return redirect()->back()->with('message','Please select a product!!!');
        }else {
            if($request->paid_amount > $request->estimated_amount){
                return redirect()->back()->with('message','Check Paid amount is more than total amount!!!');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::User()->id;
                DB::transaction(function() use($request,$invoice){
                    if($invoice->save()){
                        $countCategory = count($request->category_id);
                        for($i=0;$i<$countCategory;$i++){
                            $invoiceDetails = new InvoiceDetail();
                            $invoiceDetails->date = date('y-m-d',strtotime($request->date));
                            $invoiceDetails->invoice_id = $invoice->id;
                            $invoiceDetails->category_id = $request->category_id[$i];
                            $invoiceDetails->product_id  = $request->product_id[$i];
                            $invoiceDetails->selling_quantity = $request->selling_quantity[$i];
                            $invoiceDetails->unit_price = $request->unit_price[$i];
                            $invoiceDetails->selling_price = $request->selling_price[$i];
                            $invoiceDetails->status = '0';
                            $invoiceDetails->save();
                        }
                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;

                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = new Payment();
                        $paymentDetails = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $paymentDetails->current_paid_amount = $request->estimated_amount;
                        }elseif($request->paid_status=='full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $paymentDetails->current_paid_amount = '0';
                        }elseif($request->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $paymentDetails->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $paymentDetails->invoice_id = $invoice->id;
                        $paymentDetails->date = date('y-m-d',strtotime($request->date));
                        $paymentDetails->save();

                    }
                });

            }
        }
        return redirect()->route('pending-invoice')->with('message','Information saved successfully!!!');

    }
    public function viewInvoice(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id', 'desc')->where('status','1')->get();
        return view('back-end.invoice.pending-invoice',['invoices'=>$invoices]);

    }
    public function deleteInvoice($id){
        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        return redirect()->route('pending-invoice')->with('message','Your Information deleted successfully!!!');
    }
    public function pendingInvoice(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id', 'desc')->where('status','0')->get();
        return view('back-end.invoice.pending-invoice',['invoices'=>$invoices]);
    }
    public function approveInvoice($id){
        $invoice = Invoice::with(['InvoiceDetails'])->find($id);
        return view('back-end.invoice.approve-invoice',['invoice'=>$invoice]);
    }
    public function saveApproval(Request $request,$id){
        foreach($request->selling_quantity as $key => $value){
            $invoiceDetails = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoiceDetails->product_id)->first();
            if($product->quantity < $request->selling_quantity[$key]){
                return redirect()->back()->with('message','Sorry| you approve maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::User()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach ($request->selling_quantity as $key => $value){
                $invoiceDetails = InvoiceDetail::where('id',$key)->first();
                $invoiceDetails->status = '1';
                $invoiceDetails->save();
                $product = Product::where('id',$invoiceDetails->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_quantity[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('pending-invoice')->with('message','Invoice Successfully approved!!!');

    }
    public function printInvoiceList(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id', 'desc')->where('status','1')->get();
        return view('back-end.invoice.print-invoice',['invoices'=>$invoices]);
    }

    public function printInvoice($id) {
        $invoice = Invoice::with(['InvoiceDetails'])->find($id);
        $pdf = PDF::loadView('back-end.pdf.invoice-pdf',['invoice'=> $invoice]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function dailyInvoiceReport(){
        $date = date('d-m-Y');
        return view('back-end.invoice.daily-invoice-report',['date'=>$date]);
    }
    public function dailyInvoiceReportPdf(Request $request){
        $startDate = date('Y-m-d',strtotime($request->start_date));
        $endDate   = date('Y-m-d',strtotime($request->end_date));
        $reports = Invoice::whereBetween('date',[$startDate,$endDate])->where('status',1)->get();
        $pdf = PDF::loadView('back-end.pdf.daily-invoice-report-pdf',[
            'reports'=>$reports,
            'startDate' => $startDate,
            'endDate'  => $endDate
            ]);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
