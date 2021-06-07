@extends('back-end.master')
@section('title','Pending Invoice Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="{{route('pending-invoice')}}">Invoice</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    {{--                    <h2><i class="halflings-icon user"></i><span class="break"></span>View Invoice</h2>--}}
                    {{--                    <h2><a href="{{route('add-invoice')}}"><span class="break"></span>Add Invoice</a></h2>--}}
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
                            <th>Customer Name</th>
                            <th>Invoice No.</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $key => $invoice)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$invoice['payment']['customer']['name']}}
                                    ({{$invoice['payment']['customer']['mobile_no']}} - {{$invoice['payment']['customer']['address']}})
                                </td>
                                <td>#{{$invoice->invoice_no}}</td>
                                <td>{{$invoice->date}}</td>
                                <td>{{$invoice->description}}</td>
                                <td>{{$invoice['payment']['total_amount']}}</td>
                                <td>
                                    @if($invoice->status=='0')
                                        <span style="background-color: red;">Pending</span>
                                    @else
                                        <span style="background-color: #00f169">Approve</span>
                                    @endif
                                </td>
                                <td>
                                    @if($invoice->status=='0')
                                        <a class="btn btn-primary" id="" href="{{route('approve-invoice',['id'=>$invoice->id])}}" title="Approve" >
                                            <i class="halflings-icon  icon-save"></i>
                                        </a>
                                        <a class="btn btn-danger" id="delete" href="{{route('delete-invoice',['id'=>$invoice->id])}}" title="Delete" >
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





