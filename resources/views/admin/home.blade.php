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

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
	    @include('admin.body')
	    
	    <footer class="app-footer">
		    <div class="container text-center py-3">
		       
		    </div>
	    </footer><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

    <script>
            const salesData = @json($salesData);
            const previousWeekData = @json($previousWeekData);
            const orderCounts = @json($orderCounts);
    </script>
    <!-- Javascript -->          
    <script src="admin/assets/plugins/popper.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="admin/assets/plugins/chart.js/chart.min.js"></script> 
    <script src="admin/assets/js/index-charts.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <!-- Page Specific JS -->
    <script src="admin/assets/js/app.js"></script> 
    
    
    
</body>
</html> 

