@extends('layouts.admin-home')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight px-3 py-3">
            <h4 class="mb-2">New Clients</h4>
            <div class="progress" style="height: 16px;">
              <div
                class="progress-bar bg-warning text-mattBlackDark"
                role="progressbar"
                style="width: 25%;"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                25
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight px-3 py-3">
            <h4 class="mb-2">New Projects</h4>
            <div class="progress" style="height: 16px;">
              <div
                class="progress-bar bg-info text-mattBlackDark"
                role="progressbar"
                style="width: 50%;"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                50
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight p-3">
            <h4 class="mb-2">Completed</h4>
            <div class="progress" style="height: 16px;">
              <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: 80%;"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                80
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


