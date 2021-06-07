@extends('back-end.master')
@section('title','Edit Product page')
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
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Edit Product</h2>
                    <h2><a href="{{route('view-product')}}"><span class="break"></span>View Product</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('update-product')}}" class="form-control-border" method="post" id="quickForm">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Supplier Name: </label>
                            <div class="col-md-8">
                                <select name="supplier_id" class="form-control" id="">
                                    <option value="">---Select Supplier----</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}" {{$editProduct->supplier_id==$supplier->id?"selected":'' }}>{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Category Name: </label>
                            <div class="col-md-8">
                                <select name="category_id" class="form-control" id="">
                                    <option value="">---Select Category----</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$editProduct->category_id==$category->id?'selected':'' }}>{{$category->name}}</option>
                                        <font color="red">{{$errors->has('category_id')?$errors->first('category_id'): '' }}</font>
                                    @endforeach
                                </select>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Unit Name: </label>
                            <div class="col-md-8">
                                <select name="unit_id" class="form-control" id="">
                                    <option value="">---Select Unit----</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" {{$editProduct->unit_id==$unit->id?'selected':'' }}>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Product Name: </label>
                            <div class="col-md-8">
                                <input type="text" name="name" value="{{$editProduct->name}}" class="form-control">
                                <input type="hidden" name="product_id" value="{{$editProduct->id}}">
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Product Quantity: </label>
                            <div class="col-md-8">
                                <input type="number" name="quantity" value="{{$editProduct->quantity}}" class="form-control">
                                <font color="red">{{$errors->has('quantity')?$errors->first('quantity'): '' }}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Product Price: </label>
                            <div class="col-md-8">
                                <input type="number" name="price" value="{{$editProduct->price}}" class="form-control">
                                <font color="red">{{$errors->has('price')?$errors->first('price'): '' }}</font>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="btn" value="Update Product Info" class="btn btn-success btn-block">
                        </div>


                    </form>

                </div>
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
@endsection


