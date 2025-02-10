<!DOCTYPE html>
<html lang="en"> 
<head>
    <base href="/public">

    <title>Admin Dashboard</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="admin/favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="admin/assets/plugins/fontawesome/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">

    <style>
         .card-header{
            background-color: #edfdf6; 
            color: #51b37f; 
            font-weight: bold;
        }
        label{
            display: inline-block;
            width: 300px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .row{
            padding-bottom: 15px;
        }
        input, select{
            width: 100%;
        }
        .div_design{
            width: 50%;
            margin-left: 25%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .rmvBTN1{
            background-color: crimson; 
            margin-left: 40%;
            color: white;
            width: 20%;
        }
        .rmvBTN{
            background-color: crimson; 
            margin-left: 25%;
            color: white;
            width: 20%;
        }
        .rmvSizeBTN{
            background-color: crimson;
            color: white;
            width: 20%;
            height: 30px;
            padding: 3px;
            font-size: 0.6rem;
            margin-top: 5px;
        }
        .addBTN{
            background-color: seagreen; 
           
            color: white;
            width: 20%;
        }
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                @if(session()->has('message'))

                <div class="alert alert-success">

                    {{session()->get('message')}}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    
                </div>
                
             @endif

                    <h1 class="app-page-title">Update Product</h1>

                    <div class="card mb-4">
                        <div class="card-header">Update Product</div>
                            <div class="card-body">

                    <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-6">
                                <label>Change Product Title: </label>
                                <input type="text" name="title" placeholder="Write a title" required="" value="{{$product->title}}">
                            </div>
                            <div class="col-lg-6">
                                <label>Change Product Brand: </label>
                                <input type="text" name="brand" placeholder="Write a brand" required="" value="{{$product->brand}}">
                            </div>
                        </div>
                        
                        <div id="flavor-size-container">
                            <!-- Loop through existing flavors and sizes -->
                            @foreach($product->flavors as $flavorIndex => $flavor)
                            <div class="flavor-size-row">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Colors:</label>
                                        <div class="flavor-section">
                                            <div class="flavor-input">
                                                <!-- Populate existing flavor -->
                                                <input type="text" name="flavors[]" class="mb-2" value="{{ $flavor['name'] }}" placeholder="Enter flavor">
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-lg-6">
                                        <label>Sizes, Prices & Quantities:</label>
                                        <div class="size-section">
                                            @foreach($flavor['sizes'] as $sizeIndex => $size)
                                            <div class="size-input">
                                                <div class="d-flex gap-2 mb-2">
                                                    <!-- Populate existing size, price, and quantity -->
                                                    <input type="text" name="sizes[{{ $flavorIndex }}][]" value="{{ $size['size'] }}" placeholder="Enter size">
                                                    <input type="number" name="size_prices[{{ $flavorIndex }}][]" value="{{ $size['price'] }}" placeholder="Enter price" step="0.01">
                                                    <input type="number" name="size_quantities[{{ $flavorIndex }}][]" value="{{ $size['stock_quantity'] }}" placeholder="Enter quantity" min="0">

                                                    <button class="rmvSizeBTN" type="button" onclick="removeSizeSection(this)">Remove</button>
                                                </div>
                                            </div>
                                            @endforeach
                        
                                            <!-- Add Size Button -->
                                            <div class="d-flex gap-2 mb-2">
                                                <button style="margin-left: 40%" class="addBTN" type="button" onclick="addSizeSection(this)">Add Size</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <hr>
                                <!-- Add and Remove Flavor-Size Row Buttons -->
                                <div class="d-flex gap-2 mb-2 mt-2">
                                    <button class="rmvBTN" type="button" onclick="removeFlavorSizeRow(this)">Remove</button>
                                    <button class="addBTN" type="button" onclick="addFlavorSizeRow()">Add Flavor & Size</button>
                                </div>
                            </div>
                            @endforeach
                        </div>                                          

                        <div class="row">
                            <div class="col-lg-12">
                                <label>Product Description: </label>
                                <textarea name="description" rows="12" cols="50" placeholder="Write a description here..." required="" >{{$product->description}}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label>Product Information: </label>
                                <textarea name="information" rows="12" cols="50" placeholder="Write a Information here..." required="">{{$product->information}}</textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Change Product Minimum Price: </label>
                                <input type="number" name="price" placeholder="Write a product minimum price" required="" value="{{$product->price}}">
                            </div>
                            <div class="col-lg-6">
                                <label>Change Discount Price: </label>
                                <input type="number" name="discount" placeholder="Write a discount, if applicable" value="{{$product->discount_price}}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Change Product Category: </label>
                                <select name="category" required="">
                                    <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                                    @foreach ($category as $category)
                                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select> <!-- Add missing closing tag here -->
                            </div>
                            <div class="col-lg-3">
                                <label>Change Product Grouping:</label>
                                <select name="grouping" id="grouping">
                                    <option value="{{$product->product_group}}" selected="">{{$product->product_group}}</option>
                                    <option value="latest">Latest Product</option>
                                    <option value="top_rated">Top Rated</option>
                                    <option value="review_product">Review Product</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Change Availability:</label>
                                <select name="status"  required="">
                                    <option value="{{$product->status}}">{{$product->status}}</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Current Product Image: </label>
                                <img style="margin: auto;" width="200" height="auto" src="/product/{{$product->image}}">
                                <input type="file" name="image">
                            </div>
                            <div class="col-lg-6">
                                <label>Other Image: </label>
                                @foreach ($product->images as $image)
                                    <img style="margin: auto;" width="200" height="auto" src="{{ asset('product/' . $image->path) }}" alt="Product Image">
                                @endforeach 
                                <input type="file" name="images[]" multiple>
                            </div>
                        </div>
                        
                    </div>
                        
                        <div class="div_design">
                            <input type="submit" class="btn btn-primary text-white" value="Update Product">
                        </div>
                        
                    </form>
                </div>

            </div>
        </div>
        </div></div>

	    
	    <footer class="app-footer">
		    <div class="container text-center py-3">
		        
		    </div>
	    </footer><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="admin/assets/plugins/popper.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="admin/assets/plugins/chart.js/chart.min.js"></script> 
    <script src="admin/assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="admin/assets/js/app.js"></script> 

    <script>
        document.addEventListener("DOMContentLoaded", function() {
       tinymce.init({
       selector: 'textarea[name="description"], textarea[name="information"]',  // Select both textareas
       plugins: 'lists link image preview',
       toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
       menubar: false,
       branding: false
       });
   });

 // Add a new size section
function addSizeSection(button) {
    const flavorSizeRow = button.closest('.flavor-size-row');
    const sizeSection = flavorSizeRow.querySelector('.size-section');
    const flavorIndex = Array.from(document.querySelectorAll('.flavor-size-row')).indexOf(flavorSizeRow);

    const newSizeSection = document.createElement('div');
    newSizeSection.classList.add('size-input');

    newSizeSection.innerHTML = `
        <div class="d-flex gap-2 mb-2">
            <input type="text" name="sizes[${flavorIndex}][]" placeholder="Enter size">
            <input type="number" name="size_prices[${flavorIndex}][]" placeholder="Enter price" step="0.01">
            <input type="number" name="size_quantities[${flavorIndex}][]" placeholder="Enter quantity" min="0">
        </div>
        <div class="d-flex gap-2 mb-2">
            <button class="rmvBTN1" type="button" onclick="removeSizeSection(this)">Remove</button>
        </div>
    `;

    sizeSection.insertBefore(newSizeSection, button.closest('.d-flex'));
}

// Add a new flavor-size row
function addFlavorSizeRow() {
    const flavorSizeContainer = document.getElementById('flavor-size-container');
    const flavorIndex = document.querySelectorAll('.flavor-size-row').length; // This should work for flavor index

    const newFlavorSizeRow = document.createElement('div');
    newFlavorSizeRow.classList.add('flavor-size-row');

    newFlavorSizeRow.innerHTML = `
        <div class="row">
            <div class="col-lg-6">
                <label>Flavors:</label>
                <div class="flavor-section">
                    <div class="flavor-input">
                        <input type="text" name="flavors[]" placeholder="Enter flavor">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <label>Sizes, Prices & Quantities:</label>
                <div class="size-section">
                    <div class="size-input">
                        <div class="d-flex gap-2 mb-2">
                            <input type="text" name="sizes[${flavorIndex}][]" placeholder="Enter size">
                            <input type="number" name="size_prices[${flavorIndex}][]" placeholder="Enter price" step="0.01">
                            <input type="number" name="size_quantities[${flavorIndex}][]" placeholder="Enter quantity" min="0">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <button class="addBTN" type="button" onclick="addSizeSection(this)">Add Size</button>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="d-flex gap-2 mb-2 mt-2">
            <button class="rmvBTN" type="button" onclick="removeFlavorSizeRow(this)">Remove</button>
            <button class="addBTN" type="button" onclick="addFlavorSizeRow()">Add Flavor & Size</button>
        </div>
    `;

    flavorSizeContainer.appendChild(newFlavorSizeRow);
}

// Remove a flavor-size row
function removeFlavorSizeRow(button) {
    const flavorSizeRow = button.closest('.flavor-size-row');
    if (flavorSizeRow) {
        flavorSizeRow.remove();
    }
}

// Remove a size section
function removeSizeSection(button) {
    const sizeInput = button.closest('.size-input');
    if (sizeInput) {
        sizeInput.remove(); // Remove the specific size input section
    }
}


   </script>

</body>
</html> 

