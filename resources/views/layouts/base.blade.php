<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mobo ADMIN - @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="" sizes="32x32"/>
    <link rel="icon" href="" sizes="192x192"/>

    <!-- Main CSS with Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/custom/1.0.0/css/style.min.css') }}">
    <!-- Style just for doc. Remove it for your project. -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/assets/css/docs.min.css') }}">

    <!-- CSS Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/2.1.3/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/highlight/9.12.0/styles/default.css') }}">


    <link rel="stylesheet" href="{{ asset('css/jquery.fileupload.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.fileupload-ui.css') }}"/>
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/jquery.fileupload-noscript.css') }}"/>
    </noscript>
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/jquery.fileupload-ui-noscript.css') }}"/>
    </noscript>

    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">


</head>


<body class="bg-gray-100">

<div class="container-fluid no-gutters">

    <div class="row">

        <!-- Left Sidebar -->
        @include('layouts.left-sidebar')
        <!-- /Left Sidebar -->

        <!-- Main Part -->
        <div class="main-wrapper">

            <!-- Top Toolbar -->
            <div class="navbar navbar-light bg-white px-3 px-sm-5 py-3">
                <div class="d-inline-block mr-3">
                    <a href="#" data-target="#sidebar-left" data-toggle="collapse-width"
                       class="btn btn-dark btn-icon rounded-circle shadow-00">
                        <i class="fa fa-navicon"></i>
                    </a>
                </div>

                <form class="search-form form-inline my-2 my-lg-0">
                    <div class="input-group input-group-built-in">
                        <input type="text" class="form-control rounded-1" placeholder="Search for something..."
                               aria-label="Search for something...">
                        <span class="input-group-btn">
                  <a href="#" class="btn btn-icon">
                    <i class="fa fa-search"></i>
                  </a>
                </span>
                    </div>
                </form>

                <ul class="nav ml-auto">

                    <li class="m-sm-1 m-md-2 position-relative">
                        <a data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="d-inline-block mr-2">
                                <img src="assets/custom/1.0.0/images/03.jpg" class="rounded-circle" height="32px">
                            </div>
                            <div class="d-none d-lg-inline-block">
                                <span class="d-block">{{ Auth::user()->name }}</span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>

                    </li>

                </ul>

            </div>
            <!-- /Top Toolbar -->

            <!-- Main Content -->
            <main>

                <div class="row pl-5 pr-5 pt-5 pb-5 no-gutters">

                    <div class="col-md-12">
                        <h2>{{ $data['title'] }}</h2>
                        <a href="#">Home</a> / <strong>{{ $data['title'] }}</strong>
                    </div>

                </div>


                <div class="content-wrapper container-fluid px-5 mb-4 trans-03-in-out">

                    <div class="row">

                        <div class="col-lg-12 mb-3">
                            <section class="widget shadow-01 mb-4" id="widget-01">
                                <div class="widget-block">

                                    <div class="content">
                                        @yield('content')
                                    </div>


                                </div>
                            </section>
                        </div>


                    </div>

                </div>

            </main>
            <!-- /Main Content -->
            <!-- Footer -->
            <footer class="bg-white w-100 pl-5 pr-5 pt-4 pb-4 mt-auto">
                <div>Mobo.Lk © 2020</div>
            </footer>
            <!-- /Footer -->

        </div>
        <!-- /Main Part -->

        <!-- Right Sidebar -->
        <div id="sidebar-right" class="sidebar-right">

            <div class="sidebar-container">

                <ul class="nav nav-tabs nav-tabs-dark" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#notes" role="tab" aria-controls="notes"
                           aria-selected="true">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i> Notes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks"
                           aria-selected="false">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> Tasks
                        </a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="notes" role="tabpanel" aria-labelledby="notes-tab">

                        <div class="p-4">
                            <h5 class="tab-title">6 Notes Received</h5>
                            <p class="mb-0">
                                Lorem ipsum dolor sit amet
                            </p>
                        </div>

                        <ul class="list-unstyled list-striped">

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/02.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3" alt="Martin Schultze">
                                <div class="media-body">
                                    <a href="#!">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et quam elit.
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div>
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/03.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3">
                                <div class="media-body">
                                    <a href="#!">
                                        Donec sed magna nec lorem feugiat tincidunt eget nec tortor.
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div class="">
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/04.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3">
                                <div class="media-body">
                                    <a href="#!">
                                        Curabitur rutrum, orci et ultrices malesuada, tortor dolor sodales felis
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div class="">
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/05.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3">
                                <div class="media-body">
                                    <a href="#!">
                                        Vivamus accumsan, urna vel malesuada congue, odio quam vestibulum dolor
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div class="">
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/06.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3">
                                <div class="media-body">
                                    <a href="#!">
                                        Phasellus porttitor sit amet ligula vitae elementum. Mauris auctor sollicitudin
                                        nibh
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div class="">
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-3">
                                <img src="assets/custom/1.0.0/images/07.jpg" height="44px"
                                     class="rounded-circle d-flex mr-3">
                                <div class="media-body">
                                    <a href="#!">
                                        Etiam quis dui et mauris posuere semper ut sed libero. Etiam aliquam, quam quis
                                        sodales
                                        <span class="text-muted d-block mb-2"><small>Nov 07, 2017</small></span>
                                    </a>
                                    <div class="">
                                        <a href="#!" class="btn btn-icon-sm btn-danger rounded-circle"><i
                                                class="fa fa-times" aria-hidden="true"></i></a>
                                        <a href="#!" class="btn btn-icon-sm btn-success rounded-circle"><i
                                                class="fa fa-check" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">

                        <div class="p-4">
                            <h5 class="tab-title">6 Tasks are Active</h5>
                            <p class="mb-0">
                                Lorem ipsum dolor sit amet
                            </p>
                        </div>

                        <ul class="list-unstyled list-striped">

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Meeting at 6PM</h6>
                                            <span class="badge badge-primary text-uppercase">New</span>
                                        </div>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et quam elit.
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Annual Report</h6>
                                            <span class="text-muted"><small>12 days ago</small></span>
                                        </div>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et quam elit.
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 86%;"
                                             aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Landing Page Design</h6>
                                            <span class="text-muted"><small>12 days ago</small></span>
                                        </div>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                            et quam elit.</p>
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar" role="progressbar" style="width: 86%;"
                                             aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Meeting at 6PM</h6>
                                            <span class="text-muted"><small>6 hrs ago</small></span>
                                        </div>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et quam elit.
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Annual Report</h6>
                                            <span class="text-muted"><small>12 hrs ago</small></span>
                                        </div>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et quam elit.
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 86%;"
                                             aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="media d-flex pl-4 pr-4 pt-3 pb-4">
                                <div class="media-body">
                                    <a href="#!">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 mr-4">Landing Page Design</h6>
                                            <span class="text-muted"><small>18 hrs ago</small></span>
                                        </div>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                            et quam elit.</p>
                                    </a>
                                    <div class="progress mt-3" style="height: 2px;">
                                        <div class="progress-bar" role="progressbar" style="width: 86%;"
                                             aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>
        <!-- /Right Sidebar -->

    </div>
