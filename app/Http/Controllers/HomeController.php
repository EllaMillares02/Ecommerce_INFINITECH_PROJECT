<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Models\product;
use App\Models\cart;
use App\Models\wishlist;
use App\Models\order;
use App\Models\sales;
use App\Models\category;
use App\Models\coupons;
use App\Models\Review;
use App\Models\Size;
use App\Models\Banner;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index(){

        if (Auth::check()) {
            $user = Auth::user();
             /**    if (empty($user->address) || empty($user->phone)) {
                    return redirect()->route('complete_profile');
            }*/ 

            // Check if the user is an admin
            if (Auth::user()->usertype == 1) {
                $total_prod=product::all()->count();
                $total_user = User::where('usertype', 0)->count();

                $productOutofStock = Product::whereDoesntHave('sizes', function ($query) {
                    $query->where('stock_quantity', '>', 0);
                })->count(); 

                $total_revenue = Order::whereIn('delivery_status', ['completed', 'received'])->sum('price');
                $pending_orders_count = Order::where('delivery_status', 'pending')->count();
                $pickup_orders_count = Order::where('delivery_status', 'for pickup')->count();
                $delivery_orders_count = Order::where('delivery_status', 'for delivery')->count();
                $completed_orders_count = Order::whereIn('delivery_status', ['completed', 'received'])->count();

                $salesData = DB::table('orders')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(price) as sales'))
                ->where('created_at', '>=', now()->subWeek()) // Get sales from the last 7 days
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date', 'asc') // Order by date (ascending)
                ->get();

                $previousWeekData = DB::table('orders')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(price) as sales'))
                ->where('created_at', '>=', now()->subWeeks(2)->startOfWeek()) // Sales from the previous week
                ->where('created_at', '<', now()->subWeeks(2)->endOfWeek())
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date', 'asc')
                ->get();

                $orderData = DB::table('orders')
                ->select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('COUNT(*) as orders'))
                ->where('created_at', '>=', now()->startOfWeek()) // Filter by the start of the current week
                ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
                ->orderBy('day', 'asc')
                ->get();

                // Map day numbers to names (e.g., 1 => 'Sun', 2 => 'Mon', etc.)
                $orderCounts = array_fill(0, 7, 0);  // Initialize an array with 7 days set to 0
                foreach ($orderData as $data) {
                    $orderCounts[$data->day - 1] = $data->orders;  // Fill in the actual order count per day
                }

                return view('admin.home', compact('total_prod', 
                'total_user', 'total_revenue', 'pending_orders_count', 'pickup_orders_count', 'productOutofStock',
                            'delivery_orders_count', 'completed_orders_count', 'salesData', 'orderCounts', 'previousWeekData'));

            } elseif (Auth::user()->usertype == 2) {
                
                $orders = order::all();

                $delivery_orders_count = Order::where('delivery_status', 'for delivery')->count();
                
                $morningLocations = ['Legazpi', 'Daraga'];
                $afternoonLocations = ['Guinobatan', 'Ligao', 'Oas', 'Polangui'];

                $morningDeliveries = Order::where('delivery_status', 'for delivery')
                ->where(function ($query) use ($morningLocations) {
                    foreach ($morningLocations as $location) {
                        $query->orWhere('pickup_location', 'like', "%$location%");
                    }
                })
                ->get();
    
                // Query orders for afternoon deliveries with delivery_status 'for delivery'
                $afternoonDeliveries = Order::where('delivery_status', 'for delivery')
                ->where(function ($query) use ($afternoonLocations) {
                    foreach ($afternoonLocations as $location) {
                        $query->orWhere('pickup_location', 'like', "%$location%");
                    }
                })
                ->get();

                return view('delivery.home', compact('delivery_orders_count', 
                'orders', 'morningDeliveries', 'afternoonDeliveries'));


            } else {

                $product = Product::limit(8)->where('status', 'yes')->get();
                $category = Category::all();
                $categories = Product::select('category')->groupBy('category')->selectRaw('count(*) as product_count')->orderByDesc('product_count')->take(4)->get();
                $latestProducts = Product::where('product_group', 'latest')->get();
                $topProducts = Product::where('product_group', 'top_rated')->get();
                $reviewProducts = Product::where('product_group', 'review_product')->get();
                $banners = Banner::all();
                $blogs = Blog::where('status', 'yes')->latest()->take(3)->get();
                return view('home.userpage', compact('product', 'category', 
                'latestProducts', 'topProducts', 'reviewProducts', 'categories', 'banners', 'blogs'));
            }
            
        }
    
        $product = Product::limit(8)->where('status', 'yes')->get();
        $category = Category::all();
        $categories = Product::select('category')->groupBy('category')->selectRaw('count(*) as product_count')->orderByDesc('product_count')->take(4)->get();
        $latestProducts = Product::where('product_group', 'latest')->get();
        $topProducts = Product::where('product_group', 'top_rated')->get();
        $reviewProducts = Product::where('product_group', 'review_product')->get();
        $banners = Banner::all();
        $blogs = Blog::where('status', 'yes')->latest()->take(3)->get();

        return view('home.userpage',compact('product', 'category', 
        'latestProducts', 'topProducts', 'reviewProducts', 'categories', 'banners', 'blogs'));
    }

        public function completeProfile(){
        return view('home.complete_profile'); // Ensure you have a `complete_profile.blade.php` view
    }
    public function userProfile()
{
    $product = Product::limit(8)->where('status', 'yes')->get();
    $category = Category::all();
    $categories = Product::select('category')->groupBy('category')->selectRaw('count(*) as product_count')->orderByDesc('product_count')->take(4)->get();
    $latestProducts = Product::where('product_group', 'latest')->get();
    $topProducts = Product::where('product_group', 'top_rated')->get();
    $reviewProducts = Product::where('product_group', 'review_product')->get();
    $banners = Banner::all();
    $blogs = Blog::where('status', 'yes')->latest()->take(3)->get();

    return view('home.userpage',compact('product', 'category', 
        'latestProducts', 'topProducts', 'reviewProducts', 'categories', 'banners', 'blogs'));
}
public function saveProfile(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'password' => 'nullable|min:6', // Manual confirmation check
        'password_confirmation' => 'nullable|min:6',
    ]);

    // Ensure new password and confirm password match
    if ($request->filled('password') && $request->password !== $request->password_confirmation) {
        return redirect()->back()->with('error_message', 'The password confirmation does not match.');
    }

    // Get the authenticated user
    $user = Auth::user();
    
    // Update address and phone
    $user->address = $request->address;
    $user->phone = $request->phone;

    // Check if a new password is provided
    if ($request->filled('password')) {
        // Hash the new password
        $user->password = bcrypt($request->password);
    }

    // Save the updated user data
    $user->save();

    // Redirect with a success message
    return redirect('/')->with('success_message', 'Profile updated successfully!');
}

    public function redirect(){
        
        $usertype=Auth::user()->usertype;
        
        if($usertype=='1'){

            $total_prod=product::all()->count();
            $total_user = User::where('usertype', 0)->count();

            $total_revenue = Order::whereIn('delivery_status', ['completed', 'received'])->sum('price');
            $pending_orders_count = Order::where('delivery_status', 'pending')->count();
            $pickup_orders_count = Order::where('delivery_status', 'for pickup')->count();
            $delivery_orders_count = Order::where('delivery_status', 'for delivery')->count();
            $completed_orders_count = Order::whereIn('delivery_status', ['completed', 'received'])->count();
            $productOutofStock = Product::whereDoesntHave('sizes', function ($query) {
                $query->where('stock_quantity', '>', 0);
            })->count();

            $salesData = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(price) as sales'))
            ->where('created_at', '>=', now()->subWeek()) // Get sales from the last 7 days
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc') // Order by date (ascending)
            ->get();

            $previousWeekData = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(price) as sales'))
            ->where('created_at', '>=', now()->subWeeks(2)->startOfWeek()) // Sales from the previous week
            ->where('created_at', '<', now()->subWeeks(2)->endOfWeek())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();
    
            $orderData = DB::table('orders')
                ->select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('COUNT(*) as orders'))
                ->where('created_at', '>=', now()->startOfWeek()) // Filter by the start of the current week
                ->groupBy(DB::raw('DAYOFWEEK(created_at)'))
                ->orderBy('day', 'asc')
                ->get();

            // Map day numbers to names (e.g., 1 => 'Sun', 2 => 'Mon', etc.)
            $orderCounts = array_fill(0, 7, 0);  // Initialize an array with 7 days set to 0
            foreach ($orderData as $data) {
                $orderCounts[$data->day - 1] = $data->orders;  // Fill in the actual order count per day
            }


            return view('admin.home', compact('total_prod', 
            'total_user', 'total_revenue', 'pending_orders_count', 'pickup_orders_count', 'productOutofStock',
                        'delivery_orders_count', 'completed_orders_count', 'salesData', 'previousWeekData', 'orderCounts'));

        } elseif (Auth::user()->usertype == 2) {

            $orders = order::all();
            $delivery_orders_count = Order::where('delivery_status', 'for delivery')->count();

            $morningLocations = ['Legazpi', 'Daraga', 'Camalig'];
            $afternoonLocations = ['Guinobatan', 'Ligao', 'Oas', 'Polangui'];

            /// Query orders for morning deliveries with delivery_status 'for delivery'
            $morningDeliveries = Order::where('delivery_status', 'for delivery')
            ->where(function ($query) use ($morningLocations) {
                foreach ($morningLocations as $location) {
                    $query->orWhere('pickup_location', 'like', "%$location%");
                }
            })
            ->get();

            // Query orders for afternoon deliveries with delivery_status 'for delivery'
            $afternoonDeliveries = Order::where('delivery_status', 'for delivery')
            ->where(function ($query) use ($afternoonLocations) {
                foreach ($afternoonLocations as $location) {
                    $query->orWhere('pickup_location', 'like', "%$location%");
                }
            })
            ->get();
            return view('delivery.home', compact('delivery_orders_count', 
            'orders', 'morningDeliveries', 'afternoonDeliveries'));

        }else{

            $product=product::paginate(8)->where('status', 'yes');
            $category = category::all();
            $categories = Product::select('category')->groupBy('category')->selectRaw('count(*) as product_count')->orderByDesc('product_count')->take(4)->get();
            $latestProducts = Product::where('product_group', 'latest')->get();
            $topProducts = Product::where('product_group', 'top_rated')->get();
            $reviewProducts = Product::where('product_group', 'review_product')->get();
            $banners = Banner::all();
            $blogs = Blog::where('status', 'yes')->latest()->take(3)->get();
            
            return view('home.userpage',compact('product', 'category', 
            'latestProducts', 'topProducts', 'reviewProducts','categories', 'banners', 'blogs'));
        }

    }

    public function product_details($id){

        $product=product::find($id);
        $categories = Category::all();
        $relatedProducts = Product::where('category', $product->category)
                          ->where('id', '!=', $product->id)
                          ->take(4) // Limit to 4 products
                          ->get();

        $onSaleProd = sales::where('product_id', $id)->first();

        if ($onSaleProd) {
            $discountPrice = $product->price - ($product->price * ($onSaleProd->discount / 100));
        } else {
            $discountPrice = null;
        }

        $averageRating = $product->reviews()->average('rating'); 
        $reviewsCount = $product->reviews()->count();

        return view('home.product_details',compact('product', 'onSaleProd', 
        'discountPrice', 'averageRating','reviewsCount','relatedProducts', 'categories'));        
    }

    public function add_cart(Request $request, $id){
        if (Auth::id()) {
            $user = Auth::user();
            $product = product::find($id);

            // Check if the product exists
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }
            
            $selectedFlavor = $request->input('selected_flavor');
            $selectedSize = $request->input('selected_size');
            $quantity = $request->input('quantity');
            $productName = $request->input('product_name'); // Product name with flavor and size
            $productPrice = $request->input('product_price');

            // Check if the product is on sale
            $onSaleProd = sales::where('title', $productName)->first();
            $discountPrice = $onSaleProd ? $productPrice * (1 - $onSaleProd->discount / 100) : null;

            // Retrieve the user's cart items
            $cartItem = cart::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->where('product_title', $productName)
                            ->first();
            
            
            // Check if the product is already in the cart
            if ($cartItem) {
                // Update the existing cart item
                $cartItem->quantity += $request->quantity; // Increment quantity
                // Update the price based on the new quantity

                if ($discountPrice !== null) {
                    $cartItem->price = $discountPrice * $cartItem->quantity; 
                } elseif ($product->discount_price !== null) {
                    $cartItem->price = $product->discount_price * $cartItem->quantity; 
                } else {
                    $cartItem->price = $product->price * $cartItem->quantity; 
                }
    
                
                $cartItem->save(); 
            } else {
                
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $productName;
                $cart->image = $product->image;
                $cart->product_id = $product->id;


                if ($discountPrice !== null) {
                    $cart->product_price = $discountPrice; 
                    $cart->price = $discountPrice * $request->quantity; 
                } elseif ($product->discount_price !== null) {
                    $cart->product_price = $product->discount_price; 
                    $cart->price = $product->discount_price * $request->quantity; 
                } else {
                    $cart->product_price = $productPrice; 
                    $cart->price = (float)$productPrice * (int)$request->quantity; 
                }

                $cart->quantity = $request->quantity;

                $cart->save(); 
            }

            Wishlist::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->delete();

            return redirect()->back();
        } else {
            return redirect('login_page');
        }
    }


    public function show_cart(){

        $categories = Category::all();

         if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)
            ->with('product.sale')
            ->orderBy('updated_at', 'desc') 
            ->get();

            $onsale = Sales::all();
            

            return view('home.show_cart', compact('cart', 'onsale', 'categories'));
        } else {
            return redirect('login_page');
        }
    }

    public function remove_cart($id){

        $cart=cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        // Validate the request to ensure quantity is a positive integer and at least 1
        $validated = $request->validate([
            'id' => 'required|exists:carts,id', // Ensure the cart item exists
            'quantity' => 'required|integer|min:1', // Quantity must be at least 1
        ]);
    
        // Find the cart item
        $cartItem = Cart::find($validated['id']);
    
        if ($cartItem) {
            // Update the quantity (ensuring it's at least 1)
            $cartItem->quantity = max($validated['quantity'], 1);
    
            // Update the price based on product price and quantity
            if ($cartItem->product_price) {
                $cartItem->price = $cartItem->product_price * $cartItem->quantity;
            }
    
            // Save the updated cart item
            $cartItem->save();
    
            // Calculate the updated cart total for the user
            $cartTotal = Cart::where('user_id', Auth::user()->id)
                ->sum(DB::raw('quantity * product_price'));
    
            // Return a response with the updated product subtotal and cart total
            return response()->json([
                'success' => true,
                'productSubtotal' => number_format($cartItem->price, 2), // Updated price for the product
                'cartTotal' => number_format($cartTotal, 2), // Updated total for the cart
            ]);
        }
    
        // If the cart item doesn't exist, return an error response
        return response()->json([
            'success' => false,
            'message' => 'Cart item not found.',
        ], 404);
    }
    

