@extends('todo.app')
@section('content')
        @include('todo._viewstyle')            <!-- include top view-->       
         <span id="mainHeading">TaskIST</span>
        <!-- flash messages start -->
        @if (Session::has('flash_message'))
                <div class="alert alert-success ml-5 {{ Session::has('flash_message_important')? 'alert-important' : ''}}">
                {{ Session::get('flash_message')}}
                </div>
        @endif
        @if (Session::has('alert'))
                <div class="alert alert-danger">
                        {{ session('alert') }}
                        {{session()->forget('alert')}}
                </div>
        @endif
        @if (Session::has('duplicate'))
                <div class="alert alert-warning">
                        {{ session('duplicate') }}
                       {{ session()->forget('duplicate')}}
                </div>
        @endif
        @if (Session::has('flash'))
                <div class="alert alert-success">
                        {{ session('flash') }}
                       {{ session()->forget('flash')}}
                </div>
        @endif
        <!-- flash messages end -->

<!-- grid view of all tasks start -->
<div class="container gridContainer"><!--main grid container -->
    @if(count($pinned))<!-- check for pinned task -->
        <h4>Pinned</h4><hr>
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
            @if($todo->pin == 1 && $todo->archive == 0)
            <div class="grid">
                <div class="grid_count_title">
                    <div class="count" style="border:5px solid {{$todo->taskColor}};"></div>
                    <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                    <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                    <div style="display:inline-block;padding-left:15px"><a href="{{ action('TodosController@show', $todo->id ) }}" title="View"><i class="fa fa-eye" id="gridEye"></i></a></div>
                </div>
                
                <div class="gridtask"><textarea class="text" style="background:linear-gradient(45deg,{{$todo->taskColor}} 10%,rgb(239, 240, 240));">{{ $todo->task}}</textarea></div>
                <div class="gridbtn">
                                <input type='hidden' value='{{$todo->id}}' id='task_id'>
                                <input type='hidden' value='{{$todo->title}}' id='task_title'>

                    @if($todo->pin==0)    
                        <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin"></i></a>
                    @else
                        <a href="#" id="pin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin" style="color:red"></i></a>
                    @endif
                        <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                    @if($todo->reminder==1)
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell" style="color:rgb(244, 152, 66)"></i></a>   
                    @else  
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell"></i></a>
                    @endif
                    @if($todo->archive == 0)
                        <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                    @else   
                        <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                    @endif 
                    <button id="color_btn" title="Color"><i title="Color" class="fa fa-palette"></i></button>
                    <input type="color" id="grid_color"/>
                    <a  href="#" id="tasklabel" title="Labels" data-toggle="modal" data-target="#tasklab"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-tags"></i></a>
                    <a href="#" id="addcollab" class="addcollab" title="Collaborator"  data-toggle="modal" data-target="#myModal"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                    <a  href="#"  id="trash"  title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                </div>
            </div><!-- End of Grid -->
            @endif
        @endforeach
    @else    
    @endif<!-- check for pinned tasks end -->
    
    @if(count($archive))<!-- check for archive tasks-->
    <br><br>
        <h4>Archive</h4><hr> 
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
            @if($todo->archive == 1)
            <div class="grid">
                <div class="grid_count_title">
                    <div class="count" style="border:5px solid {{$todo->taskColor}};"></div>
                    <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                    <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                    <div style="display:inline-block;padding-left:15px"><a href="{{ action('TodosController@show', $todo->id ) }}" title="View"><i class="fa fa-eye" id="gridEye"></i></a></div>
                </div>
                
                <div class="gridtask"><textarea class="text" style="background:linear-gradient(45deg,{{$todo->taskColor}} 10%,rgb(239, 240, 240));">{{ $todo->task}}</textarea></div>
                <div class="gridbtn">
                                <input type='hidden' value='{{$todo->id}}' id='task_id'>
                                <input type='hidden' value='{{$todo->title}}' id='task_title'>

                    @if($todo->pin==0)    
                        <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin"></i></a>
                    @else
                        <a href="#" id="pin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin" style="color:red"></i></a>
                    @endif
                        <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                    @if($todo->reminder==1)
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell" style="color:rgb(244, 152, 66)"></i></a>   
                    @else  
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell"></i></a>
                    @endif
                    @if($todo->archive == 0)
                        <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                    @else   
                        <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                    @endif 
                    <button id="color_btn" title="Color"><i title="Color" class="fa fa-palette"></i></button>
                    <input type="color" id="grid_color"/>
                    <a  href="#" id="tasklabel" title="Labels" data-toggle="modal" data-target="#tasklab"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-tags"></i></a>
                    <a href="#" id="addcollab" class="addcollab" title="Collaborator"  data-toggle="modal" data-target="#myModal"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                    <a  href="#"  id="trash"  title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                </div>
            </div><!-- End of Grid -->
            @endif
        @endforeach
    @endif<!-- check for archivetask end-->
   
    @if(count($unpinned))<!-- check for unpinned tasks-->
    <br><br>
            @if(count($pinned) || count($archive))
            <h4>Others</h4><hr> 
            @else
            @endif  
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
            @if($todo->pin == 0 && $todo->archive == 0)
            <div class="grid">
                <div class="grid_count_title">
                    <div class="count" style="border:5px solid {{$todo->taskColor}};"></div>
                    <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                    <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                    <div style="display:inline-block;padding-left:15px"><a href="{{ action('TodosController@show', $todo->id ) }}" title="View"><i class="fa fa-eye" id="gridEye"></i></a></div>
                </div>
                
                <div class="gridtask"><textarea class="text" style="background:linear-gradient(45deg,{{$todo->taskColor}} 10%,rgb(239, 240, 240));">{{ $todo->task}}</textarea></div>
                <div class="gridbtn">
                                <input type='hidden' value='{{$todo->id}}' id='task_id'>
                                <input type='hidden' value='{{$todo->title}}' id='task_title'>

                    @if($todo->pin==0)    
                        <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin"></i></a>
                    @else
                        <a href="#" id="pin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin" style="color:red"></i></a>
                    @endif
                        <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                    @if($todo->reminder==1)
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell" style="color:rgb(244, 152, 66)"></i></a>   
                    @else  
                        <a href="#" id="snooze" title="Reminder" data-toggle="modal" data-target="#addreminder" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell"></i></a>
                    @endif
                    @if($todo->archive == 0)
                        <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                    @else   
                        <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                    @endif 
                    <button id="color_btn" title="Color"><i title="Color" class="fa fa-palette"></i></button>
                    <input type="color" id="grid_color"/>
                    <a  href="#" id="tasklabel" title="Labels" data-toggle="modal" data-target="#tasklab"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-tags"></i></a>
                    <a href="#" id="addcollab" class="addcollab" title="Collaborator"  data-toggle="modal" data-target="#myModal"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                    <a  href="#"  id="trash"  title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                </div>
            </div><!-- End of Grid -->
            @endif
        @endforeach
    @endif<!-- check for unpinned task end--> 
            
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Collaborators</h4>
          <button type="button" class="close modalclose" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
           
          <hr>
<br>
          <h5 >Add Collaborators</h5>
          <label for="" id="collabLabel">Email:</label>
          <input type="email" class="email" id="collab">
          <button type="button" class="btn" id="addCollaborator">Add</button>
          </p>
          <input  id="val" value="" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn"  data-dismiss="modal" id="modaldone">Done</button>
        </div>
      </div>
      
    </div>
  </div>


</div><!-- End of gridContainer -->

@include('todo._sideBar')
@endsection