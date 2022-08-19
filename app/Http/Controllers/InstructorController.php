<?php

namespace App\Http\Controllers;

use App\Appointments;
use App\CarMake;
use App\CarModel;
use App\EmailSettings;
use App\InstructorDocs;
use App\Settings;
use App\TestLocations;
use App\Traits\AppTraits;
use App\UserMeta;
use App\UserRatings;
use App\UserTestLocations;
use App\WorkingTime;
use App\Region;
use App\ServiceRegions;
use App\TimeSlots;
use App\User;
use Carbon\Carbon;
use DateTime;
use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    function profile_vehicle(){
        $user = User::find(\auth()->user()->id);
        // echo "<pre>";print_r($user);die();
        $car_make = CarMake::where('status', 1)->get();
        return view('instructor.profile_vehicle', compact('user', 'car_make'));
    }

    function save_instructor_vehicle(Request $request){
        // echo "<pre>";print_r($request->all());die();
        $validator = Validator::make($request->all(), ['vehicle_image' => 'mimes:jpeg,bmp,png,webp']);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        }

        $is_file = false;
        $obj = new User();
        $obj = $obj->findOrFail( auth()->user()->id );

        $user_meta = UserMeta::where('user_id', auth()->user()->id)->first();
        if($user_meta){
            $old_file=$file_name = $user_meta->vehicle_image;
        }

        /*vehicle image*/
        if ($request->hasFile('vehicle_img')) {
            $is_file = true;

            $file = $request->file('vehicle_img');
            //$file = $file[0];
            $file_info 	= uniqid().'_'.time().'.'. $file->getClientOriginalExtension() ;
            $folderPath = base_path() . '/assets/images/vehicle_images/';
            Image::make( $file )->resize(null, 250, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($folderPath . $file_info )
                ->destroy();
           $file_name = $file_info;
        }

        $request->request->add(['vehicle_image' => $file_name]); //add request

        $ex = [
            'transmission_type',
            'language',
            'bio',
            'years_for_instructing',
            'keys2drive',
            'services_accreditation',
            'association_member',
            'dual_controls',
            'vehicle_year',
            'vehicle_model',
            'vehicle_make',
            'registration_number',
            'association_name',
            'vehicle_image',
            'ancap_rating',
        ];

        if($user_meta){
            $user_meta->update($request->only($ex));
        }else{
            $user_meta = new UserMeta();
            $user_meta->fill($request->only($ex));
            $user_meta->vehicle_image = $file_name;
            $user_meta->user_id = auth()->user()->id;
            $user_meta->save();
        }

        $obj->fill($request->only([ 'bio']));

        if($obj->save()){
            if ($is_file) {
                if (file_exists(base_path('assets/images/vehicle_images/' . $old_file)) && $old_file != null) {
                    unlink(base_path('assets/images/vehicle_images/' . $old_file));
                }
            }
            return response()->json(['success' => true, 'message' => 'Profile and vehicle data updated successfully.']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong.']);
        }
    }

    function get_vehicle_model(Request $request){
        if($request->make_id!=''){
            $make = CarModel::where('make_id', $request->make_id)->get();
            $options = '';
            foreach ($make as $mk){
                $options.="<option value='".$mk->id."'>".$mk->title."</option>";
            }
            return response()->json(['success' => true, 'options' => $options ]);
        }
    }

    function services_availability(){
        $user     = auth()->user();
        $timeslot = TimeSlots::all();
        $regions  = Region::select('id', 'title', 'code')->get();
        $user_region_ids = ServiceRegions::where('user_id', $user->id)
            ->pluck('region_id')
            ->toArray();
        $user_location_ids = UserTestLocations::join('test_locations','test_locations.id', 'user_test_locations.location_id')
            ->where('user_test_locations.user_id', $user->id)
            ->get();

        $user_regions = ServiceRegions::where('user_id', $user->id)->get();

        $working_time = WorkingTime::where('user_id', $user->id)
            ->get();

        return view('instructor.services_and_availability', compact('user_location_ids','timeslot', 'regions', 'user_regions', 'user_region_ids', 'working_time'));
    }

    function instructor_map_suburb(Request $request){
        $region = Region::whereId($request->id)->select('data')->first();
        if($region){
            return response()->json( $region );
        }
    }

    function save_service_regions(Request $request)
    {
        try {
            $user = \auth()->user();
            /*remove region logic*/
            $removed_regions = [];
            if($request->removed_options!='') {
                $removed_regions = explode(',', $request->removed_options);
            }
            /*remove region logic*/
            $removed_locations = [];
            if($request->removed_locations!='') {
                $removed_locations = explode(',', $request->removed_locations);
            }

            if( count($removed_regions)>0 ) {
                $to_remove = $request->user_regions;
                $remove_this_region = array_diff($removed_regions, $to_remove);
                ServiceRegions::whereIn('id', $remove_this_region)->where('user_id', $user->id)->delete();
            }

            if( count($removed_locations)>0 ) {
                $to_remove = $request->test_location_ids;
                $remove_this_loca = array_diff($removed_locations, $to_remove);
                UserTestLocations::whereIn('id', $remove_this_loca)->where('user_id', $user->id)->delete();
            }

            if ($request->user_regions) {
                foreach ($request->user_regions as $i => $id) {

                    ServiceRegions::updateOrCreate([
                        'user_id' => $user->id,
                        'region_id' => $id
                    ], [
                        'region_id' => $id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            if ($request->test_location_ids) {
                foreach ($request->test_location_ids as $i => $id) {

                    UserTestLocations::updateOrCreate([
                        'user_id' => $user->id,
                        'location_id' => $id
                    ], [
                        'location_id' => $id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            //echo '<hr>';
            $is_enabled = $request->is_enabled;
            $start_interval = $request->start_interval;
            $end_interval = $request->end_interval;

            $start_minutes = $request->start_minutes;
            $end_minutes = $request->end_minutes;

            foreach ($start_interval as $day => $v) {

                $data=[];
                foreach ($start_interval[$day] as $i => $time) {

                    $start_hour = $start_interval[$day][$i];
                    $start_min = $start_minutes[$day][$i];

                    $end_hour = $end_interval[$day][$i];
                    $end_min = $end_minutes[$day][$i];

                    $data[] = [
                        'start_hour' => $start_hour,
                        'start_min' => $start_min,
                        'end_hour' => $end_hour,
                        'end_min' => $end_min,
                    ];
                }

                if($is_enabled[$day] == 'yes') {
                    $errors = false;
                    for ($i = 0; $i < count($data); $i++) {
                        for ($j = $i + 1; $j < count($data); $j++) {

                            $start_time_j = $data[$j]['start_hour'] . ':' . $data[$j]['start_min'];
                            $start_time_i = $data[$i]['start_hour'] . ':' . $data[$i]['start_min'];

                            $end_time_j = $data[$j]['end_hour'] . ':' . $data[$j]['end_min'];
                            $end_time_i = $data[$i]['end_hour'] . ':' . $data[$i]['end_min'];

                            if (($start_time_j >= $start_time_i && ($start_time_j <= $end_time_i) ||
                                ($end_time_j >= $start_time_i && ($end_time_j <= $end_time_i)))) {
                                $errors .= "<li> timeslot ".($i+1)." and ".($j+1)." overlap.</li>";
                            }
                        }
                    }

                    if ($errors) {
                        return response()->json(['success' => false, 'day' => $day, 'errors' => $errors]);

                    }
                }

                $avil = WorkingTime::where( 'day', $day)
                    ->where('user_id', $user->id)
                    ->first();

                if($avil){
                    $avil->update(
                        [
                            "user_id" => $user->id,
                            "day" => $day,
                            "is_enabled" => $is_enabled[$day],
                            "data" => json_encode($data),
                        ]
                    );
                }else{

                    WorkingTime::create(
                        [
                            "user_id" => $user->id,
                            "day" => $day,
                            "is_enabled" => $is_enabled[$day],
                            "data" => json_encode($data),
                        ]
                    );
                }
            }

            User::find($user->id)->update(
                [
                    'calendar_default_view' => $request->calendar_default_view,
                    'lesson_travel_time' => $request->lesson_travel_time
                ]);

            return response()->json(['success' => true, 'message' => 'Services updated successfully']);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'errors' => false, 'message' => 'Something went wrong ' . $e->getMessage() . $e->getLine()]);
        }
    }

    function my_documents(Request $request){
        $user = auth()->user();
        $docs = InstructorDocs::where('user_id', $user->id)->first();
        return view('instructor.my_documents', compact('docs') );
    }

    function save_my_documents(Request $request){
        $user = auth()->user();
        $user_id = auth()->user()->id;

        $maxFileSize = 1000000;
        $file_type=['jpeg','png','jpg','svg'];

        $obj = InstructorDocs::where('user_id', $user_id)->first();

        if($request->type == 'driving_licence'){
            if($request->has('file_front')){
                // image front
                if ($request->hasFile('file_front')) {
                    $extension = $request->file_front->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence front image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('file_front')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence front size must be less than 1MB']);
                    }

                    $file_front = time() .uniqid() . '.' . $extension;
                    $request->file_front->move(base_path() . '/assets/images/documents/', $file_front);
                }

                if ($request->hasFile('file_back')) {
                    $extension = $request->file_back->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence back image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('file_back')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence back image size must be less than 1MB']);
                    }

                    $file_back = uniqid(). time() . '.' . $extension;
                    $request->file_back->move(base_path() . '/assets/images/documents/', $file_back);
                }

                $data = [
                    'file_front' => $file_front,
                    'file_back'  => $file_back,
                    'exp_day'    => $request->exp_day,
                    'exp_month'  => $request->exp_month,
                    'exp_year'   => $request->exp_year,
                ];

                if($obj){
                    /*update*/
                    InstructorDocs::where('user_id', $user_id)
                        ->update( ["driving_licence" => json_encode($data), 'driving_licence_status' => 'pending' ] );
                }else{
                    /*create*/
                    InstructorDocs::create(
                        [
                            "driving_licence" => json_encode($data),
                            "user_id" => $user_id,
                            'driving_licence_status' => 'pending'
                        ]
                    );
                }
            }
        }elseif($request->type == 'driving_instructor'){

            if($request->has('file')){
                // image front
                if ($request->hasFile('file')) {
                    $extension = $request->file->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence front image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('file')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence front size must be less than 1MB']);
                    }

                    $file_front = uniqid().time() . '.' . $extension;
                    $request->file->move(base_path() . '/assets/images/documents/', $file_front);
                }

                $data = [
                    'file'  => $file_front,
                    'exp_day'    => $request->exp_day,
                    'exp_month'  => $request->exp_month,
                    'exp_year'   => $request->exp_year,
                ];

                if($obj){
                    /*update*/
                    InstructorDocs::where('user_id', $user_id)
                        ->update( ["instructor_licence" => json_encode($data), 'instructor_licence_status' => 'pending' ] );
                }else{
                    /*create*/
                    InstructorDocs::create(
                        [
                            "instructor_licence" => json_encode($data),
                            "user_id" => $user_id,
                            'instructor_licence_status' => 'pending'
                        ]
                    );
                }
            }
        }elseif($request->type == 'wwcc'){

            $data = [
                'dob_day'    => $request->dob_day,
                'dob_month'  => $request->dob_month,
                'dob_year'   => $request->dob_year,
                'full_name'  => $request->name,
                'wwcc'  => $request->wwcc
            ];

            if($obj){
                /*update*/
                InstructorDocs::where('user_id', $user_id)
                    ->update( ["wwcc" => json_encode($data), 'wwcc_status' => 'pending' ] );
            }else{
                /*create*/
                InstructorDocs::create(
                    [
                        "wwcc" => json_encode($data),
                        "user_id" => $user_id,
                        'wwcc_status' => 'pending'
                    ]
                );
            }
        }

        $settings = Settings::find(1);
        if($settings) {
            $admin = User::where('type', 'admin')->first();
            /*email to admin about document*/
            $admin_email = $admin->email;
            $subject = 'Document submitted';
            $email_body = 'Hi!</br>';
            $email_body .= '<p>New Document submitted by '.ucfirst($user->name).'</p>';
            $email_body .= '<p>instructor email '.$user->email.'</p>';

            if ($settings->email_type == 'api') {
                if ($settings->email_api == 'send_grid') {
                    // sending email to super admin
                    AppTraits::SendgridEmail($email_body, $admin_email, $subject, 'FirstPass', $user->name, $settings->sg_email, $settings->sg_apikey);
                }
            } else {
                AppTraits::SmtpEmail($email_body, $admin_email, $subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
            }
        }


        return response()->json(['success' => true, 'message' => 'Documents saved successfully and send for approval']);
    }

    function get_instructor_calendar(Request $request){
        $user_working_time = WorkingTime::select('is_enabled', 'day')->where('user_id', $request->id)->get();
        return response()->json( [ 'working_time' => $user_working_time  ] );
    }

    function get_review(Request $request){

        $review = UserRatings::where('by_user', auth()->user()->id)
            ->where('user_id', $request->id)
            ->select('score', 'review', 'id')
            ->first();

        if($review){
            return response()->json( [ 'success' => true, 'review' => $review ] );
        }else{
            return response()->json( [ 'success' => false] );
        }
    }

    function save_review(Request $request){

        $review = UserRatings::where('by_user', auth()->user()->id)->first();

        $obj = new UserRatings();
        if($review) {
            $obj = $obj->findOrFail($review->id);
        }

        $obj->fill($request->all());
        $obj->by_user = auth()->user()->id;

        if( $obj->save() ){
            return response()->json( [ 'success' => true, 'message' => "Your review saved successfully." ] );
        }else{
            return response()->json( [ 'success' => false, 'message' => "something went wrong!"] );
        }
    }

    function view_calendar(){
        $web_events = Appointments::where('instructor_id', Auth::id())
            ->where('time_slot', '!=', '')
            ->where('schedule_date', '!=', '')
            ->whereIN('status', ['confirmed', 'completed'])
            ->where('is_private', 0)
            ->where('instructor_id', Auth::id())
            ->get();

        $private_events = Appointments::where('instructor_id', Auth::id())
            ->where('is_private', 1)
            ->where('instructor_id', Auth::id())
            ->get();

        return view('instructor.calendar', compact('web_events', 'private_events'));
    }

    function addEvent(Request $request){
         $start = date('d-m-Y H:i', strtotime($request->start." ". $request->start_time));
         $end = date('d-m-Y H:i', strtotime($request->end." ". $request->end_time));

         $obj = new Appointments();

        if ($request->id != "") {
            $obj = $obj->findOrFail($request->id);
        }

        $obj->fill($request->all());

        if (isset($request->start)) {
            $obj->start_date = $start;
        }
        if (isset($request->end)) {
            $obj->end_date = $end;
        }

        if (!isset($request->address)) {
            $obj->address = " ";
        }if (!isset($request->note)) {
            $obj->note = " ";
        }if (!isset($request->detail)) {
            $obj->detail = " ";
        }

        $obj->is_private = 1;
        $obj->user_id = Auth::id();
        $obj->type = "lesson";
        $obj->lesson_hour = 2;
        $obj->instructor_id = Auth::id();

        if ($obj->save()) {
            echo 1;
        } else {
            echo 2;
        }
    }

    function showEvent(Request $request)
    {
        if(is_numeric($request->id))
        {
            $data = Appointments::select('id', 'start_date', 'end_date', 'detail', 'address', 'note', 'is_private')->whereId($request->id)
                ->where('instructor_id', Auth::user()->id)
                ->first();
            if($data)
            {
                $return = $data;
            }else{
                $return = ['error'=> 1];
            }
            return response()->json($return);
        }
    }

    function deleteEvent(Request $request){
        $delete=false;
        if($request->id!='') {
           $delete = Appointments::where('instructor_id', Auth::id())
               ->where('id', $request->id)
               ->where('is_private', 1)
               ->delete();
        }

        if($delete){
            return response()->json( [ 'success' => true, 'message' => "Appointment deleted successfully." ] );
        }else{
            return response()->json( [ 'success' => false, 'message' => "Event not deleted." ] );
        }
    }

}
