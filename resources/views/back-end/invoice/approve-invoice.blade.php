@extends('back-end.master')
@section('title','View Invoice Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="{{route('view-invoice')}}">Invoice</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2>Invoice No #{{$invoice->invoice_no}}({{$invoice->date}})</h2>

                    <h2><a href="{{route('pending-invoice')}}"><span class="break"></span>Pending Invoice List</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @php
                        $payment = App\Payment::where('invoice_id', $invoice->id)->first();
                    @endphp
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td width="15%"><p><strong>Customer Info </strong></p></td>
                            <td width="25%"><p><strong>Name :</strong> {{$payment['customer']['name']}}</p></td>
                            <td width="25%"><p><strong>Mobile Number :</strong> {{$payment['customer']['mobile_no']}}</p></td>
                            <td width="35%"><p><strong>Address :</strong> {{$payment['customer']['address']}}</p></td>
                        </tr>
                        <tr>
                            <td width="15%"></td>
                            <td width="85%" colspan="3"><p><strong>Description: </strong>{{$invoice->description}}</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{route('save-approval',['id'=>$invoice->id])}}" method="post">
                        @csrf
                        <table border="1" width="100%" style="margin-botton: 10px;">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th class="text-center" style="background-color: red">Current Stock</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalSum = '0';
                                @endphp
                                @foreach($invoice['InvoiceDetails'] as $key => $details)
                                    <tr>
                                        <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                                        <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                                        <input type="hidden" name="selling_quantity[{{$details->id}}]" value="{{$details->selling_quantity}}">
                                        <td>{{$key+1}}</td>
                                        <td class="text-center">{{$details['category']['name']}}</td>
                                        <td class="text-center">{{$details['product']['name']}}</td>
                                        <td class="text-center" style="background-color: greenyellow">{{$details['product']['quantity']}}</td>
                                        <td class="text-center">{{$details->selling_quantity}}</td>
                                        <td class="text-center">{{$details->unit_price}}</td>
                                        <td class="text-center">{{$details->selling_price}}</td>
                                    </tr>
                                    @php
                                        $totalSum += $details->selling_price;
                                    @endphp
                                @endforeach
                                <tr class="text-center">
                                    <td colspan="6" class="text-right"><strong style="background-color: #0C9A9A">Sub Total: </strong></td>
                                    <td>{{$totalSum}}</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="6" class="text-right"><strong style="background-color: #00b0e8">Discount: </strong></td>
                                    <td>{{$payment->discount_amount}}</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="6" class="text-right"><strong style="background-color: #D8FDBA">Paid Amount: </strong></td>
                                    <td>{{$payment->paid_amount}}</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="6" class="text-right"><strong style="background-color: orangered">Due Amount: </strong></td>
                                    <td>{{$payment->due_amount}}</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="6" class="text-right"><strong style="background-color: #5bc0de">Grand Total: </strong></td>
                                    <td>{{$payment->total_amount}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <input type="submit" name="btn" value="Approve Invoice" class="btn btn-success">
                    </form>

                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
@endsection





