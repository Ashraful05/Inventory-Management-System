@extends('back-end.master')
@section('title','View Profile Page')
@section('content')
    <div id="content" class="span10">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('/dashboard')}}">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Profile</a></li>
        </ul>
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon profile"></i><span class="break"></span>Profile</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">Name: {{$user->name}}</h3>
                            <p class="text-muted text-center"><b>Email: {{$user->email}}</b></p>
                            <p class="text-muted text-center"><b>Role: {{$user->role}}</b></p>
                            <p class="text-muted text-center"><b>Mobile: {{$user->mobile}}</b></p>
                            <a href="{{route('edit-profile',['id'=>$user->id])}}" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div><!--/span-->

        </div><!--/row-->


    </div>
@endsection

