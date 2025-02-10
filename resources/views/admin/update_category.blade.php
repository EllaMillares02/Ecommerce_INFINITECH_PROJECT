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
                <h1 class="app-page-title">Edit Category</h1>
                <form action="{{url('/update_category_confirm',$category->id)}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <input type="text" name="category" placeholder="Write Category Name" value="{{$category->category_name}}"><br><br>

                        <label>Current Image: </label>
                        <img style="margin: auto;" width="200" height="auto" src="/prod_category/{{$category->image}}">

                    <label>Change Image: </label>
                        <input type="file" name="image"><br><br>
                    <input type="submit" class="btn btn-primary text-white" name="submit" value="Edit Category">
                </form>
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

