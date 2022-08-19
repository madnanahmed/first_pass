@extends('layouts.app_guest')
@section('content')

    <link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .page_slider{position: relative}
        #search_modal .btn{
            font-size: 15px;
            padding: 10px;
            margin-right: 5px;
        }
        #search_modal .close{ top: 0px; right: 15px }
        #learner-price-table {
            -webkit-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border-radius: 10px;
            border: 2px solid #212A37;
            background: white;
            margin: 20px 0;
            padding: 0 3px;
        }
    </style>

    <section class="page_slider">
        <div style="
    height: 300px;
    background: white;
    position: absolute;
    right: 10vh;
    z-index: 99;
    top: 2vh;
    padding: 15px 25px;
">
            <form action="" id="searchForm">
                <input type="hidden" name="search_type" value="1">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="mb-2"><span class="color-main">Find</span> a driving instructor</h6>
                        <p class="text-dark">Including availability, pricing & bookings</p>
                        <div class="divider-sm-0 divider-md-30"></div>
                        <div class="form-group type">
                            <button onclick="$(this).find('input').prop('checked', true); $('i.ato').removeClass('hidden'); $('i.mnl').addClass('hidden');" type="button" id="contact_form_submit active" class="btn btn-outline-darkgrey">
                                <input type="radio" name="type" value="auto" @if($search_id)  @if($search->t_type == "auto") checked @endif   @else checked @endif class="hidden">
                                <i class="fa fa-check text-success ato @if($search_id)  @if($search->t_type == "manual") hidden @endif @endif"></i> AUTO
                            </button>

                            <button onclick="$(this).find('input').prop('checked', true); $('i.mnl').removeClass('hidden'); $('i.ato').addClass('hidden');" type="button" id="contact_form_submit" class="btn btn-outline-darkgrey">
                                <input type="radio" name="type" value="manual" class="hidden" @if($search_id)  @if($search->t_type == "manual") checked @endif @endif>
                                <i class="fa fa-check text-success @if($search_id)  @if($search->t_type == "auto") hidden @endif @else hidden @endif mnl"></i>
                                MANUAL
                            </button>
                        </div>
                        <div class="form-group">
                            <select name="region" id="" required class="select2">
                                @if($search_id)
                                <option value="{{$region->id}}">{{$region->title}}</option>
                                @else
                                    <option value=""></option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <button class="btn btn-block btn-success">Search <i class="fa fa-spinner fa-spin hidden"></i></button>
                        </div>
                        @if(Session::has('success'))
                            <p class="text-center mt-2 text-success">{{ Session::get('success') }}</p>
                        @endif
                        @if(Session::has('error'))
                            <p class="text-center mt-2 text-danger">{{ Session::get('error') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="flexslider">
            <ul class="slides">
                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide01.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>

                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide02.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper intro_text_bottom">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>
                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide03.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper intro_text_bottom">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>


            </ul>
        </div> <!-- eof flexslider -->
    </section>

    <section class="ls teaser-box-section">
        <div class="container">
            <div class="row c-gutter-8">
                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 cs teaser" href="#">
                        <i class="ico icon-professor fs-40 px-10"></i>
                        <h6 class="fw-300">Find Driving Instructors</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-event fs-40 px-10"></i>
                        <h6 class="fw-300">Book Driving Lessons</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-steering-wheel fs-40 px-10"></i>
                        <h6 class="fw-300">Learn to Drive</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-clock fs-40 px-10"></i>
                        <h6 class="fw-300">Manage Driving Lessons</h6>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="video" class="ls">

        <div class="cover-image s-cover-left"></div><!-- half image background element -->
        <div class="container">
            <div class="row align-items-center c-gutter-60">
                <div class="col-md-12 col-lg-6">
                    <div class="item-media">
                        <div class="embed-responsive">
                            <a href="images/square/home-video.html" class="photoswipe-link" data-width="800" data-height="800" data-iframe="//www.youtube.com/embed/mcixldqDIEQ">
                                <img src="{{ asset('assets/front/images/home-video.jpg')}}" alt="">
                            </a>
                        </div>
                        <!-- <iframe width="1000" height="460" src="https://www.youtube.com/embed/mcixldqDIEQ" allowfullscreen></iframe> -->
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">


                    <div class="divider-30 divider-md-70 divider-xl-75"></div>


                    <h3 class="mt-0"><span class="color-main">Ready For</span> A Safe, Fun Driving Experience?</h3>
                    <p class="after-title subtitle">The school offers the following services for teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    <div class="row c-gutter-30">
                        <div class="col-md-12 col-lg-6">
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-shield fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Best Safety Measures
                                        </h6>
                                        <p>
                                            Our Instructors are Highly Trained in the latest Safety
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-30 divider-lg-42"></div>
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-event fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Perfect Timing
                                        </h6>
                                        <p>
                                            Now is the perfect time to start your In Class.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider-30 d-lg-none d-md-block"></div>
                        <div class="col-md-12 col-lg-6">
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-steering-wheel fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Class Formats
                                        </h6>
                                        <p>
                                            We offer In Classroom Drivers Education.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-30 divider-lg-42"></div>
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-credit-card fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Affordable Fee
                                        </h6>
                                        <p>
                                            We know this process can be expensive.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider-0 divider-md-0 divider-xl-75"></div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <section id="section_testimonials" class="container-fluids-mw ls">
        <div class="container-fluid">
            <div class="row c-gutter-50 mobile-padding-normal">
                <div class="divider-70 divider-xl-140"></div>
                <div class="col-md-12">
                    <div class="text-center">
                        <h3>What <span class="color-main">Client Says</span><br>About Us</h3>
                        <p class="after-title subtitle width-xl-50 width-100">The school offers the following services for Teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    </div>

                    <div class="testimonials-slider owl-carousel mt-60" data-autoplay="true" data-loop="true" data-responsive-lg="3" data-responsive-md="3" data-responsive-sm="1" data-responsive-xs="1" data-nav="false" data-dots="false" data-margin="50" data-center="true">
                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_01.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    Stephanie Wall is dedicated to make sure all individuals have an equally great experience with traffic school. Her devotion to the company is evident, with the countless amount of positive experiences.
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Sidney W. Yarber</cite>
                                <span class="color-main">Manager</span>
                            </footer>
                            <!--<p class="color-darkgrey">-->
                            <!--Sidney W. Yarber-->
                            <!--</p>-->
                            <!--<p class="color-main">-->
                            <!--Manager-->
                            <!--</p>-->
                        </div>


                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_02.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    As founder of FirstPass, Abdi Moalim draws on more then 5 years of business management experience. He graduated from San Diego State University with a degree in Political Science
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Terence M. Witzel</cite>
                                <span class="color-main">Businessman</span>
                            </footer>
                        </div>


                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_03.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    John is a fantastic instructor and made him feel really comfortable. They focused on everything important and when it came test time my nephew wasn't nervous at all because he had been trained so well.
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Kayla H. Seaman</cite>
                                <span class="color-main">Co & Founder</span>
                            </footer>
                        </div>

                    </div><!-- .testimonials-slider -->

                </div>
                <div class="divider-50 divider-xl-120"></div>
            </div>
        </div>
    </section>

    <section id="countdown-section" class="ds">
        <div class="container">
            <div class="row c-gutter-50 mobile-padding-normal">
                <div class="divider-70 divider-xl-90"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="1489" data-speed="1500">0</span>
                        <span class="counter-add">+</span>
                    </h3>

                    <p>Graduates received the right</p>
                </div>

                <div class="divider-40 d-sm-block d-md-none"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="94" data-speed="2500">0</span>
                    </h3>

                    <p>Years on the market</p>
                </div>

                <div class="divider-40 d-md-block d-lg-none "></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="96" data-speed="3000">0</span>
                    </h3>

                    <p>Training hours</p>
                </div>

                <div class="divider-40 d-sm-block d-md-none"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="99" data-speed="2800">0</span>
                    </h3>

                    <p>Number of teachers</p>
                </div>

                <div class="divider-80 divider-xl-100"></div>
            </div>
        </div>
    </section>

    <section class="ls s-py-70 s-py-xl-141">
        <div class="container">
            <div class="row c-gutter-135 mobile-padding-normal">

                <div class="col-md-12">
                    <div class="text-center mb-45">
                        <h3>How <span class="color-main">Should Get</span><br>Driving Lessons</h3>
                        <p class="subtitle width-100 width-xl-60">The FirstPass offers the following services for Teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <h1 class="color-main fw-500"><i class="ico icon-circle fs-8"></i>01</h1>
                            <h6 class="color-dark mt-28 after-title2">Find Driving Instructors</h6>
                            <p>View instructor profiles & real-time availability in your area, compare to get the perfect fit.</p>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="divider-30 divider-md-0 divider-xl-0"></div>
                            <h1 class="grey-color fw-500 mt-0"><i class="ico icon-circle fs-8"></i>02</h1>
                            <h6 class="color-dark mt-28 after-title2">Book Driving Lessons</h6>
                            <p>Choose your instructor and book your driving lessons online. Buy a package and save.</p>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="divider-30 divider-md-0 divider-xl-0"></div>
                            <h1 class="grey-color fw-500 mt-0"><i class="ico icon-circle fs-8"></i>03</h1>
                            <h6 class="color-dark mt-28 after-title2">Learn to Drive</h6>
                            <p>Done, you're ready to learn! Your instructor will pick you up from your chosen address.</p>
                        </div>
                    </div>
                </div>
                <div class="divider-5 d-lg-block d-xl-5"></div>
            </div>
        </div>
    </section>

    <section id="information-block" class="ds s-pt-xl-90 s-pb-xl-94 s-pt-60 s-pb-60">
        <div class="container">
            <div class="row c-gutter-50">

                <div class="divider-10 divider-lg-10 divider-xl-5"></div>
                <div class="col-md-9 col-lg-6 col-sm-12">
                    <h3 class="after-title">Just looking <span class="color-main">for lessons?</span></h3>

                    <p class="subtitle">Whether you are an existing driver or a new driver who needs help preparing for road test we have package options that can help you.</p>
                    <div class="mt-45">
                        <button type="button" class="btn btn-outline-darkgrey small fw-400">Get Started</button><span class="m-25"> or </span><a href="#" class="btn btn-link">Learn more</a>
                    </div>
                    <div class="divider-20 divider-lg-20 divider-xl-5"></div>
                </div>


            </div>
        </div>
    </section>

    <div class="modal fade" id="search_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-85" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Book Instructor Online </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div style="background: #ffc457; padding: 18px 0">
                    <div class="col-md-12">
                        <h5 class="font-condensed small-margin-top-20 small-margin-bottom-10">
                            <small class="caps">Step 2<br></small>
                            Choose your instructor
                        </h5>
                        <p>We have <strong> <span class="total_inst">28</span> auto instructors</strong> available in <strong class="area"></strong></p>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="instructor-profile-banner small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="load_instructors"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function (){

            @if($search_id)
            setTimeout(function() {
                $('#searchForm').submit();
            }, 2000);

            @endif


            $('.select2').select2({
                placeholder: 'Select your suburb',
                ajax: {
                    url: '{{ url('autocomplete-regions') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            //$('#search_modal').modal('show');

            $('#searchForm').submit(function (){

                $('.fa-spinner').removeClass('hidden');

                var data = new FormData(this);

                data.append("search_id", 1);

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){

                            $('.total_inst').html(res.total);

                            $('.area').text(res.title);

                            $('#load_instructors').html(res.view);
                            $('#search_modal').modal('show');

                           // window.history.replaceState("", "", "{{url('/')}}/"+res.search_id);

                        }else if(res.success == false){
                            swal('oops!', res.message, 'warning');

                        }
                        $('.fa-spinner').addClass('hidden');
                    },
                    error: function () {
                        $('.fa-spinner').addClass('hidden');
                    }
                });

                return false;
            });

        })


    </script>
@endsection
