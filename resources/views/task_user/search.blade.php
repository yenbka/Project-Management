@extends('layout')

@section('content')


<h1>@lang('message.display_results_search') "{{ $value }}" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>@lang('message.task_title')</th>
        <th>@lang('message.priority')</th>
        <th>@lang('message.title_status')</th>
        <th>@lang('message.actions')</th>
      </tr>
    </thead>

@if ( !$tasks->isEmpty() ) 
    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ $task->task_title }} </td>
        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">@lang('message.normal')</span>
            @else
                <span class="label label-danger">@lang('message.high')</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('taskuser.completed', ['id' => $task->id]) }}" class="btn btn-warning"> @lang('message.mark_as_completed')</a>
            @else
                <span class="label label-success">@lang('message.completed')</span>
            @endif
        </td>
        <td>
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> edit </a> -->
            <a href="{{ route('taskuser.view', ['id' => $task->id]) }}" class="btn btn-primary"><span><img src="/img/see.png"></span></a>
            <!--
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
-->
        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>@lang('message.no_match_found')</em></p>
@endif


</table>



    <div class="btn-group">
        <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">@lang('message.go_back')</a>
    </div>



@stop