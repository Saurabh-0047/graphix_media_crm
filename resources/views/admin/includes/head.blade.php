<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('/src/css/vendors_css.css') }}">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/x-icon">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('/src/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/src/css/skin_color.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" ></script>

       <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="user-id" content="{{ Auth::user()->user_id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
  </head>
