<aside class="main-sidebar">
    <section class="sidebar position-relative"> 
        <div class="multinav">
            <div class="multinav-scroll" style="height: 97%;">    
                <ul class="sidebar-menu" data-widget="tree">
                    <li><a href="{{ url('user/dashboard') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard</a></li>

                    <li class="treeview">
                        <a href="#">
                            <i data-feather="grid"></i>
                            <span>Projects</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>          
                        <ul class="treeview-menu">          
                        <li><a href="{{ url('user/all_projects') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>All Projects</a></li>    
                        <li><a href="{{ url('user/in_progress_projects') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>In Progress</a></li>
                            <li><a href="{{ url('user/pending_projects') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pending</a></li>
                            <li><a href="{{ url('user/completed_projects') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Completed</a></li>
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
