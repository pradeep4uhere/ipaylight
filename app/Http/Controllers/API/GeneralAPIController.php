<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GeneralAPIController extends Controller
{
    //

    public function getInactiveStatusList(Request $request) : JsonResponse
    {
            return response()->json([
                'status' => 'success',
                'data' => $request->all(),
            ]);
    }
}