</div>

<!-- JS Common -->
<script src="assets/vendor/popper/1.12.9/popper.min.js"></script>
<script src="assets/vendor/toastr/2.1.3/toastr.min.js"></script>
<script src="assets/vendor/highlight/9.12.0/highlight.pack.js"></script>
<script>
    function readURL(input) {
        var Thisinput = $(input)
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                Thisinput.closest('.file-upload').find('.image-upload-wrap').hide();

                Thisinput.closest('.file-upload').find('.file-upload-image').attr('src', e.target.result);
                Thisinput.closest('.file-upload').find('.file-upload-content').show();

                Thisinput.closest('.file-upload').find('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });

</script>

<!-- JS Page -->
<script src="assets/vendor/chartjs/2.7.0/chart.min.js"></script>

<!-- JS Custom -->
<script src="assets/custom/1.0.0/js/bootstrap.min.js"></script>
<script src="assets/custom/1.0.0/js/script.js"></script>
<script src="assets/custom/1.0.0/js/source-code.js"></script>
</body>


@section('js')
<!-- jQuery Plugins -->
<script src="{{ asset('assets/vendor/jquery/3.2.1/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper/1.12.9/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/2.1.3/toastr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/highlight/9.12.0/highlight.pack.js') }}"></script>

<!-- JS Page -->
<script src="{{ asset('assets/vendor/chartjs/2.7.0/chart.min.js') }}"></script>

<!-- JS Custom -->
<script src="{{ asset('assets/custom/1.0.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/custom/1.0.0/js/script.js') }}"></script>
<script src="{{ asset('assets/custom/1.0.0/js/source-code.js') }}"></script>

@show


</html>

