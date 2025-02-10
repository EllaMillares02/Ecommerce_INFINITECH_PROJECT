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
        .center{
            margin: auto;
            width: 90%;
            border: 1px solid grey;
            text-align: center;
            margin-top: 20px;
        }
        .btn-primary {
            margin-top: 30px;
            width: 100%;
        }
        
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">

            @if(session()->has('message'))

            <div class="alert alert-success">

                {{session()->get('message')}}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
                
            @endif

            <h1 class="app-page-title text-center ">Manage Coupons</h1>

            <div class="card mb-4">
                <div class="card-header">Edit Coupon</div>
                <div class="card-body">
                    <form action="{{url('/update_coupon_confirm',$coupons->id)}}" method="POST">
                        @csrf

                        <div class="row">
                        <div class="col-lg-6">
                            <label for="code">Coupon Code</label>
                            <input type="text" name="code" class="form-control" value="{{$coupons->code}}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" name="discount_amount" class="form-control" step="0.01" value="{{$coupons->discount_amount}}" required>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                            <label for="valid_from">Valid From</label>
                            <input type="date" name="valid_from" class="form-control" value="{{$coupons->valid_from}}" required>
                            </div>
        
                            <div class="col-lg-6">
                            <label for="valid_until">Valid Until</label>
                            <input type="date" name="valid_until" class="form-control" value="{{$coupons->valid_until}}" required>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-lg-3">
                            <label for="is_active">Active</label>
                         
                            <select name="is_active" class="form-control" value="{{$coupons->is_active}}">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="{{$coupons->quantity}}">
                            </div>
                        
                            <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary text-white">Update Coupon</button>
                            </div>
                    </div>
                    </form>
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

</body>
</html> 