public function add_wishlist(Request $request, $id){
    if (Auth::id()) {
        $user = Auth::user();
        $product = product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Check if the product is on sale
        $onSaleProd = sales::where('product_id', $product->id)->first();
        $discountPrice = $onSaleProd ? $product->price * (1 - $onSaleProd->discount / 100) : null;

        // Retrieve the user's cart items
        $wishlistItem = wishlist::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();
        
        $productName = $request->input('product_name'); // Product name with flavor and size
        $productPrice = $request->input('product_price');

        // Check if the product is already in the wishlist
        if ($wishlistItem) {
            // Update the existing cart item
            $wishlistItem->quantity += $request->quantity; // Increment quantity

            // Update the price based on the new quantity

            if ($discountPrice !== null) {
                $wishlistItem->price = $discountPrice * $wishlistItem->quantity; 
            } elseif ($product->discount_price !== null) {
                $wishlistItem->price = $product->discount_price * $wishlistItem->quantity; 
            } else {
                $wishlistItem->price = $product->productPrice * $wishlistItem->quantity; 
            }

            
            $wishlistItem->save(); 
        } else {
            
            $wish = new wishlist;
            $wish->name = $user->name;
            $wish->email = $user->email;
            $wish->phone = $user->phone;
            $wish->address = $user->address;
            $wish->user_id = $user->id;
            $wish->product_title = $productName;
            $wish->image = $product->image;
            $wish->product_id = $product->id;


            if ($discountPrice !== null) {
                $wish->price = $discountPrice * $request->quantity; 
            } elseif ($product->discount_price !== null) {
                $wish->price = $product->discount_price * $request->quantity; 
            } else {
                $wish->price = $product->price * $request->quantity; 
            }

            $wish->quantity = $request->quantity;

            $wish->save(); 
        }

        return redirect('show_wishlist');
    } else {
        return redirect('login_page');
    }
}

