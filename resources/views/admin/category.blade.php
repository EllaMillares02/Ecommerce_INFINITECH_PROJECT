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

        .img_size{
            width: 50px;
            height: auto;
        }

        label{
            margin-bottom: 10px;
        }
        .addbtn{
            width: 100%;
            margin-top: 30px
        }
        .card-header{
            font-weight: bold;
        }
        th, td{
            text-align: center;
        }
    </style>

</head> 

<body class="app">   	


    @include('admin.header')

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            
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


           
                <h1 class="app-page-title text-center">Add Category</h1>

                <div class="card mb-4">
                    <div class="card-header">Add New Category</div>
                    <div class="card-body">
                <form action="{{url('/add_category')}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Category Name: </label>
                            <input type="text" name="category" placeholder="Write Category Name">
                        </div>

                        <div class="col-lg-4">
                            <label>Image: </label>
                            <input type="file" name="image"  required="">
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" class="btn btn-primary text-white addbtn" name="submit" value="Add Category">
                        </div>
                        </div>
                        </form>
            </div>
                </div>

    <div class="card">
        <div class="card-header">All Category</div>
        <div class="card-body" style="overflow-y: auto; max-height: 500px;">
            <table class="table table-bordered" >
           
                <tr>
                    <td>Category Name</td>
                    <td>Image</td>
                    <td>Action</td>
                </tr>

                @foreach ($data as $data)

                <tr>
                    <td>{{$data->category_name}}</td>
                    <td>
                        <img class="img_size" src="/prod_category/{{$data->image}}">
                    </td>
                    <td><a class="btn btn-warning btn-sm" href="{{url('update_category',$data->id)}}">
                        Edit</a>

                     <a onclick="deleteConfirmation(event)" class="btn btn-danger btn-sm" 
                        href="{{url('delete_category',$data->id)}}">Delete</a>
                        
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

    </script>

</body>
</html> 

