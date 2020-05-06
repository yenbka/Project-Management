@extends('layout')

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>@lang('message.title_all_tasks')</h1>
    </div>

    <div class="col-md-6">
        <form action="{{ route('task.search') }}" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="@lang('message.search_tasks')" name="search_task">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span><img src="/img/search.png">
                            <span class="sr-only">Search...</span>
                        </span>
                    </button>
                </span>
            </div>
        </form>
    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>@lang('message.created_at')</th>
        <th>@lang('message.task_title')</th>
        <th>@lang('message.assign_project') </th>
        <th>@lang('message.priority')</th>
        <th>@lang('message.title_status')</th>
        <th>@lang('message.actions')</th>
      </tr>
    </thead>

@if ( !$tasks->isEmpty() ) 
    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ Carbon\Carbon::parse($task->created_at)->format('m-d-Y') }}</td>
        <td>{{ $task->task_title }} </td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $task->user_id )
                    <a href="{{ route('user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                @endif
            @endforeach
            <span class="label label-jc">{{ $task->project->project_name }}</span>
        </td>

        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">@lang('message.normal')</span>
            @else
                <span class="label label-danger">@lang('message.high')</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> @lang('message.mark_as_completed')</a>
                <span class="label label-danger">{{ ( $task->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @else
                <span class="label label-success">@lang('message.completed')</span>
            @endif     

        </td>
        <td>
            <a href="{{ route('task.view', ['id' => $task->id]) }}" class="btn btn-primary"><span><img src="/img/see.png"></a>
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> edit </a>  -->
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span><img src="/img/delete.png"></span></a>

        </td>
      </tr>
    @endforeach
    </tbody>

    {{ $tasks->links() }} 

@else 
    <p><em>@lang('message.message_no_tasks_yet')</em></p>
@endif


</table>
</div>


@stop