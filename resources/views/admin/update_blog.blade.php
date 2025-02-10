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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- FontAwesome JS-->
    <script defer src="admin/assets/plugins/fontawesome/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">
    

    <style>
        .addbtn{
            font-weight: bold;
            width: 200px;
            margin-left: 40%;
        }
    </style>
</head> 

<body class="app">   	

    @include('admin.header')

    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif
            
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

            <h1 class="app-page-title text-center ">Post a Blog</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update a Blog</h5>
                </div>
                <div class="card-body">
                    <form action="{{url('/update_blog_confirm',$blog->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Write a Title here..." 
                                   value="{{ $blog->title }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label>SubTitle</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Write a Subtitle here..." 
                                   value="{{ $blog->subtitle }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" rows="15" cols="121" placeholder="Write content here...">{{ $blog->content }}</textarea>
                        </div>
                    
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($blog->image)
                                <br>
                                <img src="{{ asset($blog->image) }}" alt="Blog Image" width="150">
                            @endif
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date:</label>
                                    <input type="date" name="date" class="form-control" value="{{ $blog->date }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Active:</label>
                                    <select name="status" class="form-control" required>
                                        <option value="yes" {{ $blog->status == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $blog->status == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>                        
                    
                        <button type="submit" class="btn btn-success text-white addbtn">Update Blog</button>
                    </form>
                </div>
            </div>
		    
	    </div><!--//app-content-->
    
	    
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
        document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
        selector: 'textarea[name="content"]', 
        plugins: 'lists link image preview',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
        menubar: false,
        branding: false
        });
    });
    </script>

</body>
</html> 

