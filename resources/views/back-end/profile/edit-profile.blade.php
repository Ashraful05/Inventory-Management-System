@extends('back-end.master')
@section('title','Edit Profile Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="{{route('view-profile')}}">Profile</a></li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon user"></i><span class="break"></span>Edit Profile</h2>
                    <h2><a href="{{route('view-profile')}}"><span class="break"></span>View Profile</a></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form action="{{route('update-profile')}}" method="post" id="quickForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Name: </label>
                            <div class="col-md-8">
                                <input type="text" name="name" value="{{$editUser->name}}" class="form-control">
                                <input type="hidden" name="user_id" value="{{$editUser->id}}" class="form-control">
                                <font color="red">{{$errors->has('name')?$errors->first('name'): '' }}</font>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Email: </label>
                            <div class="col-md-8">
                                <input type="email" name="email" value="{{$editUser->email}}" class="form-control">
                                <font color="red">{{$errors->has('email')?$errors->first('email'): ''}}</font>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Mobile: </label>
                            <div class="col-md-8">
                                <input type="text" name="mobile" value="{{$editUser->mobile}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Gender: </label>
                            <div class="col-md-8">
                                <select name="gender" id="" class="form-control">
                                    <option>---Select Gender---</option>
                                    <option value="Male" {{($editUser->gender=="Male")?"selected": ""}}>Male</option>
                                    <option value="Female" {{($editUser->gender=="Female")?"selected": ''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-4">Image </label>
                            <div class="col-md-8">
                                <input type="file" name="image"  class="form-control" id="image">
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="showImage" src="{{(!empty($editUser->image))?url('public/upload/user-images/'.$editUser->image):url('public/upload/no-image.png')}}" alt="" style="width: 150px; height: 150px;border: 1px solid black;">
                        </div>


                        <div class="form-group">
                            <input type="submit" name="btn" value="Update User" class="btn btn-primary btn-block">
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


