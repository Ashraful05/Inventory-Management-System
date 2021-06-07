@extends('back-end.master')
@section('title','View Customer Wise Report Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Manage Customer Wise Report</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2>Select Criteria</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <strong>Customer Wise Credit Report</strong>
                            <input type="radio" name="customer_wise_report" value="credit_wise" class="search_value">&nbsp;&nbsp;
                            <strong>Customer Wise Paid Report</strong>
                            <input type="radio" name="customer_wise_report" value="paid_wise" class="search_value">
                        </div>
                    </div>
                    <div class="show_credit" style="display:none;">
                        <form action="{{route('customer-wise-credit-report-pdf')}}" method="get" id="customerCreditForm" target="_blank">
                            <div class="form-row">
                                <div class="col-sm-8">
                                    <label for="">Customer Name</label>
                                    <select name="customer_id" id="" class="form-control select2">
                                        <option value="">---Select Customer---</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-4" style="padding-top: 30px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="show_paid" style="display: none;">
                        <form action="{{route('customer-wise-paid-report-pdf')}}" method="get" id="customerPaidForm" target="_blank">
                            <div class="form-row">
                                <div class="col-sm-8">
                                    <label for="">Customer Name</label>
                                    <select name="customer_id" id="" class="form-control select2">
                                        <option value="">---Select Customer---</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-2" style="padding-top: 30px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div><!--/span-->

        </div><!--/row-->

    </div>

    <script>
        $(document).on('change','.search_value',function(){
            var search_value = $(this).val();
            if(search_value == 'credit_wise'){
                $('.show_credit').show();
            }else {
                $('.show_credit').hide();
            }
        });
    </script>

    <script>
        $(document).on('change','.search_value',function(){
            var search_value = $(this).val();
            if(search_value == 'paid_wise'){
                $('.show_paid').show();
            }else {
                $('.show_paid').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#customerCreditForm').validate({
                    ignore: [],
                    errorPlacement: function(error, element){
                        if(element.attr("name") == "customer_id"){
                            error.insertAfter(element.next());
                        }else{
                            error.insertAfter(element);
                        }
                    },
                    errorClass:'text-danger',
                    validClass:'text-success',
                    rules: {
                        customer_id: {
                            required: true,
                        },
                    },
                    messages:{

                    },
                }
            );
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#customerPaidForm').validate({
                    ignore: [],
                    errorPlacement: function(error, element){
                        if(element.attr("name") == "customer_id"){
                            error.insertAfter(element.next());
                        }else{
                            error.insertAfter(element);
                        }
                    },
                    errorClass:'text-danger',
                    validClass:'text-success',
                    rules: {
                        customer_id: {
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




