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
        .card-header{
            background-color: #edfdf6; 
            color: #51b37f; 
            font-weight: bold;
        }
                h1 {
            text-align: center;
            color: #333;
        }

        table {
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e2e2;
        }
        
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">

            <h1 class="app-page-title text-center ">Add Admin/Staff</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Add New Admin</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                
                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <label for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control" required>
                            </div>
        
                            <div class="col-lg-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-lg-2">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" required>
                            </div>

                            <input type="hidden" for="usertype" name="usertype" id="usertype" value="1">

                        </div>
                        <div class="row mb-2">
                            
                            <div class="col-lg-3">
                                <label for="street">Street</label>
                                <input type="text" id="street" name="street" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="barangay">Barangay</label>
                                <input type="text" id="barangay" name="barangay" class="form-control" required>
                            </div>

                            
                            <div class="col-lg-2">
                                <label for="city_municipality">City/Municipality</label>
                                <input type="text" id="city_municipality" name="city_municipality" class="form-control" required>
                            </div>
                            <div class="col-lg-2">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" class="form-control" required>
                            </div>
                            <div class="col-lg-2">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control" required>
                            </div>
                            
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                    
                            <div class="col-lg-6">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary text-white"  style="width: 50%;">Add Admin</button>
                        </div>                        
                    </form>
                </div>

            </div>

            <div class="card">
                <div class="card-header">All Admin/Staff Users</div>
                <div class="card-body" style="overflow-y: auto; max-height: 500px;">
                    <table class="table table-bordered" >
                   
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>UserType</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td></td>
                        </tr>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->usertype == 1 ? 'Admin/Staff' : 'DeliveryMan' }}</td>
                            <td>{{ $user->phone}}</td>
                            <td>{{ optional($user->admin)->full_address }}</td>
                            <td>
                            <a class="btn btn-warning btn-sm" href="{{url('updateAdminAcc',$user->id)}}">
                                Edit</a>
        
                             <a onclick="deleteConfirmation(event)" class="btn btn-danger btn-sm" 
                             href="{{url('delete_user',$user->id)}}">Delete</a>
                            </td>
                        
                        </tr>
                       @endforeach
        
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
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

