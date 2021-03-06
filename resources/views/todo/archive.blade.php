@extends('todo.app')

@section('content')
        @include('todo._viewstyle')
        <span id="mainHeading">TaskIST</span>
        @if (Session::has('flash_message'))
                <div class="alert alert-success ml-5 {{ Session::has('flash_message_important')? 'alert-important' : ''}}">
                {{ Session::get('flash_message')}}
                </div>
        @endif
        @if (session('alert'))
                <div class="alert alert-success">
                        {{ session('alert') }}
                </div>
        @endif

@if(count($todos))
        <h4>Archive</h4><hr>
        <?php $count = 1; ?>
        @foreach($todos as $todo) 
                <div class="row">
                        <div class='panel container' style="background:linear-gradient(90deg,rgb(19, 71, 71)10%,rgb(239, 240, 240))"> 
                                <div class="dropdown" >
                                        <div class="btn-group">
                                                <button type="button" id="ellipsis" class="btn vanishOutline" data-toggle="dropdown" style="background:none;border:none; outline:none"><i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                
                                                <div class="dropdown-menu">
                                                <input type='hidden' value='{{$todo->id}}' id='task_id'>
                                                <input type='hidden' value='{{$todo->title}}' id='task_title'>

                                                    @if($todo->pin==0)  
                                                        <a class="dropdown-item" id="pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin"></i> Pin</a>
                                                    @else
                                                        <a class="dropdown-item" id="pin"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-thumb-tack"  id="pin" style="color:red"></i> Unpin</a>
                                                    @endif
                                                        <a class="dropdown-item" href="{{ action('TodosController@edit', $todo->id ) }}" id="edit"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-edit" id="edit"></i> Edit</a>
                                                        <a class="dropdown-item" id="snooze"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-clock"  id="snooze"></i> Snooze</a>
                                                        <a class="dropdown-item" id="tasklabel" data-toggle="modal" data-target="#tasklab"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fas fa-tags"></i> Labels</a>
                                                @if($todo->archive == 0)
                                                        <a class="dropdown-item" id="archive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="archive"></i> Archive</a>
                                                    @else   
                                                        <a class="dropdown-item" id="unarchive"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-archive" id="unarchive" style="color:rgb(244, 152, 66)"></i> Unarchive</a>
                                                    @endif 
                                                        <a class="dropdown-item addcollab   " href="#"   id="addcollab" ><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-user-plus"></i> Add Collaborator</a>
                                                        <a class="dropdown-item" id="trash"><div hidden style="display:inline-block">{{$todo->id}}</div><i class="fa fa-trash"  ></i> Delete</a>

                                                </div>
                                        </div>       
                                </div>  


                                <div class="circle"></div><span id="span1"><?php if($count<=9)echo "0".$count++;else echo $count++; ?></span>
                                <div class="wrapper">
                                        <div class="todo-title-in-panel"><h3><a href="/todo/{{$todo->id}}/show">{{$todo->title}}</a></h3></diV>
                                        <span id="span2" >&#x25cf; {{$todo->completion_date}}</span>
                                </div>
                                
                        </div><!-- End of Panel -->
                </div> <!-- End of Row -->
        @endforeach
@else
     <h4 id="notFoundAlert">{{$message}}</h4>
@endif

@include('todo._sideBar')
@endsection
