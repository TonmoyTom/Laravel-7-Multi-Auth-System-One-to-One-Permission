@extends('layouts.admin-home')
@section('content')
<main>
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-lg-8">
                <h1 style="color: #000; text-algin:center">Role Create</h1>
            </div>
        </div>
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

        <form action="{{route("role.store")}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="role">Role</label>
              <input type="text" class="form-control" id="role"  name="name">
            </div>

            

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input"  id="checkPermissionAll" value="" >
                <label class="form-check-label" for="checkPermissionAll" style="color: #000;">All</label>
            </div>
            <hr>
            @php $i = 1; @endphp
            @foreach ($premission_groups as $groups)
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $groups->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                        <label class="form-check-label" for="checkPermission">{{ $groups->name }}</label>
                      </div>
                </div>
                <div class="col-lg-3 role-{{ $i }}-management-checkbox">
                    @php
                    $permissions = App\Admin::getpermissionsByGroupName($groups->name);
                    $j = 1;
                    @endphp
                    @foreach ($permissions as $item)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $item->id }}" value="{{ $item->name }}">
                        <label class="form-check-label" for="checkPermission{{ $item->id }}">{{ $item->name }}</label>
                    </div>
                      @php  $j++; @endphp
                    @endforeach
                </div>
            </div>
            @php  $i++; @endphp
            <br>
            <hr>
            @endforeach
            

            
              

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
  </main>
@endsection

@section('scripts')
     <script>
         /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }
     </script>
@endsection


