<body class="hold-transition  sidebar-mini theme-primary fixed">
	<style>
		.notification-badge {
			position: absolute;
			top: 2px;
			right: -10px;
			height: 28px;
			width: 28px;
			background-color: red;
			color: white;
			border-radius: 50%;
			padding: 7px 5px;
			font-size: 12px;
			font-weight: bold;
			line-height: 1;
			min-width: 20px;
			z-index: 1;
		}
		.notification-box {
  position: absolute;
  top: 50px;
  right: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  max-height: 300px;
  overflow-y: auto;
  width: 532px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.notification {
  padding: 10px;
  border-bottom: 1px solid #ccc;
  word-break: break-all;
  max-width: 100%; /* Ensures the notification does not exceed the box width */
  white-space: pre-line; /* Handles line breaks */
}

.notification:last-child {
  border-bottom: none;
}

	</style>
	<div class="wrapper">
		<header class="main-header">
			<div class="d-flex align-items-center logo-box justify-content-start">
				<a href="{{ url('admin/dashboard') }}" class="logo"></a>
			</div>
			<nav class="navbar navbar-static-top">
				<div class="app-menu">
					<ul class="header-megamenu nav">
						<li class="btn-group nav-item">
							<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
								<i data-feather="menu"></i>
							</a>
						</li>

					</ul>
				</div>
				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav">
						<li class="btn-group d-md-inline-flex d-none">
							<label class="switch">
								<span class="waves-effect skin-toggle waves-light">
									<input type="checkbox" data-mainsidebarskin="toggle" id="toggle_left_sidebar_skin">
									<span class="switch-on" onclick="darktolight('dark')"><i data-feather="moon"></i></span>
									<span class="switch-off" onclick="darktolight('light')"><i data-feather="sun"></i></span>
								</span>
							</label>
							<label class="switch" style="margin-top: 26%;" >
								<span class="">
									<span><i data-feather="bell"></i></span>
								</span>
								<span class="notification-badge" onclick="show_notifications()"> <span id="unreadCount">0</span></span>
							</label>

							<div id="notificationBox" class="notification-box" style="display: none;">
							</div>
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