public function show_wishlist(){

    $categories = Category::all();

    if (Auth::id()) {
       $id = Auth::user()->id;
       $wishlists = wishlist::where('user_id', $id)
       ->with('product.sale')
       ->orderBy('created_at', 'desc') 
       ->get();


       return view('home.show_wishlist', compact('wishlists', 'categories'));
   } else {
       return redirect('login_page');
   }
}

public function remove_wishlist($id){

    $wishlist=wishlist::find($id);
    $wishlist->delete();

    return redirect()->back();
}

public function checkout(Request $request)
{
    if (Auth::check()) {
        $user = Auth::user();
        
        // Fetch selected products (from the form submission if products are passed)
        $selectedProducts = $request->input('selected_products') 
                            ? json_decode($request->input('selected_products'), true) 
                            : [];
        // Pass user data and selected products to the checkout view
        $productID = $request->input('product_id');
        $qty = $request->input('quantity');
        $image = $request->input('image');
        $productName = $request->input('productName');
        $productPrice = $request->input('product_price');
        $discountAmount = $request->input('discount', 0); // Get the discount value

        if (empty($selectedProducts)) {
            $productID = $request->input('product_id');
            $qty = $request->input('quantity');
            $image = $request->input('image');
            $productName = $request->input('productName');
            $productPrice = $request->input('product_price');
            $discountAmount = $request->input('discount', 0); // Get the discount value
        
            $selectedProducts[] = [
                'title' => $productName,
                'price' => $productPrice,
                'quantity' => $qty,
                'prod_id' => $productID,
                'img' => $image,
                'discount' => $discountAmount,
            ];
        }
        
        return view('home.checkout', [
            'user' => $user,
            'selectedProducts' => $selectedProducts,
            'discountAmount' => $discountAmount,

        ]);
    } else {
        return redirect('login_page');
    }

}
 
