<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        try {
            // Validate the incoming data
            $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'address' => 'required|string',
                'phoneNumber' => 'required|string',
                'email' => 'required|email',
                'cart' => 'required|array',
                'cart.*.data' => 'required|array',
                'cart.*.selectedSize' => 'required|string',
            ]);

            // Create a new order instance
            $order = new Order();
            $order->firstname = $request->firstName;
            $order->lastname = $request->lastName;
            $order->phone_number = $request->phoneNumber;
            $order->email = $request->email;
            $delivery_address = DeliveryFee::where('delivery_address', $request->address)->first();
            if (!$delivery_address) {
                return response([
                    'msg' => 'Please enter a valid delivery address'
                ]);
            }
            $order->delivery_address = $delivery_address->delivery_address;
            $deliver_fee = $delivery_address->delivery_fee; // calculated from server side
            $order->delivery_fee = $deliver_fee;

            $total = 0;

            // Process each selected product
            foreach ($request->cart as $item) {
                $product_size = ProductSize::where('product_size', $item['selectedSize'])->first();
                $product_size2 = $product_size->id;
                $product_id = $item['data']['id'];
                $product_price1 = Product::find($product_id);
                $product_price2 = $product_price1->price;
                $total += $product_price2;

                $product_detail = ProductDetail::where('product_id', $product_id)
                    ->where('product_size', $product_size2)
                    ->first();

                if (!$product_detail) {
                    return response([
                        'msg' => 'Sorry, ' . $product_price1->product_name . ' of size ' . $product_size->product_size . ' is out of stock. Please remove it from cart to proceed further.'
                    ]);
                }
            }


            $order->sub_total = $total;
            $order->grand_total = $total + $deliver_fee; // calculated from server side
            $order->save();


            return response([
                'message' => 'Order created successfully',
                'order_id' => $order->id,
                'grand_total' => $order->grand_total,
                'deliveryAddress' => $order->delivery_address,
                'delivery_fee' => $deliver_fee,

            ], 201);
        } catch (Exception $th) {
            return response([
                'error' => $th->getMessage(),

            ]);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        try {
            $order_id = $request->orderID2;
            $status = $request->status;
            $paypalOrderID2 = $request->paypalOrderID;


            $order = Order::find($order_id);

            if ($status === 'COMPLETED') {
                $order->payment_status = 'paid';
                $order->order_id_from_paypal = $paypalOrderID2;
                $order->update();
            }



            foreach ($request->cart as $item) {
                $product_size = ProductSize::where('product_size', $item['selectedSize'])->first();
                $product_size2 = $product_size->id;
                $product_id = $item['data']['id'];

                // Subtract 1 from stock
                $product_detail = ProductDetail::where('product_id', $product_id)
                    ->where('product_size', $product_size2)
                    ->first();

                $product_detail->stock = $product_detail->stock - 1;
                if ($product_detail->stock == 0) {
                    $product_detail->stock = 0;
                    $product_detail->update();
                    $product_detail->delete();
                } else {
                    $product_detail->update();
                }

                $order_detail = new OrderDetail();
                $order_detail->order_id = $order_id;
                $order_detail->product_details_id = $product_detail->id;
                $order_detail->save();

                // Check if any product detail with stock > 0 exists
                $product_has_stock = ProductDetail::where('product_id', $product_id)
                    // ->where('product_size', $product_size2)
                    ->where('stock', '>', 0)
                    ->exists();

                if (!$product_has_stock) {
                    // All stock properties are zero, update product status to "inactive"
                    $product = Product::find($product_id);
                    $product->feature = 'no';
                    $product->update();
                }
            }

            $orderDetails = OrderDetail::where('order_id', $order_id)->get();
            foreach ($orderDetails as $orderDetail) {
                $productDetail = ProductDetail::withTrashed()->find($orderDetail->product_details_id);
                $product = Product::find($productDetail->product_id);
                $orderDetail->product_name = $product->product_name;
                $orderDetail->product_price = $product->price;
                $productSize = ProductSize::find($productDetail->product_size);
                $orderDetail->product_size = $productSize->product_size;
            }

            $email = $order->email;

            // sending email for order confirmation
            $info = array(
                'orderId' => $order_id,
                'firstname' => $order->firstname,
                'orderDetails' => $orderDetails,
                'subTotal' => $order->sub_total,
                'email' => $email,
                'phone' => $order->phone_number,
                'address' => $order->delivery_address,
                'deliveryFee' => $order->delivery_fee,
                'grandTotal' => $order->grand_total,
                'paymentStatus' => $order->payment_status,

            );

            try {
                Mail::send('mail.order-confirmation', $info, function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Order Confirmation');
                });
            } catch (Exception $e) {
                return response([
                    'error' => $e->getMessage(),
                ]);
            }




            return response([
                'msg' => 'Payment status is updated!',
            ]);
        } catch (Exception $th) {
            return response([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
