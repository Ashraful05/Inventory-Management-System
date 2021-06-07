<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

class UnitController extends Controller
{
    public function addUnit(){
        return view('back-end.unit.add-unit');
    }
    public function saveUnit(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->publication_status=$request->publication_status;
        $unit->created_by=Auth::User()->id;
        $unit->save();
        return redirect()->route('view-unit')->with('message','Unit Information has been added successfully!!!');
    }
    public function viewUnit(){
        $units = Unit::all();
//        dd($customers);
        return view('back-end.unit.view-unit',['units'=>$units]);
    }
    public function editUnit($id){
        $editUnit = Unit::find($id);
//        dd($customer);
        return view('back-end.unit.edit-unit',['editUnit'=>$editUnit]);
    }
    public function updateUnit(Request $request){
        $this->validate($request,[
           'name'=>'required'
        ]);
        $unit=Unit::find($request->unit_id);
        $unit->name = $request->name;
        $unit->updated_by=Auth::User()->id;
        $unit->update();
        return redirect()->route('view-unit')->with('message','Unit Information updated successfully!!!');
    }
    public function deleteUnit($id){
        $unit = Unit::find($id);
        $unit->delete();
        return redirect('units/view')->with('message','Unit Information deleted successfully!!!');
    }
}
