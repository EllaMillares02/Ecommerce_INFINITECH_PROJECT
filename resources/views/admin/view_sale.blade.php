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

    <style>
        .center{
            margin: auto;
            width: 90%;
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
            background-color: rgb(129, 199, 129);
            color: white
        }
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl" style="overflow-y: auto; max-height: 500px;">

                @if(session()->has('message'))

                <div class="alert alert-success">
    
                    {{session()->get('message')}}
    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    
                </div>
                    
                @endif

                <h1 class="app-page-title text-center ">On Sale Products</h1>

                <table class="center">
                    <tr>
                        <th>Product_Name</th>
                        <th>Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                
                @foreach ($sales as $sale)
                
                    <tr>
                        <td>{{$sale->product->title}}</td>
                        <td>{{$sale->discount}}</td>
                        <td>{{$sale->start_date}}</td>
                        <td>{{$sale->end_date}}</td>
                        <td><a class="btn btn-success" href="{{url('update_sale',$sale->id)}}">
                            <i class="fa fa-pencil text-white"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')" href="{{url('delete_sale',$sale->id)}}">
                                <i class="fa fa-trash text-white"></i></a>
                        </td>
                    </tr>

                @endforeach
                </table>

               

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

