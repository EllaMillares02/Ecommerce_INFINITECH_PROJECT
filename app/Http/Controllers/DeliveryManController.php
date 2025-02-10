<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
class DeliveryManController extends Controller
{
    public function index(){
        
        return view('delivery.home');
    }

    public function order_details($id){

        $orders=order::find($id);
        
        return view('delivery.order_details', compact('orders'));
    }
    public function deliveries(){
        $orders=order::all();
        $delivery_orders_count = Order::where('delivery_status', 'for delivery')->count();
        $orderItems = Order::whereIn('delivery_status', ['for delivery', 'completed'])
                   ->orderBy('created_at', 'desc')
                   ->get();
        
        return view('delivery.deliveries', compact('orders', 'orderItems', 'delivery_orders_count'));
    }

    public function uploadProof(Request $request, $id)
{
    // Find the order by ID
    $order = Order::find($id);

    $order->delivery_status=$request->delivery_status;
    $image=$request->image;

    if($image){

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('proof_of_delivery',$imagename);
        $order->proof_of_delivery=$imagename;
    }


    $order->delivery_status = 'completed';
    $order->save(); 

    session()->flash('swal', [
        'title' => 'Success!',
        'text' => 'Proof of delivery uploaded successfully!',
        'icon' => 'success',
    ]);
    
    return redirect('/')->with('message','Proof of delivery uploaded successfully!');;

}
public function cancelOrder(Request $request, $id){
   
    $request->validate([
    'cancel_reason' => 'required',
    'other_reason' => 'nullable|string|max:255',
]);

$order = order::findOrFail($id);

// Save cancellation details
$order->cancel_reason = $request->cancel_reason;
$order->other_reason = $request->other_reason; // This should be optional
$order->delivery_status = 'cancelled'; // Assuming you have a status field
$order->save();

return redirect()->back()->with('success', 'Order cancelled successfully.');
}

public function show_dashboard(){
        
    return view('delivery.home');
}
public function getLocation()
{
    $rider = User::find(6); // Replace with dynamic rider ID
    return response()->json(['latitude' => $rider->latitude, 'longitude' => $rider->longitude]);
}

}
