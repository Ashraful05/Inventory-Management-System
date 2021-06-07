<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Unit;
use Auth;
use DB;


class ProductController extends Controller
{
    public function addProduct(){
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units     = Unit::all();
        return view('back-end.product.add-product',[
            'suppliers' => $suppliers,
            'categories' => $categories,
            'units'     => $units
        ]);
    }
    public function saveProduct(Request $request){
        $this->validate($request,[
           'name' => 'required',
           'price' => 'required',
           'supplier_id' => 'required',
            'category_id' => 'required',
            'unit_id'    => 'required'
        ]);
        $product = new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->supplier_id=$request->supplier_id;
        $product->category_id=$request->category_id;
        $product->unit_id=$request->unit_id;
        $product->created_by = Auth::User()->id;
        $product->save();
        return redirect()->route('view-product')->with('message','Product Information added Successfully!!!');
    }
    public function viewProduct(){
        $products = Product::all();
//        return $products;
        return view('back-end.product.view-product',['products'=>$products]);
    }
    public function editProduct($id){
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units     = Unit::all();
        $editProduct = Product::find($id);
        return view('back-end.product.edit-product',[
            'editProduct'=>$editProduct,
            'suppliers' =>$suppliers,
            'categories'=>$categories,
            'units'     =>$units
        ]);
    }
    public function updateProduct(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'unit_id'    => 'required'
        ]);
        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->supplier_id=$request->supplier_id;
        $product->category_id=$request->category_id;
        $product->unit_id=$request->unit_id;
        $product->updated_by = Auth::User()->id;
        $product->update();
        return redirect()->route('view-product')->with('message','Product Information updated successfully!!!');

    }
    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('view-product')->with('message','Product Information deleted successfully');
    }
}
