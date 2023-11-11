<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Exception;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    function subscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|max:30',
            ]);

            // check email
            if (Subscribe::where('email', $request->email)->exists()) {
                return response([
                    'msg' => 'Already Subscribed'
                ]);
            } else {
                Subscribe::insert($validated);

                return response([
                    'msg' => 'Subscribed'
                ]);
            }
        } catch (Exception $th) {
            return response([
                'msg' => 'Failed to subscribe',
                'error' => $th->getMessage(),
            ]);
        }
    }
}
