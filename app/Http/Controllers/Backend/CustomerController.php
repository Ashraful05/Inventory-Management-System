<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Customer;
use App\InvoiceDetail;
use App\Payment;
use App\PaymentDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use PDF;

class CustomerController extends Controller
{
    public function addCustomer(){
        return view('back-end.customer.add-customer');
    }
    public function saveCustomer(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->publication_status=$request->publication_status;
        $customer->created_by=Auth::User()->id;
        $customer->save();
        return redirect()->route('view-customer')->with('message','Customer Information has been added successfully!!!');
    }
    public function viewCustomer(){
        $customers = Customer::all();
//        dd($customers);
        return view('back-end.customer.view-customer',['customers'=>$customers]);
    }
    public function editCustomer($id){
        $editCustomer = Customer::find($id);
//        dd($customer);
        return view('back-end.customer.edit-Customer',['editCustomer'=>$editCustomer]);
    }
    public function updateCustomer(Request $request){
        $customer=Customer::find($request->customer_id);
        $customer->name = $request->name;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->mobile_no=$request->mobile_no;
        $customer->updated_by=Auth::User()->id;
        $customer->update();
        return redirect()->route('view-customer')->with('message','Customer Information updated successfully!!!');
    }
    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('customers/view')->with('message', 'Customer Information deleted successfully!!!');
    }
    public function creditCustomer(){
        $payments = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $customer = Customer::all();
//        return $payments;
        return view('back-end.customer.credit-customer',[
            'payments' => $payments,
            'customer' => $customer
        ]);
    }
    public function editCreditCustomer($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        $invoiceDetails = InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
        return view('back-end.customer.edit-credit-customer',[
            'payment'=>$payment,
            'invoiceDetails' => $invoiceDetails
        ]);
    }
    public function updateCreditCustomer(Request $request,$invoice_id){
//        return $request->all();
        if($request->recent_paid_amount < $request->paid_amount){
            return redirect()->back()->with('message','You have entered maximum amount');
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $paymentDetails = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->payment_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->recent_paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->recent_paid_amount;
            }elseif($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $paymentDetails->invoice_id = $invoice_id;
            $paymentDetails->date = date('Y-m-d',strtotime($request->date));
            $paymentDetails->updated_by = Auth::User()->id;
            $paymentDetails->save();
            return redirect()->route('credit-customer')->with('message','Credit Information updated successfully!!!');
        }

    }

    public function customerReportPDF(){
        $payments = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('back-end.pdf.customer-credit-report-pdf',['payments'=>$payments]);
        $pdf->setProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function invoiceDetailsPDF($invoice_id) {
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        $invoiceDetails = InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
        $paymentDetails = PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
        $pdf = PDF::loadView('back-end.pdf.invoice-details-pdf',[
            'payment'=>$payment,
            'invoiceDetails' => $invoiceDetails,
            'paymentDetails' => $paymentDetails
            ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function paidCustomer(){
        $payments = Payment::where('paid_status','!=','full_due')->get();
        $customer = Customer::all();
//        return $payments;
        return view('back-end.customer.paid-customer',[
            'payments' => $payments,
            'customer' => $customer
        ]);
    }
    public function paidCustomerPDF(){
        $payments = Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('back-end.pdf.customer-paid-report-pdf',['payments'=>$payments]);
        $pdf->setProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWiseReport(){
        $customers = Customer::all();
        return view('back-end.customer.customer-wise-report',['customers'=>$customers]);
    }
    public function customerWiseCreditReportPDF(Request $request){
        $credits = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('back-end.pdf.customer-wise-credit-report-pdf',['credits'=>$credits]);
        $pdf->setProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWisePaidReportPDF(Request $request){
        $paids = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('back-end.pdf.customer-wise-paid-report-pdf',['paids'=>$paids]);
        $pdf->setProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
