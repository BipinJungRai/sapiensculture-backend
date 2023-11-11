<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;


class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $subscribers = Subscribe::orderBy('email', 'asc')->get();
        return view('admin.subscribers.index', compact('subscribers'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe2)
    {
        try {
            $subscribe2->delete();
            toastr()->success('A subscriber is deleted successfully!');
            return back();
        } catch (\Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }
}
