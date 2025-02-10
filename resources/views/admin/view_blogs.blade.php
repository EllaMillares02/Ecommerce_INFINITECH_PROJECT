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

		    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">My Blogs</h1>
				    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                           <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                               <div class="col-auto">
                                   <a class="btn app-btn-primary" href="{{url('/add_blogs')}}">Add a Blog</a>
                               </div>
                           </div><!--//row-->
                       </div><!--//table-utilities-->
                   </div><!--//col-auto-->
				    
			    </div><!--//row-->
			    
			    <div class="row g-4">
				    @foreach($blogs as $blog)
						<div class="col-6 col-md-4 col-xl-3 col-xxl-2">
							<div class="app-card app-card-doc shadow-sm h-100">
								<div class="app-card-thumb-holder p-3">
									<div class="app-card-thumb">
										<img class="thumb-image" src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
									</div>
									<a class="app-card-link-mask" href="#"></a>
								</div>
								<div class="app-card-body p-3 has-card-actions">
									<h4 class="app-doc-title truncate mb-0">
										<a href="#">{{ $blog->title }}</a>
									</h4>
									<p class="text-muted">{{ $blog->subtitle }}</p>
									<div class="app-doc-meta">
										<ul class="list-unstyled mb-0">
											<li><span class="text-muted">Date:</span> {{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}</li>
											<li><span class="text-muted">Posted:</span> {{ ucfirst($blog->status) }}</li>
										</ul>
									</div>
									<div class="app-card-actions">
										<div class="dropdown">
											<div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
												</svg>
											</div>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="{{ route('update_blog', $blog->id) }}">View / Edit</a></li>
												<li><hr class="dropdown-divider"></li>
												<li>
													<a onclick="deleteConfirmation(event)"
                        								href="{{url('delete_blog',$blog->id)}}"><button class="dropdown-item text-danger">Delete</button></a>
												</li>
											</ul>
										</div><!--//dropdown-->
									</div><!--//app-card-actions-->
								</div><!--//app-card-body-->
							</div><!--//app-card-->
						</div><!--//col-->
					@endforeach

		    </div><!--//container-fluid-->
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
        function deleteConfirmation(event) {
          event.preventDefault(); 
      
          // Use SweetAlert to confirm the deletion
          Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this blog!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = event.target.href; 
            }
          });
        }

    </script>

</body>
</html> 

