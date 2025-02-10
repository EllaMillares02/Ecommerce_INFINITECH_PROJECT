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
        .center{
            margin: auto;
            margin-top: 20px;
        }
        
        .img_size{
            width: 100px;
            height: auto;
        }
        .card-header{
            background-color: #edfdf6; 
            color: #51b37f; 
            font-weight: bold;
        }
                h1 {
            text-align: center;
            color: #333;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 50px;
            font-size: 0.7rem;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #51b37f;
            color: white;
        }

        tr {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #e2e2e2;
        }
        .custom-modal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Modal Content */
    .custom-modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 5px;
    }

    /* Close Button */
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-link{
        font-size: 0.6rem;
        color: #000;
        text-decoration-line: none;
        padding: 10px;
        margin: auto;

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


        <h1 class="app-page-title text-center ">All Products</h1>

                <a href="{{ route('outOfStock_product') }}" class="btn btn-link bg-warning text-white mb-2" style="float: right">
                Out of Stock Products
                <span class="badge bg-danger rounded-circle" style="position: relative; top: -10px; left: -5px;">{{ $outOfStockCount }}</span>
                </a>
                    <div class="container-xl" style="overflow-y: auto; ">

                        <table class="center">
                            <tr>
                                <th>ID</th>
                                <th>Available</th>
                                <th>Product Title</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Sizes</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Product Image</th>
                                <th>Product Group</th>
                                <th>Description</th>
                                <th>Information</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            @php
                                use Carbon\Carbon;
                            @endphp

                            @foreach ($product as $product)
                                @foreach ($product->flavors as $flavor)
                                    <tr>
                                        <td>
                                            {{ $product->id }}
                                        </td>
                                        <td>
                                            @if ($product->status == "yes")
                                                <p style="color: #51b37f; text-align:center;">Available</p>
                                            @else
                                                <p class="no" style="color: red; text-align:center;">Not Available</p>
                                            @endif
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $flavor->name }}</td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                @if ($size->flavor_id == $flavor->id)
                                                        {{ $size->size }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                @if ($size->flavor_id == $flavor->id)
                                                        {{ $size->price }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->sizes as $size)
                                                @if ($size->flavor_id == $flavor->id)
                                                        {{ $size->stock_quantity }} <br>
                                                @endif
                                            @endforeach
                                        </td>

                                        <td>
                                            <img class="img_size" src="{{ asset('product/' . $product->image) }}">
                                            @foreach ($product->images as $image)
                                                <img class="img_size" src="{{ asset('product/' . $image->path) }}" alt="Product Image">
                                            @endforeach
                                        </td>
                                
                                        <td>{{ $product->product_group }}</td>
                                        <td>
                                            <button class="btn btn-link bg-warning" onclick="openCustomModal(`{!! addslashes($product->description) !!}`)">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-link bg-warning" onclick="openCustomModal(`{!! addslashes($product->information) !!}`)">
                                                View
                                            </button>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ url('update_product', $product->id) }}">
                                                <i class="fa fa-pencil text-white"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="deleteConfirmation(event)" href="{{ route('delete_product', $product->id) }}">
                                                <i class="fa fa-trash text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>

                    </div>
             </div>
        </div>
  

    <div id="customModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-btn">&times;</span>
            <div id="customModalBody">
                <!-- Content will be injected here -->
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
        // Function to open the custom modal and set its content
        function openCustomModal(content) {
            var modal = document.getElementById("customModal");
            var modalBody = document.getElementById("customModalBody");
    
            modalBody.innerHTML = content; // Set content in modal body
            modal.style.display = "block"; // Show the modal
        }
    
        // Close the modal when clicking on the close button
        document.querySelector(".close-btn").onclick = function() {
            document.getElementById("customModal").style.display = "none";
        };
    
        // Close the modal when clicking outside of the modal content
        window.onclick = function(event) {
            var modal = document.getElementById("customModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

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

    </script>
</body>
</html> 

