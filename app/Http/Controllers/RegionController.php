<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{

    function index(){
        return view('admin.region.index');
    }

    public function get_regions()
    {
        $regions = Region::all();

        return Datatables::of($regions)

            ->addColumn('action', function ($regions) {
                $chk = ($regions->status=='1') ? "checked":"";
                $b = '<a onclick="edit_region('.$regions->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> ';

                $b.= '<a><div class="btn custom-switch">
                  <input type="checkbox" class="custom-control-input myswitch" data-obj="regions" id="customSwitches'.$regions->id.'" '.$chk.' value="'.$regions->id.'">
                    <label class="custom-control-label" for="customSwitches'.$regions->id.'"></label>
                    </div></a>';

                return $b;
            })->make(true);
    }

    function edit_region(Request $request){

        $region = Region::whereId($request->id)->first();
        if($region) {
            return response()->json(['success' => true, 'region' => $region]);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function save_region(Request $request){
        $obj = new Region();

        if ($request->id != '') {
            $obj = $obj->findOrFail($request->id);
        }
        $obj->fill($request->all());

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Region updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }
}
