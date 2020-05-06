<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\TaskFiles;
use App\User; 
use Auth;
use Illuminate\Support\Facades\Input; 


class TaskUserController extends Controller
{
    public function index()
    {
        // dd() ;
        // $tasks = Task::all() ;  // retrieve all Tasks
        $users =  User::all() ; 
        // $tasks  = Task::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
        $id = Auth::user()->id;
        // $projects = Project::all() ;
        $tasks = Task::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        // dd($tks) ;
        // pass is_overdue
        // $today = \Carbon\Carbon::now() ; // not used
        // dd ($today) ;
        // return view('task.tasks')->with('tasks', $tasks) 
        //                          ->with('users', $users ) ;
        return view('task_user.index')->with('tasks', $tasks)
        ->with('users', $users ) ;
                                //  ->with('today', $today) ;
    }


    public function view($id)  {
        // dd($id);
       $images_set = [] ;
        $files_set = [] ;
        $images_array = ['png','gif','jpeg','jpg'] ;
        // get task file names with task_id number
        $taskfiles = TaskFiles::where('task_id', $id )->get() ;

        if ( count($taskfiles) > 0 ) { 
            foreach ( $taskfiles as $taskfile ) {

                // explode the filename into 2 parts: the filename and the extension
                $taskfile = explode(".", $taskfile->filename ) ;
                // store images only in one array
                // $taskfile[0] = filename
                // $taskfile[1] = jpg
                // check if extension is a image filetype
                if ( in_array($taskfile[1], $images_array ) ) 
                    $images_set[] = $taskfile[0] . '.' . $taskfile[1] ;
                    // if not an image, store in files array
                else
                    $files_set[] = $taskfile[0] . '.' . $taskfile[1]; 
            }
        }



        $task_view = Task::find($id) ;

        // Get task created and due dates
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->created_at);
        $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->startdate );
        $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->duedate ); // add here the due date from create task

        $current_date = \Carbon\Carbon::now();
 
        // Format dates for Humans
        $formatted_from = $from->toRfc850String();  
        $formatted_start = $start->toRfc850String();
        $formatted_to   = $to->toRfc850String();

        // Get Difference between current_date and duedate = days left to complete task
        // $diff_in_days = $from->diffInDays($to);
        $diff_in_days = $current_date->diffInDays($to);

        // Check for overdue tasks
        $is_overdue = ($current_date->gt($to) ) ? true : false ;

        // $task_view->project->project_name   will output the project name for this specific task
        // to populate the right sidebar with related tasks
        $projects = Project::all() ;
        return view('task_user.view')
            ->with('task_view', $task_view) 
            ->with('projects', $projects) 
            ->with('taskfiles', $taskfiles)
            ->with('diff_in_days', $diff_in_days )
            ->with('is_overdue', $is_overdue) 
            ->with('formatted_from', $formatted_from ) 
            ->with('formatted_to', $formatted_to )
            ->with('images_set', $images_set)
            ->with('files_set', $files_set) 
            ->with('formatted_start', $formatted_start);
    }



    public function searchTask() {
        $value = Input::get('search_task_user');
        $id = Auth::user()->id;
        $tasks = Task::where([
            ['task_title', 'LIKE', '%' . $value . '%'],
            [ 'user_id', '=', $id],
    ])->limit(25)->get();

        return view('task_user.search', compact('value', 'tasks')  ) ;
    }

    public function completed($id)
    {
        $task_complete = Task::find($id) ;
        $task_complete->completed = 1;
        $task_complete->save() ;
        return redirect()->back();
    }

}
