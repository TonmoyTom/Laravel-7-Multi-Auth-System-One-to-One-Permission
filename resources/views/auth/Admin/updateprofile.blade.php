@extends('layouts.admin-home')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-6 col-md-6">
            <div class="well well-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form action="{{-- url('/admin/update-profile-change-store') --}}" method="POST"  id="updatePasswordForm" name="updatePasswordForm">
            @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Name </label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="name"  id="admin_name" value="{{$admindetails->name}}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Email </label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control"  name="email" id="admin_email" value="{{$admindetails->email}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Old Password </label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control"  name="old_password" id="old_password">
                    <span id="chkoldpwd" ></span>
                    </div>
                </div>
                <button type="submit" >Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection

