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
        .ins .rounded-img{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            border-radius: 50%;
            overflow: hidden;
        }
        .ins .title{
            color: orange !important;
            font-weight: bold;
        }
        .row.ins {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding: 15px 0px;
        }
        .row.ins:last-child {
            border: none !important;
        }

        .row.ins .pointer:hover{
            color: black !important;
            text-decoration: underline;
        }
    </style>

    <div style="background: #ffc457; padding: 18px">
        <div class="col-md-12">
            <h5 class="font-condensed small-margin-top-20 small-margin-bottom-10">
                Choose your instructor
            </h5>
            <p>We have <strong> <span class="total_inst">{{ $total }}</span> auto instructors</strong> available in <strong class="area"></strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div style="
    height: 300px;
    background: #f7f7f7;
    z-index: 99;
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
                                    <input type="radio" name="type" value="auto"  checked class="hidden">
                                    <i class="fa fa-check text-success ato"></i> AUTO
                                </button>

                                <button onclick="$(this).find('input').prop('checked', true); $('i.mnl').removeClass('hidden'); $('i.ato').addClass('hidden');" type="button" id="contact_form_submit" class="btn btn-outline-darkgrey">
                                    <input type="radio" name="type" value="manual" class="hidden" >
                                    <i class="fa fa-check text-success hidden mnl"></i>
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
        </div>
        <div class="col-md-9">
            <div class="instructor-profile-banner pl-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="load_instructors">

                                    <?php
                                    $chunk = 0;
                                    ?>
                                    @foreach ($users as $user)
                                        <?php
                                        $language = json_decode($user->language);

                                        if($language!=''){
                                            $language = implode(',', $language);
                                        }

                                        $chunk++;
                                        if($chunk == 1){ ?>
                                        <div class="row ins">
                                            <?php } ?>

                                            <div class="col-md-6 user_{{ $user->id }}">

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        @if( $user->avatar == '')
                                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="rounded-img">
                                                        @else
                                                            <img src="{{ url('assets/images/users/'.$user->avatar) }}" alt="user" class="rounded-img">
                                                        @endif
                                                    </div>

                                                    <div class="col-md-9">
                                                        <a href="" class="title"> {{ $user->name }} </a>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span onclick="show_inf('intl_conv')" class="text-info pointer">
                                                                     <i class="fa fa-globe fa-fw"></i> Intl conversions
                                                                </span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                <span onclick="show_inf('your_car')" class="text-info pointer">
                                                                      <i class="fa fa-car fa-fw"></i> Your car or mine
                                                                </span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                <span onclick="show_inf('logbook')" class="text-info pointer">
                                                                      <i class="fa fa-list-alt fa-fw"></i> Logbook 1hr=3hrs
                                                                </span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                <span onclick="show_inf('driving_test')" class="text-info pointer">
                                                                       <i class="fa fa-drivers-license fa-fw"></i> Test package
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 mt-1">
                                                                <p> <span class="text-warning">{{ ucfirst($user->name) }}</span> speaks {{ $language }} </p>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <a href="{{ url('/search/'.$search_id.'/instructors/profile/'.$user->id) }}" class="btn btn-info btn-outline-info btn-sm ">View Profile</a>
                                                                <a href="{{ url('book-online/'.$search_id.'/instructor/'.$user->id) }}" class="btn btn-success btn-outline-success btn-sm">Book Online</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if($chunk == 2){
                                                $chunk = 0;
                                                echo '</div>';
                                            }
                                            ?>
                                            @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script>

        $(document).ready(function (){

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


            $('.area').text($('#select2--container').text());

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
