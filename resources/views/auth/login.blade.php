<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Mobo ADMIN</title>

    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="html5, template, website, responsive, bootstrap">
    <meta name="author" content="neuethemes">

    <!-- Favicon -->
    <link rel="icon" href="" sizes="32x32"/>
    <link rel="icon" href="" sizes="192x192"/>

    <!-- Main CSS with Bootstrap -->
    <link rel="stylesheet" href="assets/custom/1.0.0/css/style.min.css">

    <!-- CSS Vendor -->
    <link rel="stylesheet" href="assets/vendor/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/highlight/9.12.0/styles/default.css">

    <script src="assets/vendor/jquery/3.2.1/jquery-3.2.1.min.js"></script>
</head>
<body class="login-page dark">

<div class="container-fluid no-gutters">

    <div class="row">


        <!-- Login Form -->

        <div class="login-wrapper">

            <!-- Logo -->
            <div class="logo logo-dark px-4 pt-5 pb-2">
                <a href="/">
                    <div class="text-center text-nowrap">
                        <i class="fa fa-spin fa-play-circle mr-0 rounded-circle" aria-hidden="true"></i>
                        <h6 class="logo-title text-uppercase mt-3">Mobo.lk</h6>
                        <p class="text-muted">
                            <small>ver. 1.0.0</small>
                        </p>
                    </div>
                </a>
            </div>
            <!-- /Logo -->

            <div class="pt-4">

                <!--                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">-->
                <!--                    <li class="nav-item text-center border-0 mb-0 w-50">-->
                <!--                        <a class="nav-link border-0 active" id="login-tab" data-toggle="tab" href="#sign-in" role="tab"-->
                <!--                           aria-controls="sign-in" aria-selected="true">-->
                <!--                            <i class="fa fa-pencil-square" aria-hidden="true"></i> Login-->
                <!--                        </a>-->
                <!--                    </li>-->
                <!--                    <li class="nav-item text-center border-0 mb-0 w-50">-->
                <!--                        <a class="nav-link border-0" id="register-tab" data-toggle="tab" href="#sign-up" role="tab"-->
                <!--                           aria-controls="sign-up" aria-selected="false">-->
                <!--                            <i class="fa fa-bar-chart" aria-hidden="true"></i> Register-->
                <!--                        </a>-->
                <!--                    </li>-->
                <!--                </ul>-->

                <div class="tab-content mt-4" id="myTabContent">

                    <div class="tab-pane fade show active" id="sign-in" role="tabpanel" aria-labelledby="login-tab">

                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="loginEmail">Email address *</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       required
                                       placeholder="Enter email"
                                       autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                            </div>
                            <div class="form-group">
                                <label for="loginPassword">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                       required
                                       placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--                            <div class="form-group">-->
                            <!--                                <div class="form-check">-->
                            <!--                                    <label class="form-check-label">-->
                            <!--                                        <input type="checkbox" class="form-check-input">-->
                            <!--                                        Remember me-->
                            <!--                                    </label>-->
                            <!--                                    <span class="forgot float-right"><a href="#!">Forgot password?</a></span>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                        </form>

                    </div>

                    <!--                    <div class="tab-pane fade" id="sign-up" role="tabpanel" aria-labelledby="register-tab">-->
                    <!---->
                    <!--                        <form action="index.html">-->
                    <!--                            <div class="form-row">-->
                    <!--                                <div class="form-group col-md-6">-->
                    <!--                                    <label for="validationDefault01">First name</label>-->
                    <!--                                    <input type="text" class="form-control" id="validationDefault01"-->
                    <!--                                           placeholder="First name" required>-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group col-md-6">-->
                    <!--                                    <label for="validationDefault02">Last name</label>-->
                    <!--                                    <input type="text" class="form-control" id="validationDefault02"-->
                    <!--                                           placeholder="Last name" required>-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group col-md-12">-->
                    <!--                                    <input type="email" class="form-control" id="registerEmail1"-->
                    <!--                                           aria-describedby="emailHelp" placeholder="Enter email">-->
                    <!--                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with-->
                    <!--                                        anyone else.</small>-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group col-md-12">-->
                    <!--                                    <label>Password</label>-->
                    <!--                                    <input type="password" class="form-control" id="inputPassword"-->
                    <!--                                           placeholder="Password">-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group col-md-12">-->
                    <!--                                    <label>Repeat Password</label>-->
                    <!--                                    <input type="password" class="form-control" id="repeatPassword"-->
                    <!--                                           placeholder="Repeat Password">-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="form-group">-->
                    <!--                                <div class="form-check">-->
                    <!--                                    <label class="form-check-label">-->
                    <!--                                        <input type="checkbox" class="form-check-input">-->
                    <!--                                        I agree the Terms and Conditions-->
                    <!--                                    </label>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>-->
                    <!--                        </form>-->
                    <!---->
                    <!--                    </div>-->

                </div>


            </div>

        </div>

        <!-- /Login Form -->


    </div>
</div>

<!-- JS Common -->
<script src="assets/vendor/popper/1.12.9/popper.min.js"></script>

<!-- JS Custom -->
<script src="assets/custom/1.0.0/js/bootstrap.min.js"></script>
<script src="assets/custom/1.0.0/js/script.js"></script>
</body>
</html>
