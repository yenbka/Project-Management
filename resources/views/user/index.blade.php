@extends('layout')

@section('content')



<div class="row">
    <div class="col-md-12">
        <h1>@lang('message.user_title')</h1>
    </div>
</div>


<div class="new_project">
  <button action="{{ route('user.create') }}" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span><img src="/img/adduser.png"></span>&nbsp;@lang('message.button_add_user')</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@lang('message.enter_user_info') </h4>
        </div>

        <div class="modal-body">
        <form name="task_form" action="{{ route('user.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <label>@lang('message.create_new_user') <span><img src="/img/adduser.png"></span></label>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@lang('message.enter_user_full_name') " id="name" name="name" value="{{ old('name') }}" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@lang('message.enter_user_email') " name="email" id="email1" value="{{ old('email') }}" >
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@lang('message.enter_user_pass') " id="password" name="password"  >
                        </div>

                        <div class="form-group">
            <label>@lang('message.permission') <span><img src="/img/permission.png"></span></label>
            <select name="permission" class="form-control">
                <option value="admin" selected>@lang('message.admin') </option>
                <option value="user">@lang('message.user') </option>
            </select>
        </div>

                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label>@lang('message.set_status') <span><img src="/img/status.png"></span></label>
                        <select name="admin" class="form-control">
                            <option value="0" selected>@lang('message.disabled') </option>
                            <option value="1">@lang('message.active') </option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="@lang('message.submit')" onclick="return validate()">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('message.close')</button>
            </div>
        </form>
       </div>
    </div>
  </div>
</div>
<!--  END modal  -->





<table class="table table-striped">
    <thead>
      <tr>
        <th>@lang('message.title_name')</th>
        <th>@lang('message.title_email')</th>
        <th>@lang('message.title_status') </th>
        <th>@lang('message.title_action') </th>
      </tr>
    </thead>

@if ( !$users->isEmpty() ) 
    <tbody>
    @foreach ( $users as $user)
    @if ( $user->id == 1 )  @continue 
    @endif
      <tr>
        <td><a href="{{ route('user.list', ['id'=> $user->id] ) }}">{{ $user->name }}</a></td>

        <td>{{ $user->email }}</td>
    
        <td>
            @if ( !$user->admin )
                <a href="{{ route('user.activate', ['id' => $user->id]) }}" class="btn btn-warning">@lang('message.button_active') </a>
            @else
                <a href="{{ route('user.disable', ['id' => $user->id]) }}" class="btn btn-warning"> @lang('message.button_disable')</a>
                <span class="label label-success">@lang('message.label_active')</span>
            @endif
        </td>
        <td>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-edit"><span><img src="/img/edit.png"></span></a>
 
            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger" Onclick="return ConfirmDelete();"><img src="/img/delete.png"></span></a>
        </td>
    </tr>
    @endforeach
    </tbody>
@else 
    <p><em>@lang('message.message_no_users_yet') </em></p>
@endif
</table>
@stop

<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a User will also delete all tasks associated.");
  if (x)
      return true;
  else
    return false;
}

function validate(){

    console.log("VALIDATE FORM CLICKED") ;
    var name = document.forms["task_form"]["name"].value;
    var email = document.forms["task_form"]["email"].value;
    var email1 = document.getElementById('email1'); 
    var password = document.forms["task_form"]["password"].value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 


    if(name.length < 1){
        swal("Name is required!", "" , "error") ;
             email.focus; 
             return false; 
    }
    

    if(email.length < 1){
        swal("Email is required!", "" , "error") ;
             email.focus; 
             return false; 
    }

    if(password.length < 1){
        swal("Password is required!", "" , "error") ;
             email.focus; 
             return false; 
    }

    if(name.length < 2 || name.length > 191 ){
        swal("The name must be at least 2 characters and not be greater than 191 characters", "" , "error") ;
             email.focus; 
             return false; 
    }

    if(password.length < 6){
        swal("The password must be at least 6 characters.", "" , "error") ;
             email.focus; 
             return false; 
    }

    if (!filter.test(email1.value)) { 
             swal("Email format is incorrect. Enter again!!", "" , "error") ;
             email.focus; 
             return false; 
    }

    return true;
    
}


</script>  


