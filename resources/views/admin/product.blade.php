<!DOCTYPE html>
<html lang="en"> 
<head>
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
            font-weight: bold;
        }
        label{
            display: inline-block;
            width: 200px;
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
        .rmvBTN{
            background-color: crimson; 
            margin-left: 25%;
            color: white;
            width: 20%;
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

             <h1 class="app-page-title text-center">Add Product</h1>

             <div class="card mb-4">
                <div class="card-header">Add Product</div>
                    <div class="card-body">

                        <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Product Title: </label>
                                    <input type="text" name="title" placeholder="Write a title" required="">
                                </div>
                                <div class="col-lg-6">
                                    <label>Product Brand: </label>
                                    <input type="text" name="brand" placeholder="Write a brand" required="">
                                </div>
                            </div>

                            <div id="flavor-size-container">
                                <div class="flavor-size-row">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Colors:</label>
                                            <div class="flavor-section">
                                                <div class="flavor-input">
                                                    <input type="text" name="flavors[]" class="mb-2" placeholder="Enter color">
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="col-lg-6">
                                            <label>Sizes, Prices & Quantities:</label>
                                            <div class="size-section">
                                                <div class="size-input">
                                                    <!-- This will be the dynamic section for sizes, prices, and quantities -->
                                                    <div class="d-flex gap-2 mb-2">
                                                        <input type="text" name="sizes[0][]" placeholder="Enter size">
                                                        <input type="number" name="size_prices[0][]" placeholder="Enter price" step="0.01">
                                                        <input type="number" name="size_quantities[0][]" placeholder="Enter quantity" min="0">
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 mb-2">
                                                    <button style="margin-left: 40%" class="addBTN" type="button" onclick="addSizeSection(this)">Add Size</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <!-- Add another row of Flavor and Sizes -->
                                    <hr>
                                    <div class="d-flex gap-2 mb-2 mt-2">
                                        <button style="margin-left: 40%" class="addBTN" type="button" onclick="addFlavorSizeRow()">Add Color & Size</button>
                                    </div>
                                </div>
                            </div>
 
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Product Description: </label>
                                <!--    <input type="text" name="description" placeholder="Write a description"  required=""> -->
                                    <textarea name="description" rows="12" cols="50" placeholder="Write a description here..." ></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label>Product Information: </label>
                                    <textarea name="information" rows="12" cols="50" placeholder="Write a Information here..." ></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Product Minimum Price: </label>
                                    <input type="number" name="price" placeholder="Write a product minimum price"  required="">
                                </div>
                                <div class="col-lg-6">
                                    <label>Discount Price: </label>
                                    <input type="number" name="discount" placeholder="Write a discount, if applicable">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Product Category: </label>
                                    <select name="category"  required="">
                                        <option value="" selected="">Add a category here</option>

                                        @foreach ($category as $category)

                                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                            
                                        @endforeach
                                    
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label for="grouping">Product Grouping:</label>
                                    <select name="grouping" id="grouping">
                                        <option value="">Select</option>
                                        <option value="latest">Latest Product</option>
                                        <option value="top_rated">Top Rated</option>
                                        <option value="review_product">Review Product</option>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Available:</label>
                                        <select name="status"  required="">
                                            <option value="" selected="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Primary Product Image: </label>
                                    <input type="file" name="image">
                                </div>
                                <div class="col-lg-3">
                                    <label>Other Image: </label>
                                    <input type="file" name="images[]" multiple>
                                </div>
                            </div>

                            <div class="div_design">
                                <input type="submit" class="btn btn-primary text-white" value="Add Product">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            </div>
        </div>
	    
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

    // Function to add a size section under a specific flavor
function addSizeSection(button) {
    const flavorSizeRow = button.closest('.flavor-size-row'); // Get the closest flavor-size row
    const sizeSection = flavorSizeRow.querySelector('.size-section'); // Get the size section for that flavor

    // Get the current flavor's index by finding its order in the parent container
    const flavorIndex = Array.from(flavorSizeRow.parentNode.children).indexOf(flavorSizeRow);

    const newSizeSection = document.createElement('div');
    newSizeSection.classList.add('size-input');

    // Dynamically set the name attributes for sizes, prices, and quantities
    newSizeSection.innerHTML = `
        <div class="d-flex gap-2 mb-2">
            <input type="text" name="sizes[${flavorIndex}][]" placeholder="Enter size">
            <input type="number" name="size_prices[${flavorIndex}][]" placeholder="Enter price" step="0.01">
            <input type="number" name="size_quantities[${flavorIndex}][]" placeholder="Enter quantity" min="0">
        </div>
        <div class="d-flex gap-2 mb-2">
            <button style="margin-left: 40%" class="rmvBTN" type="button" onclick="removeSizeSection(this)">Remove</button>
        </div>
    `;

    sizeSection.insertBefore(newSizeSection, button.closest('.d-flex')); // Insert the new size section before the "Add" button
}

// Function to remove a size section
function removeSizeSection(button) {
    const sizeInput = button.closest('.size-input');
    if (sizeInput) {
        sizeInput.remove(); // Remove the size section
    }
}

// Function to add a new flavor-size row (with flavor and its sizes)
function addFlavorSizeRow() {
    const flavorSizeContainer = document.getElementById('flavor-size-container');
    const newFlavorSizeRow = document.createElement('div');
    newFlavorSizeRow.classList.add('flavor-size-row');

    // Dynamically set the name attributes for flavors and sizes
    newFlavorSizeRow.innerHTML = `
        <div class="row">
            <div class="col-lg-6">
                <label>Flavors:</label>
                <div class="flavor-section">
                    <div class="flavor-input">
                        <input type="text" name="flavors[]" class="mb-2" placeholder="Enter flavor">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label>Sizes & Prices:</label>
                <div class="size-section">
                    <div class="size-input">
                        <div class="d-flex gap-2 mb-2">
                            <input type="text" name="sizes[${flavorSizeContainer.children.length}][]" placeholder="Enter size">
                            <input type="number" name="size_prices[${flavorSizeContainer.children.length}][]" placeholder="Enter price" step="0.01">
                            <input type="number" name="size_quantities[${flavorSizeContainer.children.length}][]" placeholder="Enter quantity" min="0">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <button style="margin-left: 40%" class="addBTN" type="button" onclick="addSizeSection(this)">Add Size</button>
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

    flavorSizeContainer.appendChild(newFlavorSizeRow); // Append the new row
}

// Function to remove a flavor-size row
function removeFlavorSizeRow(button) {
    const flavorSizeRow = button.closest('.flavor-size-row');
    if (flavorSizeRow) {
        flavorSizeRow.remove(); // Remove the flavor-size row
    }

    // Update the indices of subsequent flavor-size rows
    const flavorSizeContainer = document.getElementById('flavor-size-container');
    Array.from(flavorSizeContainer.children).forEach((row, index) => {
        // Update input names for sizes, prices, and quantities
        row.querySelectorAll('[name^="sizes["]').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
        });
        row.querySelectorAll('[name^="size_prices["]').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
        });
        row.querySelectorAll('[name^="size_quantities["]').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
        });
    });
}

</script>
    

</body>
</html> 

