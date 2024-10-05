<!doctype html>
<html lang="en">
<head>

        <meta charset="utf-8" />
        <title>Admin & Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" Admin & Dashboard" name="description" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/admin')}}/assets/images/favicon.ico"> 
        
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/admin')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/admin')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/admin')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
							<div class="card-body pt-0">

                                <div class="ex-page-content text-center">
                                    <h1 class="text-dark">403!</h1>
                                    <h3 class="">Không có quyền truy cập</h3>
                                    <br>

                                    <a class="btn btn-info mb-4 waves-effect waves-light" href="{{route('dashboard-logout')}}"><i class="mdi mdi-home"></i> Đăng xuất</a>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            @<script>document.write(new Date().getFullYear())</script> Admin Dashboard
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/admin')}}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{asset('assets/admin')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/admin')}}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{asset('assets/admin')}}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{asset('assets/admin')}}/assets/libs/node-waves/waves.min.js"></script>
        <script src="{{asset('assets/admin')}}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <!-- App js -->
        <script src="{{asset('assets/admin')}}/assets/js/app.js"></script>
    </body>
</html>