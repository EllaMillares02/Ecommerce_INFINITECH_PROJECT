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
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">

    <style>

        .div_center{
            text-align: center;
            padding-top:  20px;
        }
        .center{
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 30px;
            border: 1px solid gray;
        }
        tr, th{
            border: 1px solid gray;
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

            <div class="div_center">
                <h1 class="app-page-title">Edit Account</h1>
                
                <form action="{{ url('/updateAdminAcc_confirm', $user->id) }}" method="POST">
                    @csrf
                    
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" 
                                value="{{ old('firstname', $user->admin->first_name ?? '') }}" required>
                        </div>
                
                        <div class="col-lg-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" 
                                value="{{ old('lastname', $user->admin->last_name ?? '') }}" required>
                        </div>
                
                        <input type="hidden" for="usertype" name="usertype" id="usertype" value="1">
                    </div>
                
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                
                        <div class="col-lg-6">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                    </div>
                
                    <div class="row mb-2">
                        <div class="col-lg-3">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" class="form-control" 
                                value="{{ old('street', $user->admin->street ?? '') }}" required>
                        </div>
                
                        <div class="col-lg-3">
                            <label for="barangay">Barangay</label>
                            <input type="text" id="barangay" name="barangay" class="form-control" 
                                value="{{ old('barangay', $user->admin->barangay ?? '') }}" required>
                        </div>
                
                        <div class="col-lg-3">
                            <label for="city_municipality">City/Municipality</label>
                            <input type="text" id="city_municipality" name="city_municipality" class="form-control" 
                                value="{{ old('city_municipality', $user->admin->city_municipality ?? '') }}" required>
                        </div>
                
                        <div class="col-lg-3">
                            <label for="province">Province</label>
                            <input type="text" id="province" name="province" class="form-control" 
                                value="{{ old('province', $user->admin->province ?? '') }}" required>
                        </div>
                    </div>
                
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                
                        <div class="col-lg-6">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                
                    <div class="col-lg-12 mt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary text-white" style="width: 50%;">Update Account</button>
                    </div>
                </form>
                
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

</body>
</html> 

