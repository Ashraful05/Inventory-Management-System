@extends('back-end.master')
@section('title','Add Invoice Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Invoice</a></li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Add Invoice</h2>
                    <h2><a href="{{route('view-invoice')}}"><span class="break"></span>View Invoice</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('save-invoice')}}" class="form-control form-control-border" method="post" id="quickForm">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Category Name: </label>
                            <div class="col-md-8">
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="">---Select Category----</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        <font color="red">{{$errors->has('category_id')?$errors->first('category_id'): '' }}</font>
                                    @endforeach
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
                            <label for="" class="control-label col-md-4">Stock(PCS/KG): </label>
                            <div class="col-md-8">
                                <input type="text" name="current_stock_quantity" id="current_stock_quantity" class="form-control form-control-sm" readonly style="background-color: #D8FDBA">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Date: </label>
                            <div class="col-md-8">
                                <input type="text" name="date" id="date" value="{{$date}}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                <font color="red">{{$errors->has('date')?$errors->first('date'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Invoice No: </label>
                            <div class="col-md-8">
                                <input type="text" name="invoice_no" id="invoice_no" value="{{ $invoiceNumber }}" class="form-control" readonly style="background-color: #D8FDBA">
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group col-md-2" >
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                        </div>
                    </form>
                </div>
                <div class="box-content">
                    <form action="{{route('save-invoice')}}" method="post" id="quickForm" class="form-control">
                        @csrf
                        <table class="table-sm table-bordered">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th width="7%">Pieces/Kg</th>
                                <th width="10%">Unit Price</th>
                                <th width="17%">Total Price</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody id="addRow" class="addRow">

                            </tbody>
                            <tbody>
                            <tr>
                                <td class="text-right" colspan="4">Discount</td>
                                <td><input type="text" name="discount_amount" id="discount_amount" class="form-control-sm discount_amount text-right" placeholder="Enter discount amount"></td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="4">Grand Total</td>
                                <td>
                                    <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                </td>
                                <td></td>
                            </tr>
                            </tbody>

                        </table>
                        <br>
                        <div class="form-row">
                            <div class="form-group">
                                <textarea name="description" class="form-control" id="description" placeholder="Write your description here"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">Paid Status</label>
                                <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                    <option value="">Select Status</option>
                                    <option value="full_paid">Full Paid</option>
                                    <option value="full_due">Full Due</option>
                                    <option value="partial_paid">Partial Paid</option>
                                </select>
                                <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                            </div>
                            <div class="form-group col-md-9">
                                <label for="">Customer Name</label>
                                <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                                    <option value="">---Select Customer---</option>
                                    <option value="0" class="new_customer" id="new_customer">New Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile_no}} - {{$customer->address}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-row new_customer" id="new_customer" style="display: none;">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Write Customer Name">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm" placeholder="Write Customer Mobile Number">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Write Customer Address">
                            </div>
                        </div>
                        <div class="form-group" >
                            <input type="submit" name="btn" value="Submit" class="btn btn-primary" id="storeButton">
                        </div>
                    </form>
                </div>
                <script id="document-template" type="text/x-handlebars-template">
                    <tr class="delete_add_more_item" id="delete_add_more_item">
                        <input type="hidden" name="date" value="@{{ date }}">
                        <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
                        <td>
                            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                            @{{ category_name }}
                        </td>
                        <td>
                            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                            @{{ product_name }}
                        </td>
                        <td>
                            <input type="number" min="1" class="form-control form-control-sm text-right selling_quantity" name="selling_quantity[]" value="1">
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]">
                        </td>
                        <td>
                            <input type="number" class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
                        </td>
                        <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>

                    </tr>
                </script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(document).on("click",".addeventmore",function(){
                            var date = $('#date').val();
                            var invoice_no = $('#invoice_no').val();
                            var category_id = $('#category_id').val();
                            var category_name = $('#category_id').find('option:selected').text();
                            var product_id = $('#product_id').val();
                            var product_name = $('#product_id').find('option:selected').text();

                            if(date == ''){
                                $.notify("date is required",{globalPosition: 'top right', className:'error'});
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
                                invoice_no:invoice_no,
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
                        $(document).on('Keyup click','.unit_price,.selling_quantity',function(){
                            var price = $(this).closest('tr').find('input.unit_price').val();
                            var quantity = $(this).closest("tr").find('input.selling_quantity').val();
                            var total = price * quantity;
                            $(this).closest('tr').find('input.selling_price').val(total);
                            $('#discount_amount').trigger('Keyup');
                        });
                        $(document).on('Keyup','#discount_amount',function(){
                            totalAmountPrice();

                        });
                        function totalAmountPrice(){
                            var sum=0;
                            $('.selling_price').each(function(){
                                var value = $(this).val();
                                if(!isNaN(value) && value.length!= 0){
                                    sum += parseFloat(value);
                                }
                            });
                            var discount_amount = parseFloat($('#discount_amount').val());
                            if(!isNaN(discount_amount) && discount_amount.length != 0){
                                sum -= parseFloat(discount_amount);
                            }
                            $('#estimated_amount').val(sum);
                        }
                    });
                </script>
            </div><!--/span-->

        </div><!--/row-->


    </div>
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
        $(function(){
            $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                $.ajax({
                    url: "{{route('check-product-stock')}}",
                    type: "GET",
                    data: {product_id:product_id},
                    success: function(data){
                        $('#current_stock_quantity').val(data);
                    }
                });
            });
        });
    </script>
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
    <script>
        $(function(){
            $(document).on('change','#customer_id',function(){
                var customer_id = $(this).val();
                if(customer_id == '0'){
                    $('.new_customer').show();
                }else{
                    $('.new_customer').hide();
                }
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




