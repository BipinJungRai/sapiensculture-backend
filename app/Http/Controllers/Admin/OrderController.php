<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    private function getOrderProductDetails($order)
    {
        $orderdetails = OrderDetail::where('order_id', $order->id)->get();
        $productDetails = [];


        foreach ($orderdetails as $orderdetail) {
            $product_details_id = $orderdetail->product_details_id;
            $product_detail = ProductDetail::where('id', $product_details_id)->first();
            if (!$product_detail) {
                $product_detail = ProductDetail::onlyTrashed()->where('id', $product_details_id)->first();
            }
            if ($product_detail) {
                $product = Product::find($product_detail->product_id);
                $size = ProductSize::find($product_detail->product_size);

                if ($product) {
                    $productDetails[] = [
                        'product_name' => $product->product_name,
                        'price' => $product->price,
                        'size' => $size->product_size,
                    ];
                }
            }
        }

        return $productDetails;
    }


    function paid()
    {
        $orders = Order::where('status', 'ordered')->where('payment_status', 'paid')->paginate(15);


        foreach ($orders as $order) {
            $order->productDetails = $this->getOrderProductDetails($order);
        }

        //    dd($orders->toArray());
        return view('admin.order.paid', compact('orders'));
    }


    function unpaid()
    {
        $orders = Order::where('payment_status', 'unpaid')->paginate(15);
        return view('admin.order.unpaid', compact('orders'));
    }

    function pending()
    {
        $orders = Order::where('status', 'pending')->where('payment_status', 'paid')->paginate(15);

        foreach ($orders as $order) {
            $order->productDetails = $this->getOrderProductDetails($order);
        }
        return view('admin.order.pending', compact('orders'));
    }

    function cancelled()
    {
        $orders = Order::where('status', 'cancelled')->where('payment_status', 'paid')->paginate(15);

        foreach ($orders as $order) {
            $order->productDetails = $this->getOrderProductDetails($order);
        }
        return view('admin.order.cancelled', compact('orders'));
    }

    function delivered()
    {
        $orders = Order::where('status', 'delivered')->where('payment_status', 'paid')->paginate(15);

        foreach ($orders as $order) {
            $order->productDetails = $this->getOrderProductDetails($order);
        }
        return view('admin.order.delivered', compact('orders'));
    }

    function orderstatus(Request $request, $id)
    {
        $order = Order::find($id);

        // dd($order);

        if ($request->status == 'pending') {
            $order->status = 'pending';
            $order->update();
            return back();
        }
        if ($request->status == 'cancelled') {
            $order->status = 'cancelled';
            $order->update();
            return back();
        }
        if ($request->status == 'delivered') {
            $order->status = 'delivered';
            $order->update();
            return back();
        }
        if ($request->status == 'ordered') {
            $order->status = 'ordered';
            $order->update();
            return back();
        }
    }

    public function destroy(Order $order2)
    {
        try {
            $order2->delete();
            toastr()->success('An unpaid order is deleted successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }

    function deleteAllUnpaid()
    {
        try {
            Order::where('payment_status', 'unpaid')->delete();          
            toastr()->success('All unpaid orders are deleted successfully!');
            return back();
        } catch (Exception $th) {
            dd($th->getMessage());
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }

    function edit(Order $order2)
    {
        
        return view('admin.order.edit');
    }
}
