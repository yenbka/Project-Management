@extends('layout')

@section('content')

@include('includes.errors') 

<form name="user_form" action="{{ route('user.store') }}" method="POST" >
    {{ csrf_field() }}

    <div class="col-md-7">
    	<label>Create new User <span><img src="/img/adduser.png"></span></label>

            <div class="form-group">
                <input id="name" type="text" class="form-control" placeholder="Enter User Full Name" name="name" value="{{ old('name') }}">

            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter User Email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter User Password" name="password">
            </div>

            <div class="form-group">
			<label>Permission <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="permission" class="form-control">
				<option value="admin" selected>Admin</option>
				<option value="user">User</option>
			</select>
		</div>

	</div>

	<div class="col-md-5">
		<div class="form-group">
			<label>Set Status <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="admin" class="form-control">
				<option value="0" selected>Disabled (default)</option>
				<option value="1">Active</option>
			</select>
		</div>

		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit" onclick="return validate()">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
		</div>

	</div>



</form>

@stop

@section('scripts')

<script>
function validateForm() {
	console.log("VALIDATE FORM CLICKED") ;
	var task_title = document.forms["task_form"]["task_title"].value;

	if ( !task_title.length ) {
		swal("Task Title is required", "" , "warning") ;
		return false;
	}
}

function validate(){
	console.log("VALIDATE FORM CLICKED") ;
	var name = document.forms["user_form"]["name"].value;

	if ( !name.length ) {
		swal("Task Title is required", "" , "warning") ;
		return false;
	}
}

</script>

@stop








