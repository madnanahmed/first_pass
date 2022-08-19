@extends('layouts.app_guest')
@section('content')
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/front/css/intlTelInput.css') }}" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js"></script>
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
        .container-cr{
            max-width: 62.5rem;
            margin-right: auto;
            margin-left: auto;
            padding: 25px 5px;
        }

        .more_inst{
            background: orange;
        }
        .container-cr .teaser{
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .container-cr .teaser:hover{
            background-color: white !important;
        }
        .rounded-img{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            border-radius: 50%;
            overflow: hidden;

        }
        .teaser-box-section .title{
            color: orange !important;
        }
        .h190{
            height: 190px;
        }
        .container-cr .item a{
            webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            transition: all 0.2s ease;
            outline: 0;
        }
        .container-cr .item a:hover{
            -webkit-transform: translate(0, 1px);
            -moz-transform: translate(0, 1px);
            -ms-transform: translate(0, 1px);
            transform: translate(0, 1px);
        }
        .progres-bar-signup .progres .meter {
            position: relative;
            background: url({{ asset('assets/front/images/image-road-divider.png') }}) left center repeat-x;
        }
        .progres.radius .meter {
            border-radius: 4px;
        }
        .progres .meter {
            background: #ffc20e;
            display: block;
            height: 100%;
        }
        .bg-oil{background-color: #212A37 !important;}
        .progres-bar-signup {
            margin-top: -10px;
            text-align: center;
        }
        .va-b {
            vertical-align: middle !important;
        }
        .media-left, .media-right, .media-body {
            display: table-cell;
            vertical-align: top;
        }
        .media-left, .media>.pull-left {
            padding-right: 10px;
        }
        @media only screen and (min-width: 40.0625em) {
            .medium-padding-right-20 {
                padding-right: 20px !important;
            }
            .medium-margin-bottom-10 {
                margin-bottom: 10px !important;
            }
            h6 {
                font-size: 1rem;
            }

        }
        .media:first-child {
            margin-top: 0;
        }
        .media, .media-body {
            zoom: 1;
        }
        .media {
            margin-top: 15px;
            display: block!important;
        }
        .media-left, .media-right, .media-body {
            display: table-cell;
            vertical-align: top;
        }
        .media-body {
            width: 10000px;
        }
        .progres-bar-signup h6 {
            line-height: 1;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #212A37;
        }
        .text-oil {
            color: #212A37 !important;
        }
        .progres-bar-signup h6 small {
            display: block;
            padding: 5px 5px 10px;
            color: #212A37;
            font-size: 75%;
            line-height: 0;
        }
        .progres-bar-signup .progres {
            overflow: hidden;
        }
        .progres.radius {
            border-radius: 5px;
        }
        .small-height-50px {
            height: 50px !important;
        }
        .progres {
            background-color: rgba(255,255,255,0.5);
            border: 0 solid white;
            height: 0.625rem;
            margin-bottom: 0.625rem;
            padding: 0;
        }
        .progres-bar-signup .progres .meter .vehicle {
            position: absolute;
            left: 100%;
            min-width: 300px;
            margin-top: 5px;
            margin-left: -25px;
            text-align: left;
            line-height: 1;
            font-weight: bold;
            color: #212A37;
        }
        .media-middle {
            vertical-align: middle;
        }
        .media img {
            max-width: none;
        }
        .btn.oil {
            border-color: #212A37;
            margin-top: 20px;
        }

        .img-circle{
            border-radius: 50%;
            overflow: hidden;
        }
        .img-featured{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }

        .small-fontsize-14 {
            font-size: 0.875rem !important;
        }
        .small-padding-top-2 {
            padding-top: 2px !important;
        }

        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
            border-color: #e8e8eb !important;
        }
        .select2-selection__arrow {
            height: 40px !important;
        }
    </style>



    <section class="more_inst">
        <div class="container-cr">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="media medium-margin-bottom-10">
                                    <div class="media-left va-b medium-padding-right-20">
                                        <div><a class="btn btn-default tiny oil small-fontsize-14" href="javascript:history.back()"><i class="fa fa-angle-left fa-left"></i>Back</a></div>
                                    </div>
                                    <div class="media-body">
                                        <div class="progres-bar-signup">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h6 class="text-oil">
                                                        <small>Step 1</small>
                                                        Choose
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 2</small>
                                                        Book
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 3</small>
                                                        <span>
                                                            <span class="hide-for-small-only">Your</span>
                                                            Details
                                                            </span>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 4</small>
                                                        Payment
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="progres col-md-12 radius small-height-50px">
                                                <span class="meter bg-oil" style="width: 64%">
                                                <div class="vehicle">
                                                    <div class="media media-middle">
                                                        <div class="media-left">
                                                             @if( $instructor->avatar == '')
                                                                <img class="img-circle img-featured" src="{{ url('assets/images/users/default.png') }}" alt="user" style="height: 40px; width: 40px">
                                                            @else
                                                                <img class="img-circle img-featured" src="{{ url('assets/images/users/'.$instructor->avatar) }}" alt="user" style="height: 40px; width: 40px">
                                                            @endif

                                                        </div>
                                                        <div class="media-body small-padding-top-2 small-fontsize-14">
                                                    Book with
                                                    <br>
                                                    {{ ucfirst( $instructor->name ) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls container container-cr mt-4">
        <div class="row c-gutter-8">
            <div class="col-sm-7">

                @if(auth()->user())
                    @if(auth()->user()->type !='learner')
                    <div class="alert alert-danger">
                        <p><strong class="text-white">Alert!</strong> You haven't permission to proceed! </p>
                    </div>
                    @endif
                @endif
                <form method="post" id="registerForm">
                    <input type="hidden" name="user_id" @if($user) value="{{ $user->id }}" @endif>
                    <input type="hidden" name="search_id" value="{{ $search_id }}">

                    <input class="address_fields" type="hidden" id="truecity" name="address_detail[city]">
                    <input class="address_fields" type="hidden" id="administrative_area_level_1" name="address_detail[state]">
                    <input class="address_fields" type="hidden" id="country" name="address_detail[country]">
                    <input class="address_fields" type="hidden" id="lat" name="address_detail[lat]">
                    <input class="address_fields" type="hidden" id="lng" name="address_detail[lng]">
                    <input class="address_fields" type="hidden" id="countryCode" name="address_detail[country_code]"/>
                    <input class="address_fields" type="hidden" id="query" name="address_detail[query]"/>
                    <input class="address_fields" type="hidden" id="postcode" name="address_detail[postcode]"/>
                    <input class="address_fields" type="hidden" id="suburb" name="address_detail[suburb]"/>


                    <div class="box-shadow mb-20 teaser p-3">
                        @if(auth()->guest())
                        <h5 class="text-center title text-uppercase">Please provide your personal details</h5>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" @if($user) value="{{ $user->name }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" @if($user) value="{{ $user->lname }}" @endif>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" @if($user) value="{{ $user->email }}" disabled @else name="email" @endif >
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone Number<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone" @if($user) value="{{ $user->phone }}" @endif placeholder="04">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="">Date of Birth<span class="text-danger">*</span></label>

                            <div class="row">
                                <div class="col-md-3">
                                    <select name="day" class="select-inline">
                                    <option value="">Day</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                </div>
                                <div class="col-md-5">
                                    <select name="month" class=" select-inline" >
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="year" class=" select-inline" >
                                    <option value="">Year</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                    <option value="1954">1954</option>
                                    <option value="1953">1953</option>
                                    <option value="1952">1952</option>
                                    <option value="1951">1951</option>
                                    <option value="1950">1950</option>
                                    <option value="1949">1949</option>
                                    <option value="1948">1948</option>
                                    <option value="1947">1947</option>
                                    <option value="1946">1946</option>
                                    <option value="1945">1945</option>
                                    <option value="1944">1944</option>
                                    <option value="1943">1943</option>
                                    <option value="1942">1942</option>
                                    <option value="1941">1941</option>
                                    <option value="1940">1940</option>
                                    <option value="1939">1939</option>
                                    <option value="1938">1938</option>
                                    <option value="1937">1937</option>
                                    <option value="1936">1936</option>
                                    <option value="1935">1935</option>
                                    <option value="1934">1934</option>
                                    <option value="1933">1933</option>
                                    <option value="1932">1932</option>
                                    <option value="1931">1931</option>
                                    <option value="1930">1930</option>
                                    <option value="1929">1929</option>
                                    <option value="1928">1928</option>
                                    <option value="1927">1927</option>
                                    <option value="1926">1926</option>
                                    <option value="1925">1925</option>
                                    <option value="1924">1924</option>
                                    <option value="1923">1923</option>
                                    <option value="1922">1922</option>
                                    <option value="1921">1921</option>
                                    <option value="1920">1920</option>
                                </select>
                                </div>
                            </div>
                    </div>


                        <div class="mt-4 w-100 text-center">
                            <strong class=" small-margin-5">
                                <span style="display: inline;">Choose a password for your learning dashboard</span>
                            </strong>
                            <p class="small-fontsize-14 text-center text-gray-light">Your dashboard allows you to make, manage &amp; view bookings online 24/7.</p>
                        </div>

                        <div class="row m-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password<span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="confirm_password" >
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif


                    <?php

                    $step_5 = $search->step_5;
                    $s = json_decode($step_5);
                    $address = '';
                    if( is_object($s) ){
                        $address = $s->address;
                    }
                    ?>

                    <h5 class="text-center title m-0">Please enter the learner's pick up details</h5>

                        <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="">Address<span class="text-danger">*</span></label>
                            <input onkeyup="$('.address_fields').val(''),$('.address_hint').addClass('hidden')" id="searchTextField" class="form-control" type="text" name="address" value="">
                            <small class=" address_hint hidden" data-original-title="" data-toggle="tooltip" data-title="Address details"> <i class="fa fa-address-book"></i> </small>
                        </div>

                        {{--<div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Suburb<span class="text-danger">*</span></label>
                                    <select name="suburb" class="select2">
                                        @foreach($regions as $region)
                                            <option @if($search->region_id == $region->id) selected @endif value="{{ $region->id }}">{{ $region->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>--}}

                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label class="w-100">Captcha:</label> <br>
                                <p>
                                    {!! app('captcha')->display() !!}
                                    {!! $errors->first('g-recaptcha-response', '<p class="alert alert-danger">:message</p>') !!}
                                </p>
                            </div>
                        </div>

                        <div class="alert alert-danger error-alert hidden mt-4 mb-4">
                            <p><strong class="text-white">Please fix following errors</strong></p>
                            <ul class="error_body"></ul>
                        </div>

                        <div class="form-groups mt-10 w-100">
                            <button class="btn btn-lg btn-block btn-warning"> <span class="fa fa-spin fa-spinner hidden"></span> CONTINUE </button>
                        </div>

                    </div>

                </form>
            </div>
            </div>
            <div class="col-sm-5">
                <div class="p-3 box-shadow mb-20 teaser" style="min-height: 100px">
                    <div class="col-md-12">
                        <div class="row">
                            <h6 class="title"><i class="fa fa-shopping-cart"></i> YOUR SELECTED PACKAGE</h6>

                            <?php
                            $total=0;
                            $search_step_2 = json_decode($search->step_2);
                            if(is_array($search_step_2)){
                                foreach ($search_step_2 as $item){
                            ?>
                                @if($item == 'lesson')
                                    <?php

                                    $hour=$price=0;
                                    $search_step_3 = json_decode($search->step_3);
                                    $hour = @$search_step_3->hour;
                                    $price = @$search_step_3->total;
                                    $total = $total+$price;
                                    ?>
                                        <div class="row sd">
                                            <div class="col-md-8">Driving Lesson x {{ $hour }} hour</div>
                                            <div class="col-md-4 text-right">${{ $price }}</div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr class="w-100 m-0">
                                @endif
                                @if($item == 'test')
                                <?php
                                $total = $total+$test_package->price;
                                ?>
                                    <div class="row sd">
                                        <div class="col-md-8">Driving Test</div>
                                        <div class="col-md-4 text-right">${{ $test_package->price }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr class="w-100 m-0">
                                @endif
                            <?php
                                }
                            }
                            ?>
                            <div class="row sd">
                                <div class="col-md-8"><strong>Total</strong></div>
                                <div class="col-md-4 text-right"><strong>${{ $total }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <section id="video" class="ls">
        <div class="container">
            <div class="clearfix"></div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.6"></script>
    <script src="{{ asset('assets/front/js/intlTelInput.js') }}"></script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCAwX5DJjr0fC7_vp6_WVO6Ut16hXTuK1g&language=en&region=AU"></script>--}}
    <script>

        (function() {
            var placesAutocomplete = places({
                appId: 'plDAML4GXDMT',
                apiKey: '384c249023210b735270be1a32b31358',
                minLength: 3,
                container: document.querySelector('#searchTextField'),
                templates: {
                    value: function(suggestion) {
                        return suggestion.name;
                    }
                }
            }).configure({
                type: 'address',
                language: 'en',
                countries: ['au', 'us'],
            });
            placesAutocomplete.on('change', function resultSelected(e) {
                console.log(e);
                document.querySelector('#truecity').value = e.suggestion.city || '';
                document.querySelector('#country').value = e.suggestion.country || '';
                document.querySelector('#administrative_area_level_1').value = e.suggestion.administrative || '';
                document.querySelector('#countryCode').value = e.suggestion.countryCode || '';
                document.querySelector('#lat').value = e.suggestion.latlng.lat || '';
                document.querySelector('#lng').value = e.suggestion.latlng.lng || '';
                document.querySelector('#query').value = e.query || '';
                document.querySelector('#postcode').value = e.suggestion.postcode || '';
                document.querySelector('#suburb').value = e.suggestion.suburb || '';
                $('.address_hint').html(e.query+ '<strong> Detail: </strong> city: '+ e.suggestion.city+ ', postcode: '+e.suggestion.postcode).removeClass('hidden');
                console.log(e.suggestion.suburb);
            });
        })();

        $(document).ready(function (){

            $('input[name="phone"]').intlTelInput({
                utilsScript: '{{ asset('assets/front/js/intlTelInput.js') }}',
                autoPlaceholder: true,
                preferredCountries: ['au', 'us'],
                //allowDropdown: false,
                separateDialCode: true,
                onlyCountries: ["au", 'us'],
            });

            $('input[name="phone"]').intlTelInput("setCountry", "au");

            @if(auth()->user())
                @php
                    $dob = explode('-',$user->dob);
                @endphp
                $('select[name=year]').val({{ @$dob[0] }});
                $('select[name=month]').val({{ @$dob[1] }});
                $('select[name=day]').val({{ @$dob[2] }});
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

            $('#registerForm').submit(function (){
                $('.error-alert').addClass('hidden');
                $('.error-alert .error_body').html('');

                if( $('#truecity').val() =='' ){
                    swal('please select address from values');
                    return false;
                }

                $('.fa-spinner').removeClass('hidden');

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('register_learner')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        let er='';
                        if( res.hasOwnProperty('error') ){
                            $.each(res.message, function(k, v) {
                                er += '<li>'+v[0]+'</li>';
                            });

                            $('.error-alert .error_body').html(er);
                            $('.error-alert').removeClass('hidden');
                            grecaptcha.reset();
                        }

                        if(res.success == true){
                            let url = "{{ url("/learners/payment/$search_id") }}";
                            window.location.href=url;

                        }else if(res.success == false){
                            swal('oops!', res.message, 'warning');
                            grecaptcha.reset();
                        }
                        $('.fa-spinner').addClass('hidden');
                    },
                    error: function () {
                        $('.fa-spinner').addClass('hidden');
                        swal('oops!', 'something went wrong', 'warning');
                        grecaptcha.reset();
                    }
                });

                return false;
            });

        });
    </script>
@endsection
