
  <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ URL:: asset ('assets/img/profile_small.jpg')}}" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                @foreach ($menu as $item)
                <li>
                    @if ($item->induk == "head")
                    <a href="/{{$item->route}}"><i class="fa fa-th-large"></i> <span class="nav-label text-uppercase">{{$item->kode_menu}}. {{$item->nama_menu}}</span><span class ="{{$item->route ? : 'fa arrow' }}"></span></a>
                    @endif
                    @if ($item->route == "")
                    <ul class="nav nav-second-level collapse">
                        @foreach($menu as $sm)
                        @if ( $sm->induk == $item->nama_menu )
                            <li><a href="{{$sm->route}}" class="text-capitalize">{{$sm->kode_menu}}. {{$sm->nama_menu}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                    
                </li>
                @endforeach

                <li>
                    <a href="{{URL::route('adm-menu.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label ">ADM MENU</span></span></a>
                </li>
                <li>
                    <a href="{{URL::route('adm-role-menu.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label ">ADM ROLE MENU</span></span></a>
                </li>

                
            </ul>

        </div>
    </nav>