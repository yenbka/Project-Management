@extends('layout')

@section('content')


<form action="{{ route('user.update', [ 'id' => $user->id ] ) }}" method="POST">
    {{ csrf_field() }}


    <div class="col-md-8">

    	<div class="form-group">
    		<label>@lang('message.edit_name') </label>
			<input type="text" class="form-control"  name="name" value="{{ $user->name }}" required>
		</div>

    	<div class="form-group">
    		<label>@lang('message.edit_email')</label>
			<input type="text" class="form-control"  name="email" value="{{ $user->email }}" required>
		</div>
		
		<div class="form-group">
			<input type="text" class="form-control" placeholder="@lang('message.update_user_pass')" name="password">
		</div>

		<div class="form-group">
			<label>@lang('message.edit_permission') <span><img src="/img/permission.png"> </span></label>
			<select name="permission" class="form-control" value= "{{$user->permission}}">
				<option value="admin" selected>@lang('message.admin')</option>
				<option value="user">@lang('message.user')</option>
			</select>
		</div>

	</div>

	<div class="col-md-4">

		<div class="form-group">
			<label>@lang('message.edit_status') <span><img src="/img/status.png"></span></label>
			<select name="completed" class="form-control">
				@if( $user->admin == 0 )
			  		<option value="0" selected>@lang('message.not_active')</option>
			  		<option value="1">@lang('message.active')</option>
			  	@else
			  		<option value="0">@lang('message.not_active')</option>
			  		<option value="1" selected>@lang('message.active')</option>
			  	@endif
			</select>
		</div>

		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="@lang('message.submit')">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">@lang('message.go_back')</a>
		</div>

	</div>




</form>

@stop

