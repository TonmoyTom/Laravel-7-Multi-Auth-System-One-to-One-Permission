@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" height="200"m width="150"/>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                        {{ Auth::user()->name }}</h4>
                        <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i> {{ Auth::user()->email }}
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>{{Auth::user()->created_at->format('d/m/Y') }}</p>
                        <!-- Split button -->
                        <div class="btn-group">
                        <a href="{{ route('user.profile.change') }}" class="btn btn-primary">
                                Edit User Profile</a>
                            <a type="submit" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Edit</span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="text-center"><a href="{{ route('user.update.profile.change') }}">Profile Change</a></li>
                                <li class="text-center"><a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">Logout</a></li>
                                <form id="logout-form" action="{{  route('user.logout')  }}" method="POST" class="d-none">
                                        @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
