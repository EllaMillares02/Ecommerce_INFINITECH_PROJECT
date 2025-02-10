<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Http\Middleware\ChatRoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\order;
use App\Models\sales;
use App\Models\coupons;
use App\Models\ChMessage;
use App\Models\Flavor;
use App\Models\Size;
use App\Models\Image;
use App\Models\Banner;
use App\Models\User;
use App\Models\Admin;
use App\Models\Blog;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.home');
    }
    public function view_category(){
        $data=category::all();

        return view('admin.category',compact('data'));

    }
    public function add_category(Request $request){

       $data=new category;
       $data ->category_name=$request->category;

       $image=$request->image;
       $imagename=time().'.'.$image->getClientOriginalExtension();

       $request->image->move('prod_category',$imagename);
       $data->image=$imagename;

       $data->save();

       return redirect()->back()->with('swal', [
        'title' => 'Success!',
        'text' => 'Category Added Successfully',
        'icon' => 'success',
        ]);
    }

    public function delete_category($id){
        $data=category::find($id);

        $data->delete();

        return redirect()->back()->with('message','Category deleted successfully!');
    }

    public function update_category($id){

        $category=category::find($id);
        return view('admin.update_category',compact('category'));

    }

    public function update_category_confirm(Request $request, $id){

        $category=category::find($id);
        $category->category_name=$request->category;

        $image=$request->image;
        
        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('prod_category',$imagename);
            $category->image=$imagename;
        }

        $category->save();

        return redirect()->route('view_category')->with('swal', [
        'title' => 'Product Updated!',
        'text' => 'The category has been updated successfully.',
        'icon' => 'success',
        'confirmButtonText' => 'OK'
    ]);

    }


    public function view_product(){
        $category = category::all();
        return view('admin.product',compact('category'));
    }

    public function add_product(Request $request)
    {
       // dd($request->all());
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|array',  // Ensure the images field is an array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image types
            'sizes' => 'required|array', // Ensure sizes is an array
            'size_prices' => 'required|array', // Ensure size_prices is an array
        ]);

        // Create the product first
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount;
        $product->status = $request->status;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->information = $request->information;
        $product->product_group = $request->grouping;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();  // Save product first

        // Handle the images upload and save in the images table
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = time() . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product'), $imageName);  

                // Save the image path and link it to the product
                $product->images()->create([
                    'path' => $imageName, 
                ]);
            }
        }

        if ($request->has('flavors')) {
            foreach ($request->flavors as $flavorIndex => $flavorName) {
                // Save each flavor
                $flavor = new Flavor();
                $flavor->product_id = $product->id;
                $flavor->name = $flavorName;
                $flavor->save();
    
                // Handle sizes for the current flavor
                if (isset($request->sizes[$flavorIndex])) {
                    foreach ($request->sizes[$flavorIndex] as $sizeIndex => $sizeName) {
                        $size = new Size();
                        $size->product_id = $product->id;
                        $size->flavor_id = $flavor->id;
                        $size->size = $sizeName;
                        $size->price = $request->size_prices[$flavorIndex][$sizeIndex];
                        $size->stock_quantity = $request->size_quantities[$flavorIndex][$sizeIndex];
                        $size->save();
                    }
                }
            }
        }
        // Return success response
        return redirect()->route('show_product')->with('swal', [
            'title' => 'Product Added!',
            'text' => 'The product has been added successfully.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);

    }
    

    public function show_product(){
    
        $product = Product::whereHas('sizes', function ($query) {
            $query->where('stock_quantity', '>', 0);
        })->get();
        
        $outOfStockCount = Product::whereDoesntHave('sizes', function ($query) {
            $query->where('stock_quantity', '>', 0);
        })->count();
        

        return view('admin.show_product',compact('product', 'outOfStockCount'));

    }
    public function outOfStock_product(){
     
        $product = Product::whereDoesntHave('sizes', function ($query) {
            $query->where('stock_quantity', '>', 0);
        })->get();        

        return view('admin.outOfStock_product',compact('product'));

    }
    public function delete_product($id){

        $product=product::find($id);

        $product->delete();

        return redirect('show_product')->with('message','Product deleted successfully!');
    }

    public function update_product($id){

        $product=product::find($id);
        $category=category::all();
        return view('admin.update_product',compact('product','category'));

    }

    public function update_product_confirm(Request $request, $id){
        
       // dd($request->all());

        $product=product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount;
        $product->status = $request->status;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->information = $request->information;
        $product->product_group = $request->grouping;
            
        $image=$request->image;
        
        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
        
        $product->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
    
            foreach ($images as $image) {
                $imageName = time() . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product'), $imageName);  // Move the image to the public directory
    
                // Save the image path and link it to the product
                $product->images()->create([
                    'path' => $imageName, // Store the image path in the 'path' column of the images table
                ]);
            }
        }

        if ($request->has('flavors')) {
            // Step 1: Clear old data
            Flavor::where('product_id', $product->id)->delete();
            Size::where('product_id', $product->id)->delete();
    
            // Step 2: Save new flavors and sizes
            foreach ($request->flavors as $flavorIndex => $flavorName) {
                // Save each flavor
                $flavor = new Flavor();
                $flavor->product_id = $product->id;
                $flavor->name = $flavorName;
                $flavor->save();
    
                // Save sizes for the current flavor
                if (isset($request->sizes[$flavorIndex])) {
                    foreach ($request->sizes[$flavorIndex] as $sizeIndex => $sizeName) {
                        $size = new Size();
                        $size->product_id = $product->id;
                        $size->flavor_id = $flavor->id;
                        $size->size = $sizeName;
                        $size->price = $request->size_prices[$flavorIndex][$sizeIndex];
                        $size->stock_quantity = $request->size_quantities[$flavorIndex][$sizeIndex];
                        $size->save();
                    }
                }
            }
        }

    // Redirect or respond as needed
    
        // Return success response
        return redirect()->route('show_product')->with('swal', [
            'title' => 'Product Updated!',
            'text' => 'The product has been updated successfully.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
    }

    public function view_order(){
        
        $orders = order::where('delivery_status', 'pending')->orderBy('created_at', 'desc')->get();
        $pickup = Order::where('delivery_status','for pickup')->orderBy('created_at', 'desc')->get();
        $delivery = Order::where('delivery_status','for delivery')->orderBy('created_at', 'desc')->get();
        $completed = Order::whereIn('delivery_status', ['completed','received'])->orderBy('created_at', 'desc')->get();
        $cancelled = Order::where('delivery_status', 'cancelled')->orderBy('created_at', 'desc')->get();
        $countOrders = order::where('delivery_status', 'pending')->count();
        $countPickup = order::where('delivery_status', 'for pickup')->count();
        $countdelivery = order::where('delivery_status', 'for delivery')->count(); 
        $countcompleted = order::whereIn('delivery_status', ['completed','received'])->count();
        $cancelledcompleted = order::where('delivery_status', 'cancelled')->count();  

        return view('admin.view_order', compact('orders', 'delivery', 
                    'completed', 'countOrders', 'pickup', 'cancelled', 'countPickup', 'countdelivery',
                    'countcompleted', 'cancelledcompleted'));
    }
    public function accepted($id){
        $orders=order::find($id);

        if ($orders->delivery_type === 'pickup') {
            $orders->delivery_status = 'for pickup';
        } elseif ($orders->delivery_type === 'delivery') {
            $orders->delivery_status = 'for delivery';
        }

        $orders->save();

        return redirect()->back();
    }

    public function toDeliver(Request $request, $id)
    {
        
        $order = Order::findOrFail($id); 
    
        $image=$request->image;

        if($image){
    
            $imagename=time().'.'.$image->getClientOriginalExtension();
    
            $request->image->move('proof_of_delivery',$imagename);
            $order->proof_of_delivery=$imagename;
        }
    

        $order->delivery_status = 'completed';
        $order->save(); 
    
        // Flash success message
        session()->flash('swal', [
            'title' => 'Success!',
            'text' => 'Proof of delivery uploaded successfully!',
            'icon' => 'success',
        ]);
    
        return redirect('view_order')->with('message', 'Proof of delivery uploaded successfully and Order Completed!');
    }
    

    public function sale(){

        $products = product::all();
        $sales=sales::all();

        return view('admin.sale', compact('products', 'sales'));

    }

    public function add_sale(Request $request){
 
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'title' => 'required|string',
        'price' => 'required|numeric',
        'discount_value' => 'nullable|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Create a new sales record
    $data = new sales;

    $data->product_id = $request->product_id;
    $data->title = $request->title; // Save the generated title
    $data->price = $request->price; // Save the price
    $data->discount = $request->discount_value;
    $data->start_date = $request->start_date;
    $data->end_date = $request->end_date;

    $data->save();

    return redirect()->back()->with('swal', [
        'title' => 'Success!',
        'text' => 'Product on Sale Added Successfully',
        'icon' => 'success',
    ]);
}


    public function view_sale(){

        $sales=sales::all();
        return view('admin.view_sale',compact('sales'));

    }
    public function delete_sale($id){

        $sales=sales::find($id);

        $sales->delete();

        return redirect()->back()->with('message','Product deleted successfully!');

    }
    public function update_sale($id){

        $sales=sales::find($id);
        $products = product::all();
        
        return view('admin.update_sale',compact('sales','products'));

    }
    public function update_sale_confirm(Request $request, $id){

        $sales=sales::find($id);
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'title' => 'required|string',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        $sales->product_id = $request->product_id;
        $sales->title = $request->title; // Save the generated title
        $sales->price = $request->price; 
        $sales->discount = $request->discount_value;
        $sales->start_date = $request->start_date;
        $sales->end_date = $request->end_date;

        $sales->save();

        return redirect()->route('sale')->with('swal', [
            'title' => 'Product on Sale Updated!',
            'text' => 'The Product on Sale has been updated successfully.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
    }

    public function view_coupons(){

        $coupons = coupons::all();

        return view('admin.view_coupons', compact('coupons'));
    }

    public function add_coupon(Request $request){
        $data=new coupons;
        $data ->code=$request->code;
        $data ->discount_amount=$request->discount_amount;
        $data ->valid_from=$request->valid_from;
        $data ->valid_until=$request->valid_until;
        $data ->is_active=$request->is_active;
        $data ->quantity=$request->quantity;

        $data->save();

        return redirect()->back()->with('swal', [
            'title' => 'Success!',
            'text' => 'Coupon Added Successfully',
            'icon' => 'success',
            ]);

    }
    public function update_coupon($id){

        $coupons=coupons::find($id);
        return view('admin.update_coupon',compact('coupons'));

    }

    public function update_coupon_confirm(Request $request, $id){
        $coupon=coupons::find($id);

        $coupon->code = $request->code;
        $coupon ->discount_amount=$request->discount_amount;
        $coupon ->valid_from=$request->valid_from;
        $coupon ->valid_until=$request->valid_until;
        $coupon ->is_active=$request->is_active;
        $coupon ->quantity=$request->quantity;

        $coupon->save();

        return redirect()->route('view_coupons')->with('swal', [
            'title' => 'Coupons Updated!',
            'text' => 'The Coupon has been updated successfully.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
    }

    public function delete_coupon($id){

        $coupon=coupons::find($id);

        $coupon->delete();

        return redirect()->back()->with('message','Coupon deleted successfully!');

    }

    public function view_inventory(){

        $products = product::all();
        $sales=sales::all();

        return view('admin.view_inventory', compact('products', 'sales'));
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

public function changeBanner(){
    $banners = Banner::all(); // Retrieve all banners from the database
    return view('admin.changeBanner', compact('banners'));
}
public function updateBanner(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Get the file from the request
    if ($request->hasFile('banner_image')) {
        $image = $request->file('banner_image');

        // Define the file name to be the same as the existing one: e.g., banner1.jpg, banner2.jpg
        $imageName = 'banner' . $id . '.' . $image->getClientOriginalExtension();

        // Define the full path where the image will be stored
        $imagePath = public_path('img/hero/' . $imageName);

        // Check if the old image exists and delete it
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Store the new image in the desired location with the same file name
        $image->move(public_path('img/hero'), $imageName);

        // Find the banner and update its image path in the database (store only the filename)
        $banner = Banner::find($id);
        if ($banner) {
            $banner->update(['image_path' => $imageName]);
        }

        return back()->with('success', 'Banner updated successfully!');
    }

    return back()->with('error', 'No image uploaded!');
}
public function manage_blogs(){
    $blogs = Blog::all();

    return view('admin.view_blogs', compact('blogs'));
}

public function add_blogs(){
   
    return view('admin.add_blogs');
}
public function save_blog(Request $request){
    
    $request->validate([
        'title'   => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'content' => 'required',
        'image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'date'    => 'required|date',
        'status'  => 'required|in:yes,no',
    ]);

    // Handle file upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('admin/assets/images/blogs');
        $image->move($destinationPath, $imageName);
        $imagePath = 'admin/assets/images/blogs/' . $imageName; 
    } else {
        $imagePath = null;
    }

    // Save blog to database
    Blog::create([
        'title'   => $request->title,
        'subtitle' => $request->subtitle,
        'content' => $request->content,
        'image'   => $imagePath,
        'date'    => $request->date,
        'status'  => $request->status,
    ]);

    return redirect()->route('manage_blogs')->with('success', 'Blog added successfully!');
 
}
public function update_blog($id){

    $blog=Blog::find($id);
    return view('admin.update_blog', compact('blog'));
}
public function update_blog_confirm(Request $request, $id){
    $blog = Blog::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'subtitle' => 'required',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'date' => 'required|date',
        'status' => 'required'
    ]);

    // Handle Image Update
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('admin/assets/images/blogs');
        $image->move($destinationPath, $imageName);
        $imagePath = 'admin/assets/images/blogs/' . $imageName; 
    } else {
        $imagePath = null;
    }

    $blog->update([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'content' => $request->content,
        'image'   => $imagePath,
        'date' => $request->date,
        'status' => $request->status,
    ]);

    return redirect()->route('manage_blogs')->with('success', 'Blog updated successfully!');

}

public function delete_blog($id){

    $blog=Blog::find($id);

    $blog->delete();

    return redirect()->route('manage_blogs')->with('success', 'Blog deleted successfully!');

}
    public function addAdmin(){

        $users = User::whereIn('usertype', [1, 2])->get();
        return view('admin.addAdmin', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city_municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $user = User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'usertype' => 1, 
            'password' => Hash::make($request->password),
        ]);
    

        Admin::create([
            'user_id' => $user->id,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'street' => $request->street,
            'barangay' => $request->barangay,
            'city_municipality' => $request->city_municipality,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
        ]);

        // Redirect or return a response
        return redirect()->route('addAdmin')->with('success', 'Admin added successfully');
    }

    public function updateAdminAcc($id){

        $user = User::with('admin')->find($id);

        return view('admin.updateAdminAcc', compact('user'));

    }

    public function updateAdminAcc_confirm(Request $request, $id){

       // Find the user
        $user = User::findOrFail($id);

        // Update user details
        $user->name = $request->firstname . ' ' . $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->usertype = 1;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save(); // Ensure changes are saved

        // Find or create the related admin record
        $admin = Admin::firstOrNew(['user_id' => $user->id]);
        $admin->first_name = $request->firstname;
        $admin->last_name = $request->lastname;
        $admin->street = $request->street;
        $admin->barangay = $request->barangay;
        $admin->city_municipality = $request->city_municipality;
        $admin->province = $request->province;
        $admin->postal_code = $request->postal_code;
        $admin->phone = $request->phone;
        $admin->save(); // Ensure admin details are saved

        // Redirect or return a response
        return redirect()->route('addAdmin')->with('success', 'Admin updated successfully');
    }

    public function delete_user($id){

        $user=User::find($id);

        $user->delete();

        return redirect()->back()->with('message','User deleted successfully!');

    }

    public function inventory(Request $request)
{
    $query = Product::query();

    if ($request->has('filterType')) {
        $filterType = $request->filterType;

        if ($filterType == 'date' && $request->filterDate) {
            $query->whereDate('updated_at', $request->filterDate);
        }

        if ($filterType == 'month' && $request->filterMonth) {
            $query->whereYear('updated_at', Carbon::parse($request->filterMonth)->year)
                  ->whereMonth('updated_at', Carbon::parse($request->filterMonth)->month);
        }

        if ($filterType == 'year' && $request->filterYear) {
            $query->whereYear('updated_at', $request->filterYear);
        }
    }

    $products = $query->with('flavors.sizes')->get();

    return view('admin.view_inventory', compact('products'));
}

}