public function save_orders(Request $request)
{
    $user = Auth::user();
    $userid = $user->id;
    $total = $request->input('total');

    $pickupLocation = $request->input('delivery_address');
    $deliveryType = $request->input('hidden_delivery_type');
    $products = $request->input('products', []);
   
    $productTitles = [];
    $productQuantities = [];
    $productImages = [];
    $productIds = [];

    foreach ($products as $productData) {
        $product = json_decode($productData, true); // Decode each product JSON
        
        
        $productTitles[] = $product['title'];
        $productQuantities[] = $product['quantity'];
        $productImages[] = $product['img'];
        $productIds[] = $product['prod_id']; 
    }

    
    $order = new Order();
    $order->user_id = $userid;
    $order->name = $user->name;
    $order->email = $user->email;
    $order->phone = $user->phone;
    $order->address = $user->address;
    $order->delivery_status = 'pending';
    $order->pickup_location = $pickupLocation;
    $order->delivery_type = $deliveryType;

    $order->product_title = implode(', ', $productTitles);      
    $order->quantity = implode(', ', $productQuantities); 
    $order->image = implode(', ', $productImages);         
    $order->product_id = implode(', ', $productIds);       
    $order->price = $total;                         

    // Save the order
    $order->save();

    // Remove the products from the user's cart if cart_id exists
    if (!empty($product['cart_id'])) {
        Cart::where('id', $product['cart_id'])
            ->where('user_id', $userid)
            ->delete();
    }


    $productInDb = Product::find($product['prod_id']);

        if ($productInDb) {
            $productTitle = $product['title']; // Full product title with size

            // Find the size entry in the database
            $size = Size::where('product_id', $product['prod_id'])
                        ->where(function ($query) use ($productTitle) {
                            $query->whereRaw("? LIKE CONCAT('%', size, '%')", [$productTitle]);
                        })
                        ->first();

            if ($size) {
                $size->stock_quantity -= $product['quantity'];
                $size->stock_quantity = max($size->stock_quantity, 0); 
                $size->sold_quantity += $product['quantity'];
                $size->save();
            }
     }

    $orderDetails = '';
    foreach ($products as $productData) {
        $product = json_decode($productData, true);
        $orderDetails .= 'Product: ' . $product['title'] . ', Quantity: ' . $product['quantity'] . '<br>';
    }
    $orderDetails .= '<strong>Total: ₱' . $total . '</strong>';
    $orderDetails .= '<br>Pickup Location: ' . $pickupLocation;
    $orderDetails .= '<br>Delivery Type: ' . $deliveryType;

    // Create and send the order confirmation email
    Mail::to($user->email)->send(new OrderConfirmationMail($orderDetails));

    //session()->flash('message', 'Thank you for successfully ordering our products!');
    Alert::success('Thank You!', 'Thank you for successfully ordering our products!');

    return redirect('/orders');
}

