<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryFee;
use Exception;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $delivery = DeliveryFee::all();
        return view('admin.deliveryfee.index', compact('delivery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.deliveryfee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $delivery = new DeliveryFee();
            $delivery->delivery_address = $request->delivery_address;
            $delivery->delivery_fee = $request->delivery_fee;
            $delivery->save();

            toastr()->success('A delivery address is added successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->success('Error in addding with ' + $th->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryFee $deliveryfee2)
    {
        return view('admin.deliveryfee.edit', compact('deliveryfee2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $delivery = DeliveryFee::find($id);
            $delivery->delivery_address = $request->delivery_address;
            $delivery->delivery_fee = $request->delivery_fee;
            if ($request->status == 'yes') {
                $delivery->status = 'active';
            } else {
                $delivery->status = 'inactive';
            }

            $delivery->update();
            toastr()->success('A delivery address is updated successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->success('Error with ' + $th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryFee $deliveryfee2)
    {
        try {
            $deliveryfee2->delete();
            toastr()->success('A delivery address is deleted successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->success('Error with ' + $th->getMessage());
            return back();
        }
    }
}
