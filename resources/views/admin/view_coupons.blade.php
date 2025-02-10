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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- FontAwesome JS-->
    <script defer src="admin/assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">

    <style>
        .center{
            margin: auto;
            width: 90%;
            border: 1px solid grey;
            text-align: center;
            margin-top: 20px;
        }
        .addbtn {
            margin-top: 25px;
            width: 100%;
        }
        .card-header{
            
            font-weight: bold;
        }
        
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">

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

            <h1 class="app-page-title text-center ">Manage Coupons</h1>

            <div class="card mb-4">
                <div class="card-header">Add New Coupon</div>
                <div class="card-body">
                    <form action="{{ url('/add_coupon') }}" method="POST">
                        @csrf

                        <div class="row">
                        <div class="col-lg-6">
                            <label for="code">Coupon Code</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" name="discount_amount" class="form-control" step="0.01" required>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                            <label for="valid_from">Valid From</label>
                            <input type="date" name="valid_from" class="form-control" required>
                            </div>
        
                            <div class="col-lg-6">
                            <label for="valid_until">Valid Until</label>
                            <input type="date" name="valid_until" class="form-control" required>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-lg-3">
                            <label for="is_active">Active</label>
                         
                            <select name="is_active" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            </div>

                            <div class="col-lg-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                        
                            <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary text-white addbtn">Add Coupon</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        
            <!-- Table Showing All Coupons -->
            <div class="card">
                <div class="card-header">All Coupons</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Discount Amount</th>
                                <th>Valid From</th>
                                <th>Valid Until</th>
                                <th>Status</th>
                                <th>Qty</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>₱{{$coupon->discount_amount ?: 'N/A' }}</td>
                                        <td>{{ $coupon->valid_from }}</td>
                                        <td>{{ $coupon->valid_until }}</td>
                                        <td>{{ $coupon->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $coupon->quantity}}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ url('/update_coupon', $coupon->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a class="btn btn-danger btn-sm" onclick="deleteConfirmation(event)" href="{{url('delete_coupon',$coupon->id)}}">
                                                Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
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

    </script>

</body>
</html> 

