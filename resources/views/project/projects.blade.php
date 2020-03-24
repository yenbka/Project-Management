@extends('layout')

@section('content')


<h1>@lang('message.title_project')</h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;@lang('message.add_project')</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('message.enter_project')</h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('project.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" id="project" name="project" required="">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="@lang('message.submit')" >
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('message.close')</button>
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>@lang('message.project_name')</th>
        <th>@lang('message.project_task_list')</th>
        <th>@lang('message.actions')</th>
      </tr>
    </thead>

@if ( !$projects->isEmpty() ) 
    <tbody>
    @foreach ( $projects  as $project)
      <tr>
        <td>{{ $project->project_name }} </td>
        <td>
           <a href="{{ route('task.list', [ 'projectid' => $project->id ]) }}">@lang('message.list_all_tasks')</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('project.edit', [ 'id' => $project->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>          
          <a class="btn btn-danger" href="{{ route('project.delete', [ 'id' => $project->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;
        </td>

      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>@lang('message.message_no_tasks_yet')</em></p>
@endif


</table>
</div>




@stop


<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Project will also delete all tasks associated with this project");
  if (x)
      return true;
  else
    return false;
}




</script>  
