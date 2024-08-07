<body class="hold-transition  sidebar-mini theme-primary fixed">
	<div class="wrapper">
		<header class="main-header">
			<div class="d-flex align-items-center logo-box justify-content-start">
				<a href="{{ url('admin/dashboard') }}" class="logo"></a>
			</div>
			<nav class="navbar navbar-static-top">
				<div class="app-menu">
					<ul class="header-megamenu nav" >
						<li class="btn-group nav-item">
							<a href="#"  class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
								<i data-feather="menu"></i>
							</a>
						</li>

					</ul>
				</div>
				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav">
						<li class="btn-group d-md-inline-flex d-none">
							<label class="switch" >
								<span class="waves-effect skin-toggle waves-light">
									<input type="checkbox" data-mainsidebarskin="toggle" id="toggle_left_sidebar_skin">
									<span class="switch-on" onclick="darktolight('dark')" ><i data-feather="moon"></i></span>
									<span class="switch-off" onclick="darktolight('light')" ><i data-feather="sun"></i></span>
								</span>
							</label>
						</li>

						<li class="btn-group nav-item d-xl-inline-flex d-none">
							<a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent p-0 no-shadow">
								<img src="{{ asset('/images/avatar/avatar-13.png') }}" class="avatar rounded bg-primary-light" alt="" />
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</header> 
		<div class="control-sidebar-bg"></div>