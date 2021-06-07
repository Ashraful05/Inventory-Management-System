@extends('back-end.master')
@section('title','Edit Credit Customer page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Edit Customer Credit(Invoice No: {{$payment['invoice']['invoice_no']}} )</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Customers</h2>
                    <h2><a href="{{route('credit-customer')}}"><span class="break"></span>Credit Customer</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td width="15%"><p><strong>Customer Info:</strong></p> </td>
                            <td width="25%"><p><strong>Name :</strong> {{$payment['customer']['name']}}</p></td>
                            <td width="25%"><p><strong>Mobile Number :</strong> {{$payment['customer']['mobile_no']}}</p></td>
                            <td width="35%"><p><strong>Address :</strong> {{$payment['customer']['address']}}</p></td>
                        </tr>
                        <tr>
                            <td width="15%"></td>
                            {{--                            <td width="85%" colspan="3"><p><strong>Description: </strong>{{$invoice->description}}</p></td>--}}
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{route('update-customer-credit',['invoice_id'=>$payment->invoice_id])}}" method="post" id="myForm">
                        @csrf
                        <table border="1" width="100%" style="margin-botton: 10px;">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $totalSum = '0';
                            @endphp

                            @foreach($invoiceDetails as $key => $details)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td class="text-center">{{$details['category']['name']}}</td>
                                    <td class="text-center">{{$details['product']['name']}}</td>
                                    <td class="text-center">{{$details->selling_quantity}}</td>
                                    <td class="text-center">{{$details->unit_price}}</td>
                                    <td class="text-center">{{$details->selling_price}}</td>
                                </tr>

                                @php($totalSum += $details->selling_price)

                            @endforeach

                            <tr class="text-center">
                                <td colspan="5" class="text-right"><strong style="background-color: #0C9A9A">Sub Total: </strong></td>
                                <td>{{$totalSum}}</td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="5" class="text-right"><strong style="background-color: #D8FDBA">Paid Amount: </strong></td>
                                <td>{{$payment->paid_amount}}</td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="5" class="text-right"><strong style="background-color: #00b0e8">Discount: </strong></td>
                                <td>{{$payment->discount_amount}}</td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="5" class="text-right"><strong style="background-color: orangered">Due Amount: </strong></td>
                                <input type="hidden" name="recent_paid_amount" value="{{$payment->due_amount}}">
                                <td>{{$payment->due_amount}}</td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="5" class="text-right"><strong style="background-color: #5bc0de">Grand Total: </strong></td>
                                <td>{{$payment->total_amount}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="form-group col-md-3">
                            <label for=""><strong>Paid Status</strong></label>
                            <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                <option value="">Select Status</option>
                                <option value="full_paid">Full Paid</option>
                                <option value="partial_paid">Partial Paid</option>
                            </select>
                            <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4"><strong>Date: </strong></label>
                            <div class="col-md-8">
                                <input type="text" name="date" id="date" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                <font color="red">{{$errors->has('date')?$errors->first('date'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Update Credit Information</button>
                        </div>
                    </form>
                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
    <script>
        $(document).on('change','#paid_status',function(){
            // Paid Status
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid'){
                $('.paid_amount').show();
            }else{
                $('.paid_amount').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format   : 'yyyy-mm-dd'
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myForm').validate({
                    errorClass:'text-danger',
                    validClass:'text-success',
                    rules: {
                        date: {
                            required: true,
                        },
                        paid_status:{
                            required: true,
                        },
                    },
                    messages:{

                    },
                }
            );
        });

    </script>
@endsection


