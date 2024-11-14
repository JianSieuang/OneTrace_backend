<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewOrders()
    {
        $user = auth()->user();
    
        $orders = Order::with('items.product')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($order) {
                if ($order->payment_proof) {
                    $order->payment_proof_url = asset('storage/' . $order->payment_proof);
                } else {
                    $order->payment_proof_url = null;
                }
                return $order;
            });
    
        return response()->json(['orders' => $orders], 200);
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();

        $cartItems = Cart::where('user_id', $user->id)->get();
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
    
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            
            $paymentProof = $request->file('payment_proof');
            $paymentProofPath = $paymentProof->store('payment_proofs', 'public');

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'payment_proof' => $paymentProofPath,
                'status' => 'pending',
            ]);
        
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }
        
            Cart::where('user_id', $user->id)->delete();
    
            return response()->json(['message' => 'Order placed successfully', 'order' => $order], 200);
        }

    }

    public function listOrders()
    {
        $orders = Order::with('items.product', 'user')->orderBy('id', 'desc')->get();

        $orders = $orders->map(function ($order) {
            if ($order->payment_proof) {
                $order->payment_proof_url = asset('storage/' . $order->payment_proof);
            } else {
                $order->payment_proof_url = null;
            }
            return $order;
        });

        return response()->json(['orders' => $orders], 200);
    }

    public function editOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully'], 200);
    }
}
