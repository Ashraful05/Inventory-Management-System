@extends('back-end.master')
@section('title','Daily Purchase Report')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Daily Purchase Report</a></li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Select Criteria</h2>
                    {{--                    <h2><a href="{{route('view-invoice')}}"><span class="break"></span>View Invoice</a></h2>--}}
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('daily-purchase-report-pdf')}}" method="get" target="_blank" id="quickForm">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label col-md-4">Start Date: </label>
                                <div class="col-md-8">
                                    <input type="text" name="start_date" id="start_date"  placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                    <font color="red">{{$errors->has('start_date')?$errors->first('start_date'): '' }}</font>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="control-label col-md-4">End Date: </label>
                                <div class="col-md-4">
                                    <input type="text" name="end_date" id="end_date"  placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                    <font color="red">{{$errors->has('end_date')?$errors->first('end_date'): '' }}</font>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <button type="Submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><!--/span-->

        </div><!--/row-->

        <script type="text/javascript">
            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                format   : 'yyyy-mm-dd'
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
                $('#quickForm').validate({
                        rules: {
                            start_date: {
                                required: true,
                            },
                            end_date: {
                                required: true,
                            }
                        },
                        messages:{

                        },
                        errorElement: 'span',
                        errorPlacement: function(error,element){
                            error.addClass('invalid-feedback');
                            element.closest('.form-group').append(error);
                        },
                        highlight:
                            function(element, errorClass,validClass){
                                $(element).addClass('is-invalid');
                            },
                        unhighlight:
                            function(element, erroClass, validClass){
                                $(element).removeClass('is-invalid');
                            }
                    },
                )
            });

        </script>

@endsection





