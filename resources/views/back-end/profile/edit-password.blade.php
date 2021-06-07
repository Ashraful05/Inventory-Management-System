@extends('back-end.master')
@section('title','Edit Password Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Password</a></li>
        </ul>
        <h3 class="text-center text-danger">{{Session::get('message')}}</h3>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Password</h2>
                    <h2><a href="{{route('change-password')}}"><span class="break"></span>Change Password</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('update-password')}}" method="post" id="quickForm">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Old Password: </label>
                            <div class="col-md-8">
                                <input type="password" id="old_password" name="old_password" class="form-control">
                                <font color="red">{{$errors->has('old_password')?$errors->first('old_password'):''}}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">New Password: </label>
                            <div class="col-md-8">
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                <font color="red">{{$errors->has('new_password')?$errors->first('new_password'):''}}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Confirm Password: </label>
                            <div class="col-md-8">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                <font color="red">{{$errors->has('confirm_password')?$errors->first('confirm_password'):''}}</font>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="btn" value="Change Password" class="btn btn-success btn-block">
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


