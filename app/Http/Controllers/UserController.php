<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\InstructorDocs;
use App\Region;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function view_users(Request $request)
    {
        return view('admin.view_users');
    }

    function profile(){
        $user = User::whereId(Auth::user()->id)->first();
        return view('users.users_profile', compact('user' ));
    }

    function saveProfile(Request $request){
        try {
            $obj = new User();

            if ($request->id != '') {
                $obj = $obj->findOrFail($request->id);
            }
            $obj->fill($request->all());

            // image
            if ($request->hasFile('profile')) {
                $file_name = time() . '.' . $request->profile->getClientOriginalExtension();
                $request->profile->move(base_path() . '/assets/images/users/', $file_name);
                $obj->avatar = $file_name;
            }

            if ($request->is_password_reset == 1) {

                if ($request->old_password == '' || $request->new_password == '') {
                    return response()->json(['success' => false, 'message' => 'Password fields required']);
                }

                $is_uesr = User::where(['id' => $request->id])->first();

                if ($is_uesr && Hash::check($request->old_password, $is_uesr->password)) {
                    /*compare password*/
                    if ($request->new_password == $request->confirm_password) {
                        $obj->password = Hash::make($request->new_password);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Please confirm password']);
                    }

                } else {
                    return response()->json(['success' => false, 'message' => 'Invalid password']);
                }
            }

            if ($obj->save()) {
                return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
            }
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function get_users()
    {
        $users = User::where('type', '!=', 'admin');

        return Datatables::of($users)
            ->editColumn('created_at', function ($users) {
                $date = $users->created_at->format('Y-m-d h:i:s a');
                return $date;
            })
            ->editColumn('type', function ($users) {
                if($users->type == 'inst'){
                    return '<a href="'.url('instructor-details/'.$users->id).'" class="btn btn-link"> Instructor</a> ';
                }else{
                    return $users->type;
                }
            })
            ->addColumn('action', function ($users) {
                $chk = ($users->status=='1') ? "checked":"";
                $b = '<a onclick="get_user('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> ';
                if(auth()->user()->type == 'admin'){
                    $b.= '<a onclick="del_user('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger danger-alert"><i class="fa fa-trash"></i> Delete</a> ';
                }
                $b.= '<a onclick="login_client('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-info info-alert"><i class="ti-power-off"></i> Login</a> ';

                $b.= '<a><div class="btn custom-switch">
                  <input type="checkbox" class="custom-control-input myswitch" data-obj="users" id="customSwitches'.$users->id.'" '.$chk.' value="'.$users->id.'">
                    <label class="custom-control-label" for="customSwitches'.$users->id.'"></label>
                    </div></a>';

                return $b;
            })
            ->rawColumns(['action', 'type'])
            ->make(true);
    }

    public function edit($id)
    {
        $user =  User::find($id);
        return $user;
    }

    public function delete_user(Request $request)
    {
        try{
            $user =  User::find($request->id)->delete();
            if($user)
            {
                return response()->json(['success' => true, 'message' => 'User Deleted Successfully ']);
            }else{
                return response()->json(['success' => false, 'message' => 'An Error Occurred, User Not Deleted']);
            }
        }
        catch (\Exception $e ) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }
    }

    function userLogin(Request $request)
    {
        if(auth()->user()->type=='admin') {
            $request->session()->put('master_control', 'admin');
        }elseif (auth()->user()->type=='support'){
            $request->session()->put('master_control', 'support');
        }
        if(Auth::loginUsingId($request->id,true)){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    public function back_to_admin(Request $request){
        $session = $request->session()->get('master_control');
        if($session=="admin" || $session=="support"){
            $user = User::where('type', $session)->first();
            $request->session()->forget('master_control');
            Auth::login($user);
            return redirect('home');
        }else{
            return redirect(request()->headers->get('referer'));
        }
    }

    public function store(Request $request)
    {
        try{
            $user =  User::find($request->id);
            if($user)
            {
                /*validate duplicate user*/
                if(User::where('email', $request->email)->where('id', '!=', $user->id)->exists()){
                    return response()->json(['success' => false, 'message' => 'A user already registered with '. $request->email]);
                }

                $user->fill($request->all());

                if ($user->save()) {
                    return response()->json(['success' => true, 'message' => 'User Updated Successfully ']);
                } else {
                    return response()->json(['success' => false, 'message' => 'An Error Occured, User Not Saved']);
                }

            }

            return view('admin.view_users', ['user'=>$user]);
        }
        catch (\Exception $e ) {
            return response()->json(['success' => false, 'message' => $e->getMessage() . '  ' . $e->getLine() ], 200);
        }
    }
    function update_status(Request $request){
        $update = false;
        if($request->obj == 'users'){
            $update = User::whereId($request->id)->update(['status' => $request->status]);
        }
        if($request->obj == 'regions'){
            $update = Region::whereId($request->id)->update(['status' => $request->status]);
        }

        if($update) {
            return response()->json(['success' => true, 'message' => 'Settings Successfully Saved']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function instructor_details($id){
        $user = User::find($id);
        $docs = InstructorDocs::where('user_id', $id)->first();
        $car_make = CarMake::where('status', 1)->get();
        return view('users.instructor_details', compact('user', 'docs', 'car_make'));

    }

}
