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
            <li><a href="#">Supplier/Product Wise Report</a></li>
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
                            <strong>Supplier Wise Report</strong>
                            <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value">&nbsp;&nbsp;
                            <strong>Product Wise Report</strong>
                            <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                        </div>
                    </div>
                    <div class="show_supplier" style="display:none;">
                        <form action="{{route('view-supplier-wise-report-pdf')}}" method="get" id="supplierWiseForm" target="_blank">
                            <div class="form-row">
                                <div class="col-sm-8">
                                    <label for="">Supplier Name</label>
                                    <select name="supplier_id" id="" class="form-control select2">
                                        <option value="">---Select Supplier---</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4" style="padding-top: 30px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="show_product" style="display: none;">
                        <form action="{{route('view-product-wise-report-pdf')}}" method="get" id="productWiseForm" target="_blank">
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <label for="" class="control-label col-md-4">Category Name: </label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="">---Select Category----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            <font color="red">{{$errors->has('category_id')?$errors->first('category_id'): '' }}</font>
                                        @endforeach
                                    </select>
                                    <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="control-label col-md-4">Product Name: </label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                        <option value="">---Select Product----</option>
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
            if(search_value == 'supplier_wise'){
                $('.show_supplier').show();
            }else {
                $('.show_supplier').hide();
            }
        });
    </script>

    <script>
        $(document).on('change','.search_value',function(){
            var search_value = $(this).val();
            if(search_value == 'product_wise'){
                $('.show_product').show();
            }else {
                $('.show_product').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#productWiseForm').validate({
                    ignore: [],
                    errorPlacement: function(error, element){
                        if(element.attr("name") == "category_id"){
                            error.insertAfter(element.next());
                        }
                        else if(element.attr("name") == "product_id"){
                            error.insertAfter(element.next());
                        }
                        else{
                            error.insertAfter(element);
                        }
                    },
                    errorClass:'text-danger',
                    validClass:'text-success',
                    rules: {
                        category_id: {
                            required: true,
                        },
                        product_id: {
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
            $('#supplierWiseForm').validate({
                    ignore: [],
                    errorPlacement: function(error, element){
                        if(element.attr("name") == "supplier_id"){
                            error.insertAfter(element.next());
                        }else{
                            error.insertAfter(element);
                        }
                    },
                    errorClass:'text-danger',
                    validClass:'text-success',
                    rules: {
                        supplier_id: {
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
        $(function(){
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{route('get-product')}}",
                    type:"GET",
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">--Select Product--</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection




