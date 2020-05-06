@extends('layout')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@stop


@section('content')


<form action="{{ route('task.update', [ 'id' => $task->id ] ) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
	<input type="hidden" name="task_id" value="{{ $task->id }}">

<!--
    @foreach( $projects as $project)
    <hr>
    	<strong>Project Name: </strong> {{ $project->project_name }} 
    	<strong>Project ID: </strong> {{ $project->id }} 
    	<strong>Task->Project->ID: </strong> {{  $task->project->id }}

    <hr>
    @endforeach
-->


    <div class="col-md-8">

    	<div class="form-group">
    		<label>@lang('message.edit_task_title')</label>
			<input type="text" class="form-control"  name="task_title" value="{{ $task->task_title }}">
		</div>

		<div class="form-group">
        <label>@lang('message.add_project_files') (png,gif,jpeg,jpg,txt,pdf,doc) <span><img src="/img/file.png"></span></label>
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	<div class="form-group">
    		<label>@lang('message.edit_task')</label>
			<textarea class="form-control my-editor" rows="5" id="task" name="task">{{ $task->task }}</textarea>
		</div>

		<div class="form-group">
		@if( count($taskfiles) > 0  )
		<label>@lang('message.files')</label>
		<ul class="fileslist">
           	@foreach( $taskfiles as $file) 
			    <li>{{ $file->filename }} <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="{{ route('task.deletefile', [ 'id' => $file->id]) }}">
			   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</li>
			@endforeach
		</ul>
		@endif
       	</div>

	</div>

	<div class="col-md-4">


        <div class="form-group">
			 <label>@lang('message.assign_to') <span><img src="/img/assign.png"></span></label>

              <select name="user_id" id="user_id" class="form-control">
                    @foreach( $users as $user)
                        <option value="{{ $user->id }}" 
                          @if( $task->user->id == $user->id )
                                selected
                          @endif
                          >{{ $user->name }}
                      	</option>
                    @endforeach
              </select>
        </div>

        <div class="form-group">
			 <label>@lang('message.assign_to_project') <span><img src="/img/assignproject.png"></span></label>

              <select name="project_id" id="project_id" class="form-control">
                    @foreach( $projects as $project)
                        <option value="{{ $project->id }}" 
                          @if( $task->project->id == $project->id )
                                selected
                          @endif
                          >{{ $project->project_name }}
                      	</option>
                    @endforeach
              </select>
        </div>

	
		<div class="form-group">
			<label>@lang('message.edit_priority') <span><img src="/img/priority.png"></span></label>
			<select name="priority" class="form-control">
				@if( $task->priority == 0 )
			  		<option value="0" selected>@lang('message.normal')</option>
			  		<option value="1">@lang('message.high')</option>
			    @else
			  		<option value="0">@lang('message.normal')</option>
			  		<option value="1" selected>@lang('message.high')</option>
			  	@endif
			</select>
		</div>

		<div class="form-group">
			<label>@lang('message.edit_status') <span><img src="/img/status.png"></span></label>
			<select name="completed" class="form-control">
				@if( $task->completed == 0 )
			  		<option value="0" selected>@lang('message.not_completed')</option>
			  		<option value="1">@lang('message.completed')</option>
			  	@else
			  		<option value="0">@lang('message.not_completed')</option>
			  		<option value="1" selected>@lang('message.completed')</option>
			  	@endif
			</select>
		</div>

    <div class="form-group">
            <label>@lang('message.edit_sd')</label>
     
                <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" name="startdate" value="{{ $task->startdate }}">
          <span class="input-group-addon">
          <span><img src="/img/calendar.png">
          </span>
        </div>
        </div>


        <div class="form-group">
            <label>@lang('message.edit_dd')</label>
     
                <div class='input-group date' id='datetimepicker2'>
					<input type='text' class="form-control" name="duedate" value="{{ $task->duedate }}">
					<span class="input-group-addon">
				<span><img src="/img/calendar.png">
          </span>
					</span>
				</div>
        </div>
		


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">@lang('message.go_back') </a>
		</div>

	</div>




</form>

@stop



@section('scripts')

    <script src="{{ asset('js/moment.js') }}"></script> 

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>

		jQuery('#datetimepicker1').datetimepicker( {
			defaultDate:'now',  // defaults to today
			format: 'YYYY-MM-DD hh:mm:ss'   // YEAR-MONTH-DAY hour:minute:seconds
			// minDate:new Date()  // Disable previous dates, minimum is todays date
		});

	</script>

  <script>

    jQuery('#datetimepicker2').datetimepicker( {
      defaultDate:'now',  // defaults to today
      format: 'YYYY-MM-DD hh:mm:ss'   // YEAR-MONTH-DAY hour:minute:seconds
      // minDate:new Date()  // Disable previous dates, minimum is todays date
    });

  </script>

<script>
  var editor_config = {
    //path_absolute : "/",
    path_absolute:"{{ url('/') }}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    },

    //  Add Bootstrap Image Responsive class for inserted images
    image_class_list: [
        {title: 'None', value: ''},
        {title: 'Bootstrap responsive image', value: 'img-responsive'},
    ]

  };

  tinymce.init(editor_config);
</script>
 



@stop
