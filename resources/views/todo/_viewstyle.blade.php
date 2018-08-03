<div class="viewWrapper">
        
        <a href="/">
                <button type="button" class="btn viewtype" title="List View"><i class="fa fa-list-ul"></i> </button>
        </a>
        <a href="{{action('TodosController@gridview')}}">
                <button type="button" class="btn viewtype" title="Grid View" >
                 <i class="fa fa-th-large"></i> </button>
        </a> 
        <a href="{{action('TodosController@gridview')}}">
                <button type="button" class="btn viewtype" title="Notification" >
                 <i class="fa fa-bell"></i></button>
        </a>
        <ul class="navbar-nav ml-auto" >
                <!-- Authentication Links -->
                @guest
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color:white; font-weight:bold;">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" style="color:white; font-weight:bold;">{{ __('Register') }}</a>
                        </li>
                @else
                        <li class="nav-item dropdown">
                        <a style="color:rgb(243, 114, 114);font-weight:bold;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                        </div>
                        </li>
                @endguest
        </ul>        
       
 </div>