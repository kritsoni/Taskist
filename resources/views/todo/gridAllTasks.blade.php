@extends('todo.app')
@section('content')
        @include('todo._viewstyle')            <!-- include top view-->       
         <span id="mainHeading">Todo App</span>
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
                <div class="grid">                  <!-- first div-->
                    <div class="grid_count_title">  <!-- second div-->
                        <div class="count"></div>
                        <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                        <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                    </div>                          <!-- end second div-->
                    <div class="gridtask"><textarea >{{ $todo->task}}</textarea></div>
                    <div class="gridbtn">           <!--third div -->
                                    <input type='hidden' value={{$todo->id}} id='task_id'>
                                    <input type='hidden' value={{$todo->title}} id='task_title'>

                        @if($todo->pin==0)    
                            <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin"></i></a>
                        @else
                            <a href="#" id="pin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin" style="color:red"></i></a>
                        @endif
                            <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                            <a href="#" id="snooze" title="Snooze" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-clock"></i></a>
                        @if($todo->archive == 0)
                            <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                        @else   
                            <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                        @endif 
                        <i class="fa fa-palette"></i>
                            <a href="#" id="addcollab" class="addcollab" title="Collaborator" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                            <a  href="#"  id="trash"  title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                    </div>                         <!-- end third div-->
                </div>                             <!-- End of first div -->
            @endif
        @endforeach
    @else    
    @endif<!-- check for pinned tasks end -->
    <br><br>
    @if(count($archive))<!-- check for archive tasks-->
        <h4>Archive</h4><hr> 
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
            @if($todo->archive == 1)
                <div class="grid">
                        <div class="grid_count_title">
                            <div class="count"></div>
                            <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                            <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                        </div>
                        <div class="gridtask"><textarea >{{ $todo->date_created}}</textarea></div>
                        <div class="gridbtn">
                                        <input type='hidden' value={{$todo->id}} id='task_id'>
                                        <input type='hidden' value={{$todo->title}} id='task_title'>

                            @if($todo->pin==0)    
                                <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack" id="pin"></i></a>
                            @else
                                <a href="#" id="Unpin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack" id="pin" style="color:red"></i></a>
                            @endif
                                <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                                <a href="#" id="snooze" title="Reminder"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell"></i></a>
                            @if($todo->archive == 0)
                                <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                            @else   
                                <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                            @endif 
                                <i class="fa fa-palette"></i>
                                <a class="addcollab" href="#"   id="addcollab"  title="Collaborator" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                                <a  href="#" id="trash" title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                        </div>
                </div>
            @endif
        @endforeach
    @endif<!-- check for archivetask end-->
    <br><br>
    @if(count($unpinned))<!-- check for unpinned tasks-->
            @if(count($pinned))
            <h4>Others</h4><hr> 
            @else
            @endif  
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
            @if($todo->pin == 0 && $todo->archive == 0)
                <div class="grid">
                    <div class="grid_count_title">
                        <div class="count"></div>
                        <span id="gridnum"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                        <div class="gridtitle"><input type="text" value='{{ $todo->title}}'></div>
                    </div>
                    <div class="gridtask"><textarea >{{ $todo->date_created}}</textarea></div>
                    <div class="gridbtn">
                                    <input type='hidden' value={{$todo->id}} id='task_id'>
                                    <input type='hidden' value={{$todo->title}} id='task_title'>

                        @if($todo->pin==0)    
                            <a href="#" id="pin" title="Pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack" id="pin"></i></a>
                        @else
                            <a href="#" id="Unpin" title="Unpin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack" id="pin" style="color:red"></i></a>
                        @endif
                            <a href="{{ action('TodosController@edit', $todo->id ) }}" id="edit" title="Edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i></a>
                            <a href="#" id="snooze" title="Reminder"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-bell"></i></a>
                        @if($todo->archive == 0)
                            <a href="#" id="archive" title="Archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i></a>
                        @else   
                            <a href="#" id="unarchive" title="Unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i></a>
                        @endif 
                        <i class="fa fa-palette"></i>
                            <a class="addcollab" href="#"   id="addcollab"  title="Collaborator" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i></a>
                            <a  href="#" id="trash" title="Trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i></a>
                    </div>
                </div>
            @endif
        @endforeach
    @endif<!-- check for unpinned task end--> 
            
</div><!-- main grid cont. end-->
<!-- grid view of all tasks end -->
@include('todo._sideBar')                    <!--include side bar -->       
@endsection