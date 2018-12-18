<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Geofence;
use App\Vehicle;
class GroupController extends Controller
{

    function create_Group(Request $request){
        try{
            $request->validate([
                'name' => 'required|string',
                'price' => 'required|string',
                'range' => 'required|string',
                'vehicles_id' => 'required|array',
                'geofences' => 'required|array',
            ]);
           $group=new Group([
               'name'=>$request->name,
               'price' =>$request->price,
               'range' =>$request->range
           ]);
           $group->save();
           foreach($request->vehicles_id as $vehicle_id){
                $vehicle = Vehicle::findOrFail($vehicle_id);
                $vehicle->group_id = $group->id;
                $vehicle->save();
           }
           foreach($request->geofences as $geofence_){
            $geofence=new Geofence([
                'name'=> $geofence_["name"],
                'latitude'=>$geofence_["latitude"],
                'longitude'=>$geofence_["longitude"],
                'radio'=>$geofence_["radio"],
                'group_id'=>$group->id
            ]);
            $geofence->save();
           }
           return response()->json([
            'message' => 'Successfully created Group'
           ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }


    }

    function getAll_Groups(){
        try{
            $groups=Group::All();           
            return response()->json($groups);  
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }
    }

    function get_Vehicle_Group(Request $request){
        try{
            $request->validate([
                'group_id' => 'required|string',
            ]);
            $vehicles = Vehicle::where('group_id', $request->group_id)
               ->get();
            return response()->json($vehicles);  
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }       
    }

    function remove_Vehicle_Group(Request $request){
        try{
            $request->validate([
                'group_id' => 'required|string',
                'vehicle_id' => 'required|string'
            ]);
            $vehicle = Vehicle::findOrFail($request->vehicle_id);
            $vehicle->group_id = null;
            $vehicle->save();
            return response()->json([
                'message' => 'Successfully removed Vehicle from Group'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }      
    }

    function  add_Vehicles(Request $request){
        try{
            $request->validate([
                'group_id' => 'required|string',
                'vehicles_id' => 'required|array'
            ]);
            $group=Group::findOrFail($request->group_id);
            foreach($request->vehicles_id as $vehicle_id){
                $vehicle = Vehicle::findOrFail($vehicle_id);
                $vehicle->group_id = $request->group_id;
                $vehicle->save();
           }
           return response()->json([
            'message' => 'Successfully added Vehicle at Group'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }       
    }
   

    function getAll_Geofences_Group(Request $request){
        try{
            $request->validate([
                'group_id' => 'required|string',
            ]);
            $geofences = Geofence::where('group_id', $request->group_id)
               ->get();
            return response()->json($geofences);  
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }      
    }

}