public function orders(){

    $categories = Category::all();

    if (Auth::id()) {

        $orders = order::all();
        $id = Auth::user()->id;
        
        $orderItems = Order::where('user_id', $id)
        ->where('delivery_type', 'delivery')
        ->whereIn('delivery_status', ['pending', 'for delivery'])
        ->orderBy('created_at', 'desc') // Order by created_at in descending order
        ->get();

        $orderItemspickup = Order::where('user_id', $id)
               ->where('delivery_type', 'pickup')
               ->whereIn('delivery_status', ['pending','for pickup'])
               ->orderBy('created_at', 'desc')
               ->get();
        $orderComplete= Order::where('user_id', $id)
               ->whereIn('delivery_status', ['completed', 'received'])
               ->orderBy('created_at', 'desc')
               ->get();
        $orderItemscancel = Order::where('user_id', $id)
               ->where('delivery_status', 'cancelled')
               ->orderBy('created_at', 'desc')
               ->get();

        $deliveryOrdersCount = Order::where('user_id', $id)
               ->where('delivery_type', 'delivery')
               ->whereIn('delivery_status', ['pending','for delivery'])
               ->count();

        $pickupOrdersCount = Order::where('user_id', $id)
               ->where('delivery_type', 'pickup')
               ->whereIn('delivery_status', ['pending', 'for pickup'])
               ->count();
        $completeOrdersCount = Order::where('user_id', $id)
                ->whereIn('delivery_status', ['completed', 'received'])
               ->count();

        $cancelOrdersCount = Order::where('user_id', $id)
               ->where('delivery_status', 'cancelled')
               ->count();
        $today = Carbon::now();

        // Calculate the estimated delivery date range (2-5 days from today)
        $minDate = $today->copy()->addDays(2)->format('F d');
        $maxDate = $today->copy()->addDays(5)->format('d, Y');
       
           // Pass the count along with the other data to the view
           return view('home.orders', compact('orders', 'orderItems', 'orderItemspickup', 
                        'deliveryOrdersCount', 'pickupOrdersCount', 'orderComplete', 'completeOrdersCount', 'orderItemscancel', 'cancelOrdersCount', 
                        'categories', 'minDate', 'maxDate'));

   } else {
       return redirect('login_page');
   }
}  

