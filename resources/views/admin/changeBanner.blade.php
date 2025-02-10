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

            <h1 class="app-page-title text-center ">Manage Banner Images</h1>
                        <div class="row">
                            <div class="col-lg-12">
                                @if(session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: '{{ session('success') }}',
                                            showConfirmButton: true
                                        });
                                    </script>
                                @endif


                                <!-- Display current banner image -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Current Banner</h5>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3" style="margin: 40px;">
                                        @foreach($banners as $banner)
                                            <div class="border border-primary p-3 mb-3">
                                                <h5>Banner {{ $loop->iteration }}</h5>
                                                
                                                <!-- Current Banner Image -->
                                                <img id="bannerPreview{{ $banner->id }}" src="{{ asset('img/hero/' . $banner->image_path) }}" alt="Banner {{ $loop->iteration }}" class="img-fluid mb-2" width="200">
                                                
                                                <!-- Form for Updating Banner Image -->
                                                <form action="{{ route('admin.updateBanner', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <!-- File Input to Upload New Banner -->
                                                    <input type="file" name="banner_image" class="form-control-file mb-2" onchange="previewBannerImage(event, {{ $banner->id }})" required>
                                                    
                                                    <!-- Submit Button -->
                                                    <button type="submit" class="btn btn-primary btn-sm text-white">Update</button>
                                                </form>
                                            </div>
                                        @endforeach

                                    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script>
        function previewBannerImage(event, index) {
            var reader = new FileReader();
            reader.onload = function() {
                var image = document.getElementById('bannerPreview' + index);
                image.src = reader.result;  // Update the image source to the uploaded file
            };
            reader.readAsDataURL(event.target.files[0]);  // Read the file as a data URL
        }
    </script>
    
</body>
</html> 

