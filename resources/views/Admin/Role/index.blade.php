@extends('layouts.admin-home')
@section('content')
<main>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th width="50%" scope="col-2">Permissions</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($roles as $item)
                  <tr>
                    <th scope="row">{{$loop->index*1}}</th>
                    <td>{{$item->name}}</td>
                    <td>
                     
                      @foreach($item->permissions as $parm)
                      <span class="badge badge-primary">{{$parm->name}}</span>
                      @endforeach
                    </td>
                    <td>
                      
                      @if(Auth::guard('admin')->user()->can('role.edit'))
                      <div class="btn-group">
                        <a class="btn btn-info" href="{{url('admin/roles/edit/'.$item->id)}}">Edit<a>
                      @else
                      <p>Not Acess</p>
                      @endif
                        @if(Auth::guard('admin')->user()->can('role.delete'))  
                          <form action="{{url('admin/roles/delete/'.$item->id) }}" method="post">
                           
                            @csrf
                            <button type="submit" id="delete" data-name="" class="btn btn-danger delete-confirm"> 
                              <i class="fas fa-trash-alt btn-icon-prepend"></i>
                               Delete
                            </button>   
                        </form>
                      </div>
                      @else
                      <p>Not Acess</p>
                      @endif
                      
                    </td>
                  </tr>
                @endforeach
             
            
            </tbody>
          </table>
    </div>
  </main>
@endsection