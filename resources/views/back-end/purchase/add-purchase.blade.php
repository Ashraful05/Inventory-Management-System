@extends('back-end.master')
@section('title','Add Purchase page')
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

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Add Purchase</h2>
                    <h2><a href="{{route('view-purchase')}}"><span class="break"></span>View Purchase</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('save-purchase')}}" class="form-control form-control-border" method="post" id="quickForm">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Supplier Name: </label>
                            <div class="col-md-8">
                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                    <option value="">---Select Supplier----</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        <font color="red">{{$errors->has('supplier_id')?$errors->first('supplier_id'): '' }}</font>
                                    @endforeach
                                </select>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Category Name: </label>
                            <div class="col-md-8">
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="">---Select Category----</option>
                                </select>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Product Name: </label>
                            <div class="col-md-8">
                                <select name="product_id" id="product_id" class="form-control select2">
                                    <option value="">---Select Product----</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Date: </label>
                            <div class="col-md-8">
                                <input type="text" name="date" id="date" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Purchase No: </label>
                            <div class="col-md-8">
                                <input type="text" name="purchase_no" id="purchase_no" class="form-control" >
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group col-md-2" >
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                        </div>
                    </form>
                </div>
                <div class="box-content">
                    <form action="{{route('save-purchase')}}" method="post" id="quickForm" class="form-control">
                        @csrf
                        <table class="table-sm table-bordered">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Pieces/Kg</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="addRow" class="addRow">

                            </tbody>
                            <tbody>
                            <tr>
                                <td colspan="5"></td>
                                <td>
                                    <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                </td>
                                <td></td>
                            </tr>
                            </tbody>

                        </table>
                        <br>
                        <div class="form-group" method="post">
                            <input type="submit" name="btn" value="Submit" class="btn btn-primary" id="storeButton">
                        </div>
                    </form>
                </div>
                <script id="document-template" type="text/x-handlebars-template">
                    <tr class="delete_add_more_item" id="delete_add_more_item">
                        <input type="hidden" name="date[]" value="@{{ date }}">
                        <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
                        <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
                        <td>
                            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                            @{{ category_name }}
                        </td>
                        <td>
                            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                            @{{ product_name }}
                        </td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm text-right buying_quantity" name="buying_quantity[]" value="1">
                        </td>
                        <td>
                            <input type="text" name="description[]" class="form-control form-control-sm">
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]">
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
                        </td>
                        <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>

                    </tr>
                </script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(document).on("click",".addeventmore",function(){
                            var date = $('#date').val();
                            var purchase_no = $('#purchase_no').val();
                            var supplier_id = $('#supplier_id').val();
                            var category_id = $('#category_id').val();
                            var category_name = $('#category_id').find('option:selected').text();
                            var product_id = $('#product_id').val();
                            var product_name = $('#product_id').find('option:selected').text();

                            if(date == ''){
                                $.notify("date is required",{globalPosition: 'top right', className:'error'});
                                return false;
                            }
                            if(purchase_no==''){
                                $.notify('purchase_no is required',{globalPosition:'top right', className:'error'});
                                return false;
                            }
                            if(supplier_id==''){
                                $.notify('supplier name is required',{globalPosition:'top right', className:'error'});
                                return false;
                            }
                            if(category_id==''){
                                $.notify('Category name is required',{globalPosition:'top right', className:'error'});
                                return false;
                            }
                            if(product_id==''){
                                $.notify('Product name is required',{globalPosition:'top right', className:'error'});
                                return false;
                            }
                            var source = $("#document-template").html();
                            var template = Handlebars.compile(source);
                            var data = {
                              date:date,
                              purchase_no:purchase_no,
                              supplier_id:supplier_id,
                              category_id:category_id,
                              category_name:category_name,
                              product_id:product_id,
                              product_name:product_name
                            };
                            var html = template(data);
                            $("#addRow").append(html);
                        });
                        $(document).on("click",".removeeventmore",function(event){
                            $(this).closest(".delete_add_more_item").remove();
                            totalAmountPrice();
                        });
                        $(document).on('Keyup click','.unit_price,.buying_quantity',function(){
                            var price = $(this).closest('tr').find('input.unit_price').val();
                            var quantity = $(this).closest("tr").find('input.buying_quantity').val();
                            var total = price * quantity;
                            $(this).closest('tr').find('input.buying_price').val(total);
                            totalAmountPrice();
                        });
                        function totalAmountPrice(){
                            var sum=0;
                            $('.buying_price').each(function(){
                               var value = $(this).val();
                               if(!isNaN(value) && value.length!= 0){
                                   sum += parseFloat(value);
                               }
                            });
                            $('#estimated_amount').val(sum);
                        }

                    });
                </script>
            </div><!--/span-->

        </div><!--/row-->


    </div>
    <script type="text/javascript">
        $(function () {
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    role: {
                        required: true,
                        role: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    role: {
                        required: "Please select a role",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "please enter confirm password",
                        equalTo: "Confirm password does not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
    <script type="text/javascript">
        $(function(){
            $(document).on('change','#supplier_id',function(){
                var supplier_id = $(this).val();
                $.ajax({
                    url:"{{route('get-category')}}",
                    type:"GET",
                    data:{supplier_id:supplier_id},
                    success:function(data){
                        var html = '<option value="">--Select Category--</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                });
            });
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
    <script type="text/javascript">
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format   : 'yyyy-mm-dd'
        });
    </script>

@endsection



