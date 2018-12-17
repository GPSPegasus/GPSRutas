<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Owner;

class VehicleController extends Controller
{

    function create_Vehicle(Request $request){
        try{
            $request->validate([
                'imei' => 'required|string',
                'owner_vehicle_id' => 'required|string',
                'device_count_id' => 'required|string'
            ]);
            $owner_vehicle = Owner::findOrFail($request->owner_vehicle_id);
            $vehicle=new Vehicle([
                'imei' => $request->imei,
                'owner_vehicle_id' => $owner_vehicle['id'],
                'device_count_id' => $request->device_count_id,
            ]);
            $vehicle->save();
            return response()->json([
                'message' => 'Successfully created Vehicle'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }
    }

    function getAll_Vehicles(){
        try{
            $vehicles=Vehicle::All();           
            return response()->json($vehicles);  
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }
    }

    function changeState_Vehicle(Request $request){
        try{
            $request->validate([
                'id'=>  'required|string',
                'status_vehicle' => 'required|string'
            ]);
            $vehicle = Vehicle::findOrFail($request->id);
            $vehicle->status_vehicle = $request->status_vehicle;
            $vehicle->save();
            return response()->json([
                'message' => 'Successfully changed status Vehicle'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }
    }
}
