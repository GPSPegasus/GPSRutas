<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Vehicle;
class CardController extends Controller
{
    function create_Cards_Vehicle(Request $request){
        try{
            $request->validate([
                'vehicle_id'=> 'required|integer',
                'name_driver' => 'required|string'
            ]);
            $vehicle=Vehicle::findOrFail($request->vehicle_id);
            $card=new Card([
                'vehicle_id'=> $request->vehicle_id,
                'name_driver' => $request->name_driver
            ]); 
            $card->save();
            return response()->json([
                'message' => 'Successfully created card '
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }

    }
}
