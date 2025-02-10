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
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        label{
            display: inline-block;
            width: 200px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .top{
            width: 50%;
            margin: auto;
        }
        .card-header{

            font-weight: bold;
        }
        .btnSubmit{
            margin-left: 25%;
            width: 50%;
        }
        .center{
            margin: auto;
            width: 100%;
            border: 1px solid grey;
            text-align: center;
            margin-top: 20px;
        }
        tr, th, td{
            border: 1px solid grey;
            padding: 10px;
        }
        .img_size{
            width: 250px;
            height: auto;
        }
        th{
            background-color: #edfdf6; 
            color: #51b37f;
        }
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">
            
            <div class="container-xl div_center">

                @if(session()->has('message'))

                <div class="alert alert-success">
    
                    {{session()->get('message')}}
    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    
                </div>
                    
                @endif
                
                @include('sweetalert::alert')
            
                @if (session('swal'))
                    <script>
                        Swal.fire({
                            title: "{{ session('swal')['title'] }}",
                            text: "{{ session('swal')['text'] }}",
                            icon: "{{ session('swal')['icon'] }}",
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif


                <h1 class="app-page-title text-center ">Add Sale Products</h1>

        <div class="card mb-4">
            <div class="card-header">Add Sale Products</div>
                <div class="card-body">

                <form action="{{ url('/add_sale') }}" method="POST">
                    @csrf
    
                <div class="row">
                    <div class="col-lg-6">
                        <label for="product">Select Product:</label>
                    <select id="product" name="product_id" class="form-control" required>
                        <option value="" selected="">Add a Product here</option>
                        @foreach($products as $product)
                            <option 
                                value="{{ $product->id }}" 
                                data-flavors="{{ json_encode($product->flavors) }}" 
                                data-sizes="{{ json_encode($product->sizes->pluck('size')) }}"
                                data-prices="{{ json_encode($product->sizes->pluck('price')) }}">       
                                {{ $product->title }}
                            </option>
                        @endforeach
                    </select>

                    <div id="options-container" style="display: none;">
                        <label for="flavor">Select Flavor:</label>
                        <select id="flavor" name="flavor" class="form-control" required>
                            <option value="" selected="">Select Flavor</option>
                        </select>

                        <label for="size">Select Size:</label>
                        <select id="size" name="size" class="form-control" required>
                            <option value="" selected="">Select Size</option>
                        </select>
                        <label for="price">Price:</label>
                        <input type="text" class="form-control mt-2" name="price" id="price" readonly>
                    </div>

                    </div>

                    <div class="col-lg-6">
                        <label for="discount_value">Discount Value:</label>
                        <input type="number" name="discount_value" class="form-control" placeholder="Enter discount value" required>
                    </div>
                    
                </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="start_date">Sale Start Date:</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="col-lg-6">
                    <label for="end_date">Sale End Date (Optional):</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
            </div>

            <input type="hidden" name="title" id="title" value="">

                <button type="submit" class="btn btn-primary text-white mt-4 btnSubmit">Save Sale Product</button>
                </form>
            </div>
             
        </div>

    <div class="card mb-4">
        <div class="card-header">On Sale Products</div>
            <div class="card-body">
    
                    <table class="center">
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    
                    @foreach ($sales as $sale)
                    
                        <tr>
                            <td>{{$sale->title}}</td>
                            <td>{{$sale->price}}</td>
                            <td>{{$sale->discount}}</td>
                            <td>{{$sale->start_date}}</td>
                            <td>{{$sale->end_date}}</td>
                            <td><a class="btn btn-success" href="{{url('update_sale',$sale->id)}}">
                                <i class="fa fa-pencil text-white"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="deleteConfirmation(event)" href="{{url('delete_sale',$sale->id)}}">
                                    <i class="fa fa-trash text-white"></i></a>
                            </td>
                        </tr>
    
                    @endforeach
                    </table> 
    
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
        function deleteConfirmation(event) {
          event.preventDefault(); // Prevent the default action (form submission or link navigation)
      
          // Use SweetAlert to confirm the deletion
          Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
          }).then((result) => {
            if (result.isConfirmed) {
              // If confirmed, proceed with the deletion (you can trigger the form submission or link navigation here)
              window.location.href = event.target.href; // Or use a form submission if it's a form
            }
          });
        }

        document.getElementById('product').addEventListener('change', function () {
    const selectedProduct = this.options[this.selectedIndex];
    console.log('Selected Product:', selectedProduct.text); // Debugging

    const flavors = JSON.parse(selectedProduct.getAttribute('data-flavors') || '[]');
    const sizes = JSON.parse(selectedProduct.getAttribute('data-sizes') || '[]');
    const prices = JSON.parse(selectedProduct.getAttribute('data-prices') || '[]');

    const flavorSelect = document.getElementById('flavor');
    const sizeSelect = document.getElementById('size');
    const priceInput = document.getElementById('price'); // Input field for price
    const optionsContainer = document.getElementById('options-container');

    // Reset the dropdowns and input fields
    flavorSelect.innerHTML = '<option value="" selected="">Select Flavor</option>';
    sizeSelect.innerHTML = '<option value="" selected="">Select Size</option>';
    priceInput.value = ''; // Clear price input

    if (selectedProduct.value) {
        // Populate flavors
        flavors.forEach(flavor => {
            console.log('Adding Flavor:', flavor.name); // Debugging
            const option = document.createElement('option');
            option.value = flavor.id;
            option.textContent = flavor.name;
            flavorSelect.appendChild(option);
        });

        // Populate sizes with corresponding prices
        sizes.forEach((size, index) => {
            console.log(`Adding Size: ${size} - Price: ${prices[index]}`); // Debugging
            const option = document.createElement('option');
            option.value = size;
            option.textContent = `${size}`;
            option.setAttribute('data-price', prices[index]); // Add price as an attribute
            sizeSelect.appendChild(option);
        });

        optionsContainer.style.display = 'block'; // Show the container
    } else {
        optionsContainer.style.display = 'none'; // Hide the container if no product is selected
    }

    updateTitle(); // Update the title immediately
});

document.getElementById('product').addEventListener('change', updateTitle);
document.getElementById('flavor').addEventListener('change', updateTitle);
document.getElementById('size').addEventListener('change', updateTitle);

function updateTitle() {
    const titleInput = document.getElementById('title'); // Hidden input for title
    const priceInput = document.getElementById('price'); // Hidden input for price

    const productSelect = document.getElementById('product');
    const flavorSelect = document.getElementById('flavor');
    const sizeSelect = document.getElementById('size');

    const selectedProduct = productSelect.options[productSelect.selectedIndex]?.text.trim() || '';
    const selectedFlavor = flavorSelect.options[flavorSelect.selectedIndex]?.text.trim() || '';
    const selectedSize = sizeSelect.options[sizeSelect.selectedIndex]?.text.trim() || '';
    const selectedPrice = sizeSelect.options[sizeSelect.selectedIndex]?.getAttribute('data-price') || '';

    // Update the hidden inputs
    titleInput.value = [selectedProduct, selectedFlavor, selectedSize].filter(Boolean).join(' ');
    priceInput.value = selectedPrice;

    console.log('Title Input:', titleInput.value); // Debugging
    console.log('Price Input:', priceInput.value); // Debugging
}

    </script>

</body>
</html> 

