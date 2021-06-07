@extends('back-end.master')
@section('title','View user page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Suppliers</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Suppliers</h2>
                    <h2><a href="{{route('add-supplier')}}"><span class="break"></span>Add Supplier</a></h2>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $key => $supplier)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$supplier->name}}</td>
                                <td class="center">{{$supplier->email}}</td>
                                <td class="center">{{$supplier->mobile_no}}</td>
                                <td class="center">{{$supplier->address}}</td>
                                @php
                                    $countSupplier = App\Product::where('supplier_id',$supplier->id)->count();
                                @endphp
                                <td class="center">
                                    <a class="btn btn-info" href="{{route('edit-supplier',['id'=>$supplier->id])}}" title="Edit">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    @if($countSupplier < 1)
                                        <a class="btn btn-danger" id="delete" href="{{route('delete-supplier',['id'=>$supplier->id])}}" title="Delete" >
                                            <i class="halflings-icon white trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
@endsection

