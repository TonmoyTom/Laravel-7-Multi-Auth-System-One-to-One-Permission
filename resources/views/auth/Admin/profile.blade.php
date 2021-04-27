@extends('layouts.admin-home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm" style="margin-top: 50px;">
                 <h2>Profile</h2>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-sm-6 col-md-4">

                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" height="200"m width="150"/>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                        {{ Auth::guard('admin')->user()->name }}
                    </h4>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i> {{ Auth::guard('admin')->user()->email }}
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>{{Auth::guard('admin')->user()->created_at->format('d/m/Y') }}</p>
                        <!-- Split button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
