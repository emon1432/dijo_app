<?php

namespace App\Http\Controllers\Api\V3;

ini_set('memory_limit', '-1');

use App\Http\Controllers\Controller;
use App\Models\DeliveryMan;
use App\Models\Conversation;

class DeliverymanController extends Controller
{

    public function list()
    {
        $deliveryman = DeliveryMan::all();
        return response()->json([
            'status' => 'success',
            'data' => $deliveryman
        ], 200);
    }

    public function listWithDetails()
    {
        $deliveryman = DeliveryMan::with([
            'userinfo',
            'vehicle',
            'wallet',
            'orders',
            'order_transaction',
            'delivery_history',
            'last_location',
            'zone',
            'reviews',
            'disbursement_method',
            'rating'
        ])->get();
        return response()->json([
            'status' => 'success',
            'data' => $deliveryman
        ], 200);
    }

    public function show($id)
    {
        $deliveryman = DeliveryMan::where('id',$id)->with([
            'userinfo',
            'vehicle',
            'wallet',
            'orders',
            'order_transaction',
            'delivery_history',
            'last_location',
            'zone',
            'reviews',
            'disbursement_method',
            'rating'
        ])->first();
        
        $conversations = Conversation::whereUser($id)->with([
            'sender',
            'receiver',
            'last_message'
        ])->get();

        $deliveryman->conversations = $conversations;

        return response()->json([
            'status' => 'success',
            'data' => $deliveryman
        ], 200);
    }
}
