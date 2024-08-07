<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Graphix Media CRM-Login</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('src/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/skin_color.css') }}">
    <!-- Particles.js Library -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(63, 57, 115, 0.87718837535014) 33%, rgba(46, 9, 116, 1) 100%);
            z-index: -1;
        }
    </style>
</head>

<body class="hold-transition theme-primary bg-img">
    <div id="particles-js"></div>
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary fw-600">Let's Get Started</h2>
                                <p class="mb-0 text-fade">Sign in to continue to Admin Panel.</p>
                            </div>
                            <div class="p-40">
                                <form method="POST" action="">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="text-fade ti-user"></i></span>
                                            <input type="email" class="form-control ps-15 bg-transparent" name="email" placeholder="Username" autocomplete="off">
                                            <input type="hidden" class="form-control ps-15 bg-transparent" id="datetime" name="datetimeget" placeholder="Username" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="text-fade ti-lock"></i></span>
                                            <input type="password" class="form-control ps-15 bg-transparent" name="password" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" name="submit" class="btn btn-primary w-p100 mt-10">SIGN IN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="{{ asset('src/js/vendors.min.js') }}"></script>
    <script src="{{ asset('src/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>