public function show_shop(Request $request){

    $query = $request->input('query'); // Retrieve the filter query (e.g., "Dairy-Free")

    // Search for products where 'description' matches the query
    if ($query) {
        $products = Product::where('description', 'like', '%' . $query . '%')
        ->where('status', 'yes')
        ->paginate(12);
    } else {
        $products = Product::where('status', 'yes')->paginate(12);// Default, if no filter is applied

    }
    $categories = Category::all();
    $onSaleProd = sales::all();
    $productCount = $products->count();
    $latestProducts = Product::where('product_group', 'latest')->get();

    return view('home.show_shop', compact('categories','onSaleProd','products', 'productCount', 'latestProducts')) ;
}


public function validateCoupon(Request $request)
{
    // Validate coupon input
    $request->validate([
        'coupon' => 'required|string'
    ]);

    // Retrieve the coupon based on the code and validate its status, dates, and quantity
    $coupon = coupons::where('code', $request->coupon)
                    ->where('is_active', 1)
                    ->whereDate('valid_from', '<=', now())
                    ->whereDate('valid_until', '>=', now())
                    ->first();

    if ($coupon) {
        // Check if the coupon quantity is greater than 0
        if ($coupon->quantity > 0) {

            $coupon->decrement('quantity');

            return response()->json([
                'success' => true,
                'discount_type' => 'fixed', // Since you are using a fixed amount
                'discount' => $coupon->discount_amount
            ]);
        } else {
            // Coupon is valid but has no remaining quantity
            return response()->json([
                'success' => false,
                'message' => 'This coupon is no longer available.'
            ]);
        }
    }

    // If the coupon doesn't exist or is inactive/expired
    return response()->json([
        'success' => false,
        'message' => 'Invalid or expired coupon.'
    ]);
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
public function received($id){

    $orders=order::find($id);

    if ($orders) {
        $orders->delivery_status = "received"; // Update the delivery status
        $orders->save(); // Save the changes
    }

    return redirect()->back();
}

public function e_receipt($id){

    $order=order::find($id);

    return view('home.e_receipt', compact('order')) ;
}

public function blogs(){
    
    $categories = Category::all();
    $blogs = Blog::where('status', 'yes')->latest()->get();

    return view('home.view_blogs', compact('categories', 'categories', 'blogs'));

}  

public function blog_details($id){
    
    $categories = Category::all();
    $relatedBlogs = Blog::where('status', 'yes')->where('id', '!=', $id) 
                        ->latest()
                        ->take(3)
                        ->get();
                        
    $blog_details = Blog::where('id', $id)->where('status', 'yes')->firstOrFail();

    return view('home.blog_details', compact('categories', 'categories', 'relatedBlogs', 'blog_details'));

}  
public function rate_now($id){

    $order=order::find($id);
    $categories = Category::all();

    return view('home.rate_now', compact('order', 'categories'));
}

public function submitReviews(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'reviews' => 'required|array',
        'reviews.*.text' => 'required|string|max:500', // Adjust max length as needed
        'reviews.*.rating' => 'required|integer|between:1,5',
        'reviews.*.product_id' => 'required|integer|exists:products,id', // Ensure product_id is valid
    ]);

    // Loop through the reviews and save them
    foreach ($request->reviews as $reviewData) {
        Review::create([
            'product_id' => $reviewData['product_id'], // Use the actual product ID
            'review_text' => $reviewData['text'],
            'rating' => $reviewData['rating'],
            'user_id' => Auth::id(),
        ]);
    }

    session()->flash('swal', [
        'title' => 'Thank you!',
        'text' => 'Thank you for your rating!',
        'icon' => 'success'
    ]);

    return redirect()->route('orders');
}

