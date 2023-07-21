<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Admin Desa Krimun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ url('login/images/Indramayu.png') }}">
    <link rel="stylesheet" href="{{ url('login') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('login') }}/css/typography.css">
    <link rel="stylesheet" href="{{ url('login') }}/css/default-css.css">
    <link rel="stylesheet" href="{{ url('login') }}/css/styles.css">
    <link rel="stylesheet" href="{{ url('login') }}/css/responsive.css">
    <link rel="stylesheet" href="{{ url('login') }}/css/themify-icons.css">
    <!-- modernizr css -->
    <script src="{{ url('login') }}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ url('siteman/login') }}" method="post">

                    @csrf
                    <div class="login-form-head" style="background-color: green">
                        <h4>Login Admin</h4>
                        <img src="{{ url('login/images/Indramayu.png') }}" class="navbar-brand-img" alt="..."
                            width="100">
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="email">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Captcha</label>
                            <input name="captcha" id="exampleInputPassword1" value="{{ old('captcha') }}"
                                type="text">
                            <div class="mt-3">{!! captcha_img() !!}</div>
                            <div class="text-danger"></div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember
                                        Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Masuk<i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="{{ url('login') }}/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('login') }}/js/popper.min.js"></script>
    <script src="{{ url('login') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('login') }}/js/owl.carousel.min.js"></script>
    <script src="{{ url('login') }}/js/metisMenu.min.js"></script>
    <script src="{{ url('login') }}/js/jquery.slimscroll.min.js"></script>
    <script src="{{ url('login') }}/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="{{ url('login') }}/js/plugins.js"></script>
    <script src="{{ url('login') }}/js/scripts.js"></script>
</body>

</html>
