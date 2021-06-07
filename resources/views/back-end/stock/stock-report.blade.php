@extends('back-end.master')
@section('title','View Stock Report Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Products</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    {{--                    <h2><span class="break"></span>Stock Report</h2>--}}
                    <h2><a href="{{route('view-report-pdf')}}" target="_blank"><i class="halflings-icon download"></i><span class="break"></span>Download PDF Report</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Supplier Name</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>In Quantity</th>
                            <th>Out Quantity</th>
                            <th>Stock</th>
                            <th>Unit Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            @php
                              $buyingTotal = App\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_quantity');
                              $sellingTotal = App\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_quantity');
                            @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product['supplier']['name']}}</td>
                                <td>{{$product['category']['name']}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$buyingTotal}}</td>
                                <td>{{$sellingTotal}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product['unit']['name']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
@endsection