public function contact(){

    $categories = Category::all();

    return view('home.contact', compact('categories'));
}

public function search_page(Request $request)
{
    $query = $request->input('query'); // Retrieve the search input
    $categories = Category::all();
    // Search for products where the 'name' field matches the query
    $results = product::where('title', 'like', '%' . $query . '%')->get();

    // Pass results to the search results view
    return view('home.search_page', compact('results', 'query', 'categories'));
}
public function categories_page(Request $request)
{
    $query = $request->input('query'); // Retrieve the search input
    
    // Search for products where the 'name' field matches the query
    $results = product::where('title', 'like', '%' . $query . '%')->get();

    // Pass results to the search results view
    return view('home.search_page', compact('results', 'query'));
}
public function categoryProducts($categoryName)
{
    $product = product::where('category', $categoryName)->get();
    $categories = Category::all();

    return view('home.category_products', compact('categoryName', 'product', 'categories'));
}

public function show_profile(){
    return view('home.show_profile');
}
public function login_page(){
    return view('home.login_page'); 
}
public function register_page(){
    return view('home.register_page');
}

public function show_faqs(){
    return view('home.show_faqs');
}

public function send(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // You can process the data here (e.g., send an email, store in the database, etc.)
        
        // Example: Send an email to the admin (assuming you have mail setup)
        Mail::to('albaydairyboxecommerce@gmail.com')->send(new ContactMessage($request->all()));

        // Return a success response or redirect
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

}
