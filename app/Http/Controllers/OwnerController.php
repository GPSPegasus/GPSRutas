<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use App\Scope;
class OwnerController extends Controller
{
    //

    function create_Owner_Vehicle(Request $request){
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string'
            ]);
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();
            $scope= new Scope([
                'name'=>'Owner',
                'user_id'=>$user->id
            ]);
            $scope->save(); 
            $owner = new Owner([
            'user_id'=>$user->id
            ]);
            $owner->save();
            return response()->json([
                'message' => 'Successfully created Owner'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);      
        }
    }

    function getAll_OwnerVehicle(){
        try{
            $owners_vehicle=Owner::All();
            $arr_owners_vechicle=array();    
            foreach ($owners_vehicle as $owner) {
                $user=User::findOrFail($owner->user_id);
                array_push($arr_owners_vechicle,         
                    ['name' => $user['name'],
                     'email' =>  $user['email'],
                     'password' =>  $user['password'],
                    ]
                );
            }
            return response()->json($arr_owners_vechicle);  

        }catch(Exception $e){
            return response()->json([
                'message' => 'Error'
            ], 404);          
        }
    }
}
