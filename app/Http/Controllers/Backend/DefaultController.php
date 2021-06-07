<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Category;
use App\Supplier;
use App\Unit;
use App\Purchase;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $categories = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)
            ->groupBy('category_id')->get();
        return $categories;

    }
    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $products = Product::where('category_id',$category_id)->get();
        return $products;
    }
    public function checkStock(Request $request){
        $productId = $request->product_id;
        $stock = Product::where('id',$productId)->first()->quantity;
        return response()->json($stock);

    }

}
