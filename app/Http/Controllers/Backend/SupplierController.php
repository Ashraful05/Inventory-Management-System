<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Auth;

class SupplierController extends Controller
{
    public function addSupplier(){
        return view('back-end.supplier.add-supplier');
    }
    public function saveSupplier(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
        ]);
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email=$request->email;
        $supplier->address=$request->address;
        $supplier->publication_status=$request->publication_status;
        $supplier->created_by=Auth::User()->id;
        $supplier->save();
        return redirect()->route('view-supplier')->with('message','Supplier Information has been added successfully!!!');
    }
    public function viewSupplier(){
        $suppliers = Supplier::all();
        return view('back-end.supplier.view-supplier',['suppliers'=>$suppliers]);
    }
    public function editSupplier($id){
        $editSupplier = Supplier::find($id);
//        dd($supplier);
        return view('back-end.supplier.edit-supplier',['editSupplier'=>$editSupplier]);
    }
    public function updateSupplier(Request $request){
        $supplier=Supplier::find($request->supplier_id);
        $supplier->name = $request->name;
        $supplier->email=$request->email;
        $supplier->address=$request->address;
        $supplier->mobile_no=$request->mobile_no;
        $supplier->updated_by=Auth::User()->id;
        $supplier->update();
        return redirect()->route('view-supplier')->with('message','Supplier Information updated successfully!!!');
    }
    public function deleteSupplier($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect('suppliers/view')->with('message','Supplier Information deleted successfully!!!');
    }

}
