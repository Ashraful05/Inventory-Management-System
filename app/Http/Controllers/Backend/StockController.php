<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use PDF;

class StockController extends Controller
{
    public function viewStockReport(){
        $products = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
//        return $products;
        return view('back-end.stock.stock-report',['products'=>$products]);
    }
    public function viewStockReportPDF(){
        $products = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = PDF::loadView('back-end.pdf.stock-report-pdf',['products'=>$products]);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
    }
    public function viewSupplierProductWiseReport(){
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('back-end.stock.supplier-product-wise-report',[
            'suppliers' => $suppliers,
            'categories' => $categories
        ]);
    }
    public function viewSupplierWiseReportPDF(Request $request){
        $products = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        $pdf = PDF::loadView('back-end.pdf.supplier-wise-stock-report-pdf',['products'=>$products]);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
    }

    public function viewProductWiseReportPDF(Request $request){
        $product = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
        $pdf = PDF::loadView('back-end.pdf.product-wise-stock-report-pdf',[
            'product'=>$product,
        ]);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
    }
}
