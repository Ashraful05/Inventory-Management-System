@extends('back-end.master')
@section('title','Paid Customer page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Cusotmers</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><a href="{{route('paid-customer-pdf')}}" target="_blank"><span class="break"></span><i class="halflings-icon download"></i>Download Paid Customer Report</a></h2>
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
                            <th>Customer Name</th>
                            <th>Invoice Number</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalPaid = '0';
                        @endphp
                        @foreach($payments as $key => $payment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$payment['customer']['name']}}
                                    ({{$payment['customer']['mobile_no']}} - {{$payment['customer']['address']}})
                                </td>
                                <td class="center">Invoice No# {{$payment['invoice']['invoice_no']}}</td>
                                <td class="center">{{ date('d-m-Y',strtotime($payment['invoice']['date'] )) }}</td>
                                <td class="center">Tk. {{$payment->paid_amount}}</td>
                                <td class="center">
                                    <a class="btn btn-success"  href="{{route('invoice-details-pdf',['invoice_id'=>$payment->invoice_id])}}" target="_blank" title="Details" >
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td>
                                @php
                                    $totalPaid += $payment->paid_amount;
                                @endphp
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                            <td><strong>{{$totalPaid}}</strong></td>
                        </tr>

                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
@endsection




