@extends('layouts.app_guest')
@section('content')
    <style>
        .lesson_time_hidden,.lesson_ttime_hidden{
            font-size: 15px !important;
        }
        .date_md,.date_md1,.lesson_time_hidden,.lesson_ttime_hidden{
            display: none;
            font-size: 13px;
            background: #dddddd;
            padding: 2px;
            color: #404040;
        }
        .page_slider{position: relative}
        #search_modal .btn{
            font-size: 15px;
            padding: 10px;
            margin-right: 5px;
        }
        .fc-toolbar h2 {
            font-size: 18px !important;
        }
        .container-cx .teaser
        {
            border:0px !important;
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
        .ls.container-cr{
            /*max-width: 80rem!important;*/
        }

        .more_inst{
            background: orange;
        }
        .container-cx .teaser{
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .container-cx .teaser:hover{
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
        select.border-red {
            border: 2px solid red;
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

        table thead td{
            color: #2b2b2b;
        }
        #calendar, #calendar1 {
            max-width: 500px;
            max-height: 400px;
            padding-bottom: 5px;
        }

        #calendar td, #calendar th, #calendar tr, #calendar table{
            border: 0 !important;
            margin: 0;
        }
        #calendar1 td, #calendar1 th, #calendar1 tr, #calendar1 table{
            border: 0 !important;
            margin: 0;
        }
        .fc-row.fc-week div > table{
            border-spacing: 1px!important;
            border-collapse: initial !important;
        }

        .fc-dayGrid-view .fc-body .fc-row{
            min-height:0!important;
        }

        .fc-row.fc-week div > table .fc-day{
            border-spacing: 15px;

        }
        .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number{
            float: none!important;
        }
        .fc .fc-row .fc-content-skeleton td{
            text-align: center;
        }
        .fc-nonbusiness{
            background: none;
        }
        .fc-dayGridMonth-view > table{
            border: none;
        }
        th.fc-day-header{
            border: 0;
            border-color: white!important;
        }
        .fc-bgevent-skeleton td{
            background: #ddd !important;
            border-radius: 10px !important;
            border-collapse: initial;
            cursor: pointer;
        }
        .fc-highlight{
            /*background: #ddd !important;*/
        }
        td{ cursor: pointer;}

        .fc-unthemed td.fc-today a{
            color: #ff761f !important;
        }
        .fc-slats table td, .fc-row.fc-widget-header th{
            border: 1px solid #dddddd !important;
        }
        .fc-row .fc-content-skeleton td{ padding-top: 5px }
        .fc-scroller{height: auto!important; overflow: unset!important;}
        .fc-row .fc-content-skeleton{padding-bottom: 0!important;}
        .fc-head{background: #ffcb00}
        h5.title .badge{ font-size: 50% }
        #show_slots, #show_slots1{margin-top: 5px!important;}
        #show_slots .btn-switch, #show_slots1 .btn-switch{ margin-right: 1px; width: 174px !important; float: left }
        .btn-switch label
        {
            width: 100%;
            margin-bottom: 0px !important;
            margin-top: 6px !important;
            background: #ffcb00;
            border-color: #ffcb00;
        }
        .btn-switch
        {
            width: 100px;
            margin-right: 7px;
        }
        .btn-switch > input[type="radio"] + .btn {
            background-color: transparent !important;
            border-color: #ffcb00;
            color: #ffcb00 !important;
        }

        .btn-switch > input[type="radio"] + .btn > em {
            display: none;
            border: 1px solid #ffcb00;
            border-radius: 50%;
            padding: 2px;
            margin: 0 4px 0 0;
            top: 1px;
            font-size: 10px;
            text-align: center;
        }
        .btn-switch input[type=radio]{display: none}
        .input[type="radio"] + label:before{
            content: none !important;
        }
        .btn-switch strong{ font-size: 15px; font-weight: normal !important; }
        .front .btn-sm{
            padding: 0px 0px!important;
        }
        #show_slots label.btn-rounded{
            padding: 0px 8px !important;
        }
        #show_slots1 label.btn-rounded{
            padding: 0px 8px !important;
        }
        .fc-center{text-align: center}
    </style>
    <link href="{{ url('assets/js/calendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/daygrid/main.css') }}" rel='stylesheet' />

    <section class="" style="height: 130px">
    <div class="container"></div>
    </section>

    <section class="more_inst">
        <div class="container-cr">
            <div class="row">
                <div class="col-md-12">
                    <br><br>
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
                                                <span class="meter bg-oil" style="width: 38.5%">
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

    <section class="ls container container-cx mt-4">
        <div class="row c-gutter-8">
            <?php
            if($search->step_2!=''){
            $step_2 = json_decode($search->step_2);
            if( in_array('lesson', $step_2) ){
            ?>
        	    <div class="col-sm-2"></div>
	            <div class="col-sm-8">
	                <div class="box-shadow mb-20 teaser">
                        <div class="lesson_time_hidden"></div>
	                    <h5 onclick="$('#calender-container').toggle()" class="text-center title mt-0" style="margin-bottom: 0; background: #2c3e50; padding: 13px;font-size:20px;color: white; cursor: pointer">LESSON SCHEDULE <span class="badge badge-info">Optional</span></h5>
	                    <div id="calender-container" style='display:none'>
		                    <div class="row">
                                <div class="col-md-6" >
                                    <?php
                                    $hide_two=false;
                                    if(isset($search->step_3)){
                                        $step = json_decode( $search->step_3);
                                        if($step->hour == 1){
                                            $hide_two = true;
                                        }
                                    }
                                    ?>
                                    <div class="text-center mb-1 mt-5" style="background: #ffc107;@if($hide_two) display:none @endif">

                                        <label for="one_hour" class="mb-0">
                                            <input type="radio" form="book_time" id="one_hour" name="hour" value="1" checked>
                                            1 Hour Lesson
                                        </label>
                                        <label for="two_hour" class="ml-2 mb-0">
                                            <input type="radio" form="book_time" id="two_hour" name="hour" value="2" @if($hide_two) disabled @endif>
                                            2 Hour Lesson
                                        </label>
                                    </div>
                                    <div id="calendar" class="mt-20"></div>
                                </div>
                                <div class="col-md-6" id="timing" style="display: none;margin-top: 48px">
                                    <div class="p-3 box-shadow mb-20 teaser" style="min-height: 100px">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div id="show_slots" class="mb-20"></div>
                                                <button style="display: none" onclick="save_lesson(this)" type="button" class="btn btn-warning l-btn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
	                        </div>
                        </div>
	                </div>
	            </div>
                <div class="col-sm-2"></div>
                <?php
                }
            }
                if($search->step_2!=''){
                $step_2 = json_decode($search->step_2);
                if( in_array('test', $step_2) ){
                ?>
				<!--bilal -->
				    <div class="col-sm-2"></div>
					<div class="col-sm-8">
	                <div class="box-shadow mb-20 teaser">
                        <div class="lesson_ttime_hidden"></div>
	                    <h5 onclick="$('#calender-container-test-location').toggle()" class="text-center title mt-0" style="margin-bottom: 0; background: #2c3e50; padding: 13px;font-size:20px;color: white; cursor: pointer">TEST LOCATION <span class="badge badge-info">Optional</span></h5>
	                    <div id="calender-container-test-location" style='display:none'>
	                    	<div class="row">
			                    <div class="col-md-6" >
			                        <?php
			                        $hide_two=false;
			                        if(isset($search->step_3)){
			                            $step = json_decode( $search->step_3);
			                            if($step->hour == 1){
			                                $hide_two = true;
			                            }
			                        }
			                        ?>
			                        <div id="calendar1" class="mt-20"></div>
			                    </div>
                            <div class="col-md-6" id="tests" style="display: none;margin-top: 18px">
                                <div class="p-3 box-shadow mb-20 teaser" style="min-height: 100px">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div id="show_slots1" class="mb-20"></div>
                                                <?php
                                                if($search->step_2!=''){
                                                    $step_2 = json_decode($search->step_2);
                                                    if( in_array('test', $step_2) ){
                                                ?>
                                                <div class="form-group w-100" id="test_location" style="margin-top: 10px">
                                                    <label class="w-100">Test Location</label>
                                                    <select name="test_location" id="test_location" onchange="test_location(this)">
                                                        <option value="">Select Test Location</option>
                                                        <option value="any">Any test location</option>
                                                        @foreach($test_locations as $test_location)
                                                            <option value="{{ $test_location->id }}">{{ $test_location->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <?php } } ?>
                                            <button style="display: none" onclick="save_lesson1(this);" type="button" class="btn btn-warning lt-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
			                </div>
			            </div>
	                </div>
	            </div>
                <div class="col-sm-2"></div>
				<!-- end -->
            <?php } } ?>
				<div class="col-md-12" >
				    <div class="row">
	                <div class="col-sm-3"></div>
					<div class="col-sm-6" style="">
		                <div class="p-3 box-shadow mb-20 teaser" style="min-height: 100px">
		                    <div class="col-md-12">
		                        <div class="row">
		                            <form id="book_time">
		                                <input type="hidden" name="schedule_date">
		                                <input type="hidden" name="test_schedule_date">
		                                <input type="hidden" value="{{ $search_id }}" name="search_id">
		                                <input type="hidden" value="{{ $instructor->id }}" name="instructor_id">
		                                <p><small class="text-justify">You can continue at any time. You can make & manage bookings 24/7 from your online account, created in the next step. Your purchases are valid for 36 months & can be used with any instructor servicing your pickup suburb.</small></p>
		                                <div class="form-group w-100 text-center mt-4">
		                                    <button class="btn btn-block btn-warning btn-lg"> Continue: Your Details <i class="fa fa-spinner fa-spin hidden"></i></button>
		                                </div>

		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-3"></div>
		            </div>
            	</div>
    	</div>
    </section>
    <input type="hidden" id="check_search_types">
    <section id="video" class="ls">
        <div class="container">
            <div class="clearfix"></div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>
    <script>

        function save_lesson(e){
            if($('select[name=time_slot] option:checked').length==0){
                $('.date_md').hide();
                swal('Warning', 'Please select lesson booking time.', 'warning');
            }else{
                $('.date_md').show();
                $('#calender-container').hide();
                $('.lesson_time_hidden').text($('.date_md').text()).show()
            }
        }
        function save_lesson1(e){
            if($('select[name=time_slot_test_time] option:checked').length==0){
                $('.date_md1').hide();
                swal('Warning', 'Please select test booking time.', 'warning')
            }else{
                $('.date_md1').show();
                $('#calender-container-test-location').hide()
                $('.lesson_ttime_hidden').text($('.date_md1').text()).show()
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            $("#test_location").hide();
            var today = moment().format("YYYY-MM-DD");

            var mon='no',tue='no',wed='no',thu='no',fri='no',sat='no',sun='no';
            var hidden_days = [];
            @foreach($user_working_time as $v)

            @if($v->day == 'monday')
                    @if($v->is_enabled == 'no') hidden_days.push(1); @endif
                    var mon = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'tuesday')
                    @if($v->is_enabled == 'no') hidden_days.push(2); @endif
                    var tue = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'wednesday')
                    @if($v->is_enabled == 'no') hidden_days.push(3); @endif
                    var wed = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'thursday')
                    @if($v->is_enabled == 'no') hidden_days.push(4); @endif
                    var thu = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'friday')
                    @if($v->is_enabled == 'no') hidden_days.push(5); @endif
                    var fri = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'saturday')
                    @if($v->is_enabled == 'no') hidden_days.push(6); @endif
                    var sat = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'sunday')
                    @if($v->is_enabled == 'no') hidden_days.push(0); @endif
                    var sun = '<?php echo $v->is_enabled;?>';
            @endif

            @endforeach

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],

              header: {
                    left: 'prev',
                    center: 'title',
                    right: 'dayGridMonth, next'
                },

                unselectAuto: false,
                dragScroll : false,
                defaultDate: today,
                //eventLimit: true,
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                selectMirror: true,
                selectLongPressDelay: false,
                eventLongPressDelay: false,
                LongPressDelay: false,
                backgroundColor: 'red',
                /*hiddenDays: hidden_days,*/
                select: (start, end, allDay) => {
                    //console.log(start);
                    const date = moment(start.startStr);
                    const weak_day = date.day();
                    //console.log(weak_day);
                    var start_date = start.startStr;

                    if(start_date < today){
                        swal('Warning','You cannot select a date prior to the current date','warning');
                        return false;
                    }else{

                        if( weak_day == 0 && sun == 'no')
                        {
                            swal('Warning','Sunday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 1 && mon == 'no')
                        {
                            swal('Warning','Monday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 2 && tue == 'no')
                        {
                            swal('Warning','Tuesday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 3 && wed == 'no')
                        {
                            swal('Warning','Wednesday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 4 && thu == 'no')
                        {
                            swal('Warning','Thursday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 5 && fri == 'no')
                        {
                            swal('Warning','Friday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 6 && sat == 'no')
                        {
                            swal('Warning','Saturday is closed','warning');
                            return false;
                        }
                    }
                    /*time slots request*/
                    $("#show_slots").html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                    // $("#show_slots1").html('');
                    document.getElementById("check_search_types").value = "lesson_schedule";
                    $("#timing").show();
                    let h=$('input[name=hour]:checked').val();
                    var bookly_id = '1';
                    $("#loading").show();
                    $.post('{{url('get-slots')}}',
                        { hour: h, start_date:start_date, instructor_id: {{$instructor->id}}, '_token': '{{ @csrf_token() }}' },
                        function (data) {
                            $("#show_slots").html('');
                            $("#loading").hide();
                            $("#show_slots").append('<h6 class="title" style="font: "><input type="hidden" name="start_date_slot" id="start_date_slot" value="'+start_date+'"> <i class="fa fa-clock"></i> SELECT YOUR LESSON TIME ( '+start_date+' )</h6><div class="clearfix"></div><hr class="w-100 m-0"><div class="date_md">Driving Lesson : (<span class="lt">'+h+' hr</span>) <span class="date">'+data.date+'</span> <span class="time"></span></div>'+data.html);
                            $("#date").text(start_date);
                            $("input[name='schedule_date']").val(start_date);
                        })

                },

                eventRender: function(info) {
                    console.log(info);
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                //events : '',

            });
            calendar.render();



            $(document).ready(function() {

                window.setInterval(function(){
                    //console.log('clicked')
                    $('.fc-day-number').removeAttr('data-goto');
                }, 1000);
            });

            $(document).on('click', '.fc-day-top',  function () {

                setTimeout(function(){
                    $('.fc-dayGridDay-view .fc-day-grid-container').prepend('<div class="alert-box success">' +
                        '<div class="alert alert-success">' +
                        ' <small>Click anywhere on the box below to show the available timeslots. Click the month button above to return to full calendar view.</small>' +
                        '</div>' +
                        '</div>');
                }, 1);
            })


        });
document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar1');

            var today = moment().format("YYYY-MM-DD");

            var mon='no',tue='no',wed='no',thu='no',fri='no',sat='no',sun='no';
            var hidden_days = [];
            @foreach($user_working_time as $v)

            @if($v->day == 'monday')
                    @if($v->is_enabled == 'no') hidden_days.push(1); @endif
                    var mon = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'tuesday')
                    @if($v->is_enabled == 'no') hidden_days.push(2); @endif
                    var tue = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'wednesday')
                    @if($v->is_enabled == 'no') hidden_days.push(3); @endif
                    var wed = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'thursday')
                    @if($v->is_enabled == 'no') hidden_days.push(4); @endif
                    var thu = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'friday')
                    @if($v->is_enabled == 'no') hidden_days.push(5); @endif
                    var fri = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'saturday')
                    @if($v->is_enabled == 'no') hidden_days.push(6); @endif
                    var sat = '<?php echo $v->is_enabled;?>';
                @elseif($v->day == 'sunday')
                    @if($v->is_enabled == 'no') hidden_days.push(0); @endif
                    var sun = '<?php echo $v->is_enabled;?>';
            @endif

            @endforeach

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],

              header: {
                    left: 'prev',
                    center: 'title',
                    right: 'dayGridMonth, next'
                },

                unselectAuto: false,
                dragScroll : false,
                defaultDate: today,
                //eventLimit: true,
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                selectMirror: true,
                selectLongPressDelay: false,
                eventLongPressDelay: false,
                LongPressDelay: false,
                backgroundColor: 'red',
                /*hiddenDays: hidden_days,*/
                select: (start, end, allDay) => {
                    //console.log(start);
                    const date = moment(start.startStr);
                    const weak_day = date.day();
                    //console.log(weak_day);
                    var start_date = start.startStr;

                    if(start_date < today){
                        swal('Warning','You cannot select a date prior to the current date','warning');
                        return false;
                    }else{

                        if( weak_day == 0 && sun == 'no')
                        {
                            swal('Warning','Sunday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 1 && mon == 'no')
                        {
                            swal('Warning','Monday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 2 && tue == 'no')
                        {
                            swal('Warning','Tuesday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 3 && wed == 'no')
                        {
                            swal('Warning','Wednesday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 4 && thu == 'no')
                        {
                            swal('Warning','Thursday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 5 && fri == 'no')
                        {
                            swal('Warning','Friday is closed','warning');
                            return false;
                        }
                        else if( weak_day == 6 && sat == 'no')
                        {
                            swal('Warning','Saturday is closed','warning');
                            return false;
                        }
                    }
                    $("#test_location").show();
                    /*time slots request*/
                    $("#show_slots1").html('<center><i class="fa fa-spin fa-spinner"></i></center>');
                    // $("#show_slots").html('');
                     document.getElementById("check_search_types").value = "testlocation";
                    $("#tests").show();
                    let h=$('input[name=hour]:checked').val();
                    var bookly_id = '1';
                    $("#loading").show();
                    $.post('{{url('get-slots1')}}',
                        { hour: h, start_date:start_date, instructor_id: {{$instructor->id}}, '_token': '{{ @csrf_token() }}' },
                        function (data) {
                            $("#show_slots1").html('');
                            $("#loading").hide();
                            $("#show_slots1").append('<h6 class="title"><input type="hidden" name="start_date_slot1" id="start_date_slot1" value="'+start_date+'"> <i class="fa fa-clock"></i> SELECT YOUR TEST TIME ( '+start_date+' )</h6><div class="clearfix"></div><hr class="w-100 m-0"><div class="date_md1">Test Driving Lesson :<span class="date">'+data.date+'</span> <span class="time"></span></div>'+data.html);
                            $("#date").text(start_date);
                            $("input[name='test_schedule_date']").val(start_date);
                        })

                },

                eventRender: function(info) {
                    console.log(info);
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                //events : '',

            });
            calendar.render();

            $(document).ready(function() {
                window.setInterval(function(){
                    //console.log('clicked')
                    $('.fc-day-number').removeAttr('data-goto');
                }, 1000);
            });

            $(document).on('click', '.fc-day-top',  function () {

                setTimeout(function(){
                    $('.fc-dayGridDay-view .fc-day-grid-container').prepend('<div class="alert-box success">' +
                        '<div class="alert alert-success">' +
                        ' <small>Click anywhere on the box below to show the available timeslots. Click the month button above to return to full calendar view.</small>' +
                        '</div>' +
                        '</div>');
                }, 1);
            })


        });

        $(document).on('click','#show_slots .enable_slot',function(){

            var slot = $(this).text();
            $("#time").text(slot);

        });

        function test_location(e){
            if( $(e).val()!='' ){
                if($('select[name=time_slot_test_time]').val()!=''){
                    $('.lt-btn').show()
                }
            }else{
                $('.lt-btn').hide()
            }
        }

        $(document).ready(function (){

            $('#calender-container').hide()

            $('input[name=hour]').change(function (){
                $('#show_slots').html('');
                $('#show_slots').parent().find('button').hide();
            })

            $('#book_time').submit(function (){

                $('select[name=time_slot]').removeClass('border-red');
                $('select[name=time_slot_test_time]').removeClass('border-red');

                $('.fa-spinner').removeClass('hidden');
                var data = new FormData(this);

                let lesson_date = $("input[name='schedule_date']").val();
                let test_date = $("input[name='test_schedule_date']").val();
                if( lesson_date!='' && test_date!='' && lesson_date == test_date) {
                    var lesson_start = $('select[name=time_slot] option:selected').attr('data-start');
                    var lesson_end = $('select[name=time_slot] option:selected').attr('data-end');
                    if ($('select[name=time_slot_test_time]').length>0) {
                        if($('select[name=time_slot_test_time]').val()!='') {
                            var test_start = $('select[name=time_slot_test_time] option:selected').attr('data-start');
                            var test_end = $('select[name=time_slot_test_time] option:selected').attr('data-end');
                                if(lesson_start<=test_end) {
                                    if(lesson_end>= test_start) {
                                        console.log(1)
                                        $('select[name=time_slot]').addClass('border-red');
                                        $('select[name=time_slot_test_time]').addClass('border-red');
                                        swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                        $('.fa-spinner').addClass('hidden');
                                        return false;
                                    }
                                }

                                if(test_start<=lesson_end) {
                                    if(test_end>= lesson_start) {
                                        console.log(2)
                                        $('select[name=time_slot]').addClass('border-red');
                                        $('select[name=time_slot_test_time]').addClass('border-red');
                                        swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                        $('.fa-spinner').addClass('hidden');
                                        return false;
                                    }
                                }
                        }
                    }
                }

                // if(data[time_slot)
               	var get_search = $("#check_search_types").val();
                data.append("search_type", '4');
                data.append("test_or_scheduale",get_search);
                if(get_search =='testlocation')
                {
                	var test_location_id = $('#test_location').find(":selected").val();
                	data.append("test_location_id",test_location_id);
                }

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){

                            let url = "{{ url("/learners/register/$search_id") }}";
                            window.location.href=url;

                        }else if(res.success == false){
                            swal('oops!', res.message, 'warning');

                        }
                        $('.fa-spinner').addClass('hidden');
                    },
                    error: function () {
                        $('.fa-spinner').addClass('hidden');
                        swal('oops!', 'something went wrong', 'warning');
                    }
                });

                return false;
            });

        });
    </script>
    <script>
        function check_availiblity(obj)
        {
            if($(obj).val()==''){
                $('.l-btn').hide();
                $('.date_md').hide();
                $('.lesson_time_hidden').hide();
            }else{
                $('.date_md').show();
                let v = $(obj).val();
                let vv = v.split('-');
                $('.date_md .time').text(vv[0])
                $('.l-btn').show();
                $('.lesson_time_hidden').text($('.date_md').text()).show();
            }

            $('select[name=time_slot]').removeClass('border-red');
            $('select[name=time_slot_test_time]').removeClass('border-red');
            var start_date_slot=$("#start_date_slot").val();
            var start_date_slot1=$("#start_date_slot1").val();
            var time_slot=$(obj).val();
            $("[name=time_slot_test_time]").removeAttr("disabled");
            if(start_date_slot==start_date_slot1)
            {
                $("[name=time_slot_test_time][value='"+time_slot+"']").attr('disabled');
            }
            check_time();
        }

       function check_availiblity1(obj)
        {
            if($(obj).val()==''){
                $('.lt-btn').hide();
                $('.date_md').hide();
                $('.lesson_ttime_hidden').hide()
            }else{
                $('.date_md1').show();
                let v = $(obj).val();
                let vv = v.split('-');
                $('.date_md1 .time').text(vv[0])
                if( $('select#test_location').val()!='' ) {
                    $('.lt-btn').show();
                }else{
                    $('.lt-btn').hide();
                }
                $('.lesson_ttime_hidden').text($('.date_md1').text()).show();
            }


            $('select[name=time_slot]').removeClass('border-red');
            $('select[name=time_slot_test_time]').removeClass('border-red');

            var start_date_slot=$("#start_date_slot").val();
            var start_date_slot1=$("#start_date_slot1").val();
            var time_slot1=$(obj).val();
            $("[name=time_slot]").removeAttr("disabled");
            if(start_date_slot==start_date_slot1)
            {
                $("[name=time_slot][value='"+time_slot1+"']").attr('disabled');
            }

            check_time()
        }

        function check_time(){
            let lesson_date = $("input[name='schedule_date']").val();
            let test_date = $("input[name='test_schedule_date']").val();
            if( lesson_date!='' && test_date!='' && lesson_date == test_date) {
                var lesson_start = $('select[name=time_slot] option:selected').attr('data-start');
                var lesson_end = $('select[name=time_slot] option:selected').attr('data-end');
                if ($('select[name=time_slot_test_time]').length>0) {
                    if($('select[name=time_slot_test_time]').val()!='') {
                        var test_start = $('select[name=time_slot_test_time] option:selected').attr('data-start');
                        var test_end = $('select[name=time_slot_test_time] option:selected').attr('data-end');
                        if(lesson_start<=test_end) {
                            if(lesson_end>= test_start) {
                                console.log(1)
                                $('select[name=time_slot]').addClass('border-red');
                                $('select[name=time_slot_test_time]').addClass('border-red');
                                swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                $('.fa-spinner').addClass('hidden');
                                return false;
                            }
                        }

                        if(test_start<=lesson_end) {
                            if(test_end>= lesson_start) {
                                console.log(2)
                                $('select[name=time_slot]').addClass('border-red');
                                $('select[name=time_slot_test_time]').addClass('border-red');
                                swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                $('.fa-spinner').addClass('hidden');
                                return false;
                            }
                        }
                    }
                }
            }
        }

    </script>
@endsection
