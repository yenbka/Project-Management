@extends('layout')

@section('content')

@include('includes.errors') 

<form id="project_form" action="{{ route('project.update', [ 'id' => $edit_project->id ]) }}" method="POST">
    {{ csrf_field() }}

<label>@lang('message.edit_project') <span><img src="/img/edit.png"></span></label>

<div class="row">
    <div class="col-md-8">
		<div class="form-group">
			<input type="text" class="form-control" id="project" name="name" value="{{ $edit_project->project_name }}" required="">
		</div>
	</div>


	<div class="col-md-4">
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="@lang('message.submit')" onclick="return validateForm()">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">@lang('message.cancel')</a>
		</div>
	</div>
</div>

</form>

@stop


