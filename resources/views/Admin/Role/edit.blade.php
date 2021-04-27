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

        <form action="{{url('admin/roles/edit/'.$roles->id)}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="role" style="color: #000;">Role</label>
              <input type="text" class="form-control" id="role"  name="name" value="{{$roles->name}}">
            </div>

         

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input"  id="checkPermissionAll" value="" {{App\Admin::roleHasPermissions($roles, $premissions) ? 'checked' : '' }} >
                <label class="form-check-label" for="checkPermissionAll" style="color: #000;">All</label>
            </div>
            <hr>
            @php $i = 1; @endphp
            @foreach ($premission_groups as $groups)

            @php
            $permissions = App\Admin::getpermissionsByGroupName($groups->name);
            $j = 1;
            @endphp
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $groups->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" 
                         {{App\Admin::roleHasPermissions($roles, $permissions) ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkPermission" style="color: #000;">{{ $groups->name }}</label>
                      </div>
                </div>
                <div class="col-lg-3 role-{{ $i }}-management-checkbox">
                   
                    @foreach ($permissions as $item)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]" {{$roles->hasPermissionTo($item->name) ? 'checked': ''}} id="checkPermission{{ $item->id }}" value="{{ $item->name }}"
                        onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management',
                         {{ count($permissions) }})" >
                        <label class="form-check-label" for="checkPermission{{ $item->id }}" style="color: #000;">{{ $item->name }}</label>
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
             implementAllChecked();
         }

         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }

         function implementAllChecked() {
             const countPermissions = {{ count($premissions) }};
             const countPermissionGroups = {{ count($premission_groups) }};
            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);
             if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }
     </script>
@endsection


