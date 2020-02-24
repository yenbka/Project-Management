@extends('layout')

@section('content')

<!--
<strong>Debug vars:</strong><br>
task_view->project->id :  {{ $task_view->project->id }} <br>
task_view->project->project_name: {{ $task_view->project->project_name }}  <br>
task_view->id: {{ $task_view->id }}<br>
-->


<div class="col-md-8">
    <h1>{{ $task_view->task_title }}</h1>

    <div class="form-group">
        <label>@lang('message.description')</label>
        <p>{!! $task_view->task !!}</p>
    </div>
        

    <div class="btn-group">
        <!--
        <a href="{{ route('task.edit', ['id' => $task_view->id ]) }}" class="btn btn-primary" disable> Edit </a>
    -->
        <a class="btn btn-default" href="{{ route('taskuser.show') }}">@lang('message.go_back')</a>
</div>

    <div class="row">
        <hr>
        @if( count($images_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">@lang('message.upload_files')</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $images_set as $image )
                                <li> 
                                    <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


        
        @if( count($files_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading"> @lang('message.upload_files')</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $files_set as $file )
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/$file") ; ?>">{{ $file }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


    </div>



</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.project_name')</div>
        <div class="panel-body">
            <span class="label label-jc">
                <a href="{{ route('task.list', [ 'projectid' => $task_view->project->id ]) }}">{{ $task_view->project->project_name }}</a>
            </span>
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.priority')</div>
        <div class="panel-body">
            @if ( $task_view->priority == 0 )
                <span class="label label-info">@lang('message.normal')</span>
            @else
                <span class="label label-danger">@lang('message.high')</span>
            @endif
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.created_at')</div>
        <div class="panel-body">
            {{ $formatted_from }} 
        </div>
    </div>

     <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.start_date')</div>
        <div class="panel-body">
            {{ $formatted_start }} 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.due_date')</div>
        <div class="panel-body">
            {{ $formatted_to }} 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading">@lang('message.title_status')</div>
        <div class="panel-body">
            @if ( $task_view->completed == 0 )
                <span class="label label-warning">@lang('message.open')</span>
                @if ( $is_overdue )
                    <span class="label label-danger">@lang('message.overdue')</span>
                @else
                    <p><br>{{ $diff_in_days }} @lang('message.day_left_to_complete')</p>
                @endif                
            @else
                <span class="label label-success">@lang('message.closed')</span>
            @endif
        </div>
    </div>

</div>

@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop


@section('scripts')
    <script src="{{ asset('js/lightbox.min.js') }}"></script>  

@stop


