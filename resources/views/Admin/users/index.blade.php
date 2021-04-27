@extends('layouts.admin-home')
@section('content')
<main>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
           
                @foreach ($admins as $item)
                  <tr>
                    <th scope="row">{{$loop->index*1}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                      @foreach($item->roles as $parm)
                      <span class="badge badge-primary">{{$parm->name}}</span>
                      @endforeach
                    </td>
                    <td>
                      @if(Auth::guard('admin')->user()->can('admins.edit'))
                        <div class="btn-group">
                          <a class="btn btn-info" href="{{url('admin/users/edit/'.$item->id)}}">Edit<a>
                       @else
                        <p>Not Access</p>
                      @endif 
                      @if(Auth::guard('admin')->user()->can('admins.delete'))
                          <form action="{{ url('admin/users/delete/'.$item->id)}}" method="post">
                            @csrf
                            <button type="submit" id="delete" data-name="" class="btn btn-danger delete-confirm"> 
                              <i class="fas fa-trash-alt btn-icon-prepend"></i>
                               Delete
                            </button>   
                        </form>
                      </div>
                      @else
                      <p>Not Access</p>
                      @endif
                      
                    </td>
                  </tr>
                @endforeach
             
            
            </tbody>
          </table>
    </div>
  </main>
@endsection