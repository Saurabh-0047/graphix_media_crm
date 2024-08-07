<aside class="main-sidebar">
    <section class="sidebar position-relative"> 
        <div class="multinav">
            <div class="multinav-scroll" style="height: 97%;">    
                <ul class="sidebar-menu" data-widget="tree">
                    <li><a href="{{ url('admin/dashboard') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard</a></li>

                    <li class="treeview">
                        <a href="#">
                            <i data-feather="grid"></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>          
                        <ul class="treeview-menu">          
                        <li><a href="{{ url('admin/user_designation') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Designations</a></li>    
                        <li><a href="{{ url('admin/users') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Users</a></li>
                            <li><a href="{{ url('admin/table') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Table</a></li>
                        </ul>
                    </li> 
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
