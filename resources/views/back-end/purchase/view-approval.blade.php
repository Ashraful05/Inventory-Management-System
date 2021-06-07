@extends('back-end.master')
@section('title','View Approval page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Purchase</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Pending Purchase List</h2>
{{--                    <h2><a href="{{route('add-purchase')}}"><span class="break"></span>Add Purchase</a></h2>--}}
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable table-responsive">
                        <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Purchase No.</th>
                            <th>Date</th>
                            <th>Supplier Name</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Buying Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $key => $purchase)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                                <td>{{$purchase['supplier']['name']}}</td>
                                <td>{{$purchase['category']['name']}}</td>
                                <td>{{$purchase['product']['name']}}</td>
                                <td>{{$purchase->description}}</td>
                                <td>
                                    {{$purchase->buying_quantity}}
                                    {{$purchase['product']['unit']['name']}}
                                </td>
                                <td>{{$purchase->unit_price}}</td>
                                <td>{{$purchase->buying_price}} </td>
                                <td>
                                    @if($purchase->status=='0')
                                        <span style="background-color: red;">Pending</span>
                                    @else
                                        <span style="background-color: #00f169;">Approved</span>
                                    @endif
                                </td>
                                <td class="center">
{{--                                    <a class="btn btn-info" href="{{route('edit-purchase',['id'=>$purchase->id])}}" title="Edit">--}}
{{--                                        <i class="halflings-icon white edit"></i>--}}
{{--                                    </a>--}}
                                    @if($purchase->status=='0')
                                        <a class="btn btn-primary" id="approveBtn" href="{{route('approve-purchase',['id'=>$purchase->id])}}" title="Approve" >
                                            <i class="halflings-icon  icon-save"></i>
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




