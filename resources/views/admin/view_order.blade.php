<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
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
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Orders</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">
						All<span class="badge bg-danger rounded-circle" style="position: relative; top: -8px;">{{ $countOrders }}</span>
					</a>
					<a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">
						Pickup<span class="badge bg-danger rounded-circle" style="position: relative; top: -8px;">{{ $countPickup }}</span>
					</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-delivery-tab" data-bs-toggle="tab" href="#orders-delivery" role="tab" aria-controls="orders-delivery" aria-selected="false">
						Delivery<span class="badge bg-danger rounded-circle" style="position: relative; top: -8px;">{{ $countdelivery }}
					</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">
						Completed <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px;">{{ $countcompleted }}
					</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">
						Cancelled <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px;">{{ $cancelledcompleted }}
					</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Home Address</th>
												<th class="cell">Product</th>
                                                <th class="cell">Total</th>
												<th class="cell">Order Date</th>
												<th class="cell">Delivery Address</th>
                                                <th class="cell">Status</th>
												<th class="cell">Type</th>

												<th class="cell">Action</th>
												
											</tr>
										</thead>
										<tbody>
                                            @forelse ($orders as $order)

											<tr>
												<td class="cell">{{$order->name}}</td>
												<td class="cell">{{$order->email}}</td>
												<td class="cell">{{$order->phone}}</td>
                                                <td class="cell">{{$order->address}}</td>
                                                @php
													$productTitles = explode(', ', $order->product_title); 
													$quantities = explode(', ', $order->quantity); 
												@endphp
													<td class="cell">
														@for ($i = 0; $i < count($productTitles); $i++)
															<span style="display: inline-block; vertical-align: middle; margin-right: 15px;">
																{{ $productTitles[$i] }}<span style="margin: 0 10px;">x</span>{{ $quantities[$i] }} 
															</span>
														@endfor
													</td>
                                                <td class="cell">₱{{$order->price}}</td>
												<td class="cell"><span>{{ $order->created_at->format('m-d-Y') }}</span></td>
												<td class="cell">{{ $order->pickup_location }}</td>
                                                <td class="cell"><span class="badge bg-secondary">{{$order->delivery_status}}</span></td>
												<td class="cell">
													<span class="badge {{ $order->delivery_type == 'pickup' ? 'bg-success' : 'bg-warning' }}">
														For {{ ucfirst($order->delivery_type) }}
													</span>
												</td>

                                                <td class="cell">		
													<a class="btn bg-success text-white shadow-sm rounded" href="{{url('accepted',$order->id)}}" 
														onclick="acceptConfirmation(event)">Accept Order</a><br><br>
													<a id="cancelButton" class="btn bg-danger text-white shadow-sm rounded" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal"
                                                    data-order-id="{{ $order->id }}" onclick="openCancelModal(this)">Cancel Order</a>
												</td>
                                                
											</tr>
                                            
                                            @empty
													<tr>
														<td colspan="10" class="text-center">
															<i class="fa fa-box" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
															<p>No orders available at the moment.</p>
														</td>
													</tr>
												@endforelse

										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						
			        </div><!--//tab-pane-->
					
					<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
								    
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Home Address</th>
												<th class="cell">Product</th>
                                                <th class="cell">Total</th>
												<th class="cell">Order Date</th>
												<th class="cell">Pick-up Date</th>
												<th class="cell">Pickup Address</th>

												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>

											@forelse ($pickup as $pickup)

											<tr>
												<td class="cell">{{$pickup->name}}</td>
												<td class="cell"><span class="truncate">{{$pickup->email}}</span></td>
												<td class="cell">{{$pickup->phone}}</td>
                                                <td class="cell">{{$pickup->address}}</td>
                                                @php
													$productTitles = explode(', ', $pickup->product_title); 
													$quantities = explode(', ', $pickup->quantity); 
												@endphp
													<td class="cell">
														@for ($i = 0; $i < count($productTitles); $i++)
															<span style="display: inline-block; vertical-align: middle; margin-right: 15px;">
																{{ $productTitles[$i] }}<span style="margin: 0 10px;">x</span>{{ $quantities[$i] }} 
															</span>
														@endfor
													</td>
                                                <td class="cell">₱{{$pickup->price}}</td>
												<td class="cell"><span>{{ $pickup->created_at->format('m-d-Y') }}</span></td>
                                                <td class="cell">
													<span>{{ \Carbon\Carbon::parse($pickup->delivery_date)->format('m-d-Y') }}</span>
    												<span class="note">{{ \Carbon\Carbon::parse($pickup->delivery_date)->format('h:i:s A') }}</span>
												</td>
												<td class="cell">{{ $pickup->pickup_location }}</td>

                                                <td class="cell">		
													<a class="btn bg-success text-white shadow-sm rounded" href="{{url('toDeliver',$pickup->id)}}" 
														onclick="pickupConfirmation(event)">Pickup Order</a>
												</td>
                                                
											</tr>
                                            
                                            @empty
													<tr>
														<td colspan="10" class="text-center">
															<i class="fa fa-box" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
															<p>No for pickup orders available at the moment.</p>
														</td>
													</tr>
											@endforelse
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <div class="tab-pane fade" id="orders-delivery" role="tabpanel" aria-labelledby="orders-delivery-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
								    
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Home Address</th>
												<th class="cell">Product</th>
                                                <th class="cell">Total</th>
												<th class="cell">Order Date</th>
												<th class="cell">Delivery Address</th>
                                                <th class="cell">Action</th>

												<!--<th class="cell"></th>-->
											</tr>
										</thead>
										<tbody>

											@forelse ($delivery as $delivery)

											<tr>
												<td class="cell">{{$delivery->name}}</td>
												<td class="cell"><span class="truncate">{{$delivery->email}}</span></td>
												<td class="cell">{{$delivery->phone}}</td>
                                                <td class="cell">{{$delivery->address}}</td>
                                                @php
													$productTitles = explode(', ', $delivery->product_title); 
													$quantities = explode(', ', $delivery->quantity); 
												@endphp
													<td class="cell">
														@for ($i = 0; $i < count($productTitles); $i++)
															<span style="display: inline-block; vertical-align: middle; margin-right: 15px;">
																{{ $productTitles[$i] }}<span style="margin: 0 10px;">x</span>{{ $quantities[$i] }} 
															</span>
														@endfor
													</td>
                                                <td class="cell">₱{{$delivery->price}}</td>
												<td class="cell"><span>{{ $delivery->created_at->format('m-d-Y') }}</span></td>
                                        
												<td class="cell">{{ $delivery->pickup_location }}</td>
                                               <!-- <td class="cell"><span class="badge bg-warning">{{$delivery->delivery_status}}</span></td>-->

											   <td class="cell">
												<button class="btn-sm bg-success text-white shadow-sm rounded" 
													onclick="openProofModal(event, '{{ $delivery->id }}')">
													Delivered
												</button>
											</td>
											
											
											<!-- Modal for Proof of Delivery -->
											<div class="modal fade" id="proofOfDeliveryModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="proofModalLabel">Upload Proof of Delivery</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<form id="proofOfDeliveryForm" action="{{ url('toDeliver', $delivery->id) }}" method="POST" enctype="multipart/form-data">
																@csrf
																<input type="hidden" name="delivery_id" id="deliveryId"> 
																<div class="mb-3">
																	<label for="proofImage" class="form-label">Upload Proof:</label>
																	<input type="file" class="form-control" id="proofImage" name="image" required>
																</div>
																<button type="submit" class="btn btn-primary text-white" style="float: right;">Upload</button>
															</form>
														</div>
													</div>
												</div>
											</div>											
                                              
											</tr>
                                            @empty
													<tr>
														<td colspan="10" class="text-center">
															<i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
															<p>No deliveries available at the moment.</p>
														</td>
													</tr>
												@endforelse
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Address</th>
												<th class="cell">Product</th>
                                                <th class="cell">Total</th>
												<th class="cell">Order Date</th>
												<th class="cell">Delivery Date</th>
												<th class="cell">Meetup</th>
                                                <th class="cell">Status</th>
												<th class="cell">Proof of Delivery</th>
											</tr>
										</thead>
										<tbody>
											@forelse ($completed as $compOrders)

											<tr>
												<td class="cell">{{$compOrders->name}}</td>
												<td class="cell"><span class="truncate">{{$compOrders->email}}</span></td>
												<td class="cell">{{$compOrders->phone}}</td>
                                                <td class="cell">{{$compOrders->address}}</td>
                                                @php
													$productTitles = explode(', ', $compOrders->product_title); 
													$quantities = explode(', ', $compOrders->quantity); 
												@endphp
													<td class="cell">
														@for ($i = 0; $i < count($productTitles); $i++)
															<span style="display: inline-block; vertical-align: middle; margin-right: 15px;">
																{{ $productTitles[$i] }}<span style="margin: 0 10px;">x</span>{{ $quantities[$i] }} 
															</span>
														@endfor
													</td>
                                                <td class="cell">₱{{$compOrders->price}}</td>
												<td class="cell"><span>{{ $compOrders->created_at->format('m-d-Y') }}</span></td>
                                                <td class="cell">
													<span>{{ \Carbon\Carbon::parse($compOrders->delivery_date)->format('m-d-Y') }}</span>
    												<span class="note">{{ \Carbon\Carbon::parse($compOrders->delivery_date)->format('h:i:s A') }}</span>
												</td>
												<td class="cell">{{ $compOrders->pickup_location }}</td>
                                                <td class="cell"><span class="badge bg-success">{{$compOrders->delivery_status}}</span></td>
												<td class="cell">
													@if($compOrders->proof_of_delivery)
                                                    	<img src="{{ asset('proof_of_delivery/' . $compOrders->proof_of_delivery) }}" alt="Proof of Delivery">
													@else
														<p>No proof of delivery uploaded.</p>
													@endif
												</td>
                                                
											</tr>
                                            
                                            @empty
													<tr>
														<td colspan="10" class="text-center">
															<i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
															<p>No completed orders available at the moment.</p>
														</td>
													</tr>
											@endforelse
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Home Address</th>
												<th class="cell">Product</th>
                                                <th class="cell">Total</th>
												<th class="cell">Order Date</th>
												<th class="cell">Delivery Address</th>
                                                <th class="cell">Status</th>
												<th class="cell">Cancellation Reason</th>
											</tr>
										</thead>
										<tbody>
											
											<tr>
												@forelse ($cancelled as $cancelledOrders)

												<tr>
													<td class="cell">{{$cancelledOrders->name}}</td>
													<td class="cell"><span class="truncate">{{$cancelledOrders->email}}</span></td>
													<td class="cell">{{$cancelledOrders->phone}}</td>
													<td class="cell">{{$cancelledOrders->address}}</td>
													@php
														$productTitles = explode(', ', $cancelledOrders->product_title); 
														$quantities = explode(', ', $cancelledOrders->quantity); 
													@endphp
														<td class="cell">
															@for ($i = 0; $i < count($productTitles); $i++)
																<span style="display: inline-block; vertical-align: middle; margin-right: 15px;">
																	{{ $productTitles[$i] }}<span style="margin: 0 10px;">x</span>{{ $quantities[$i] }} 
																</span>
															@endfor
														</td>
													<td class="cell">₱{{$cancelledOrders->price}}</td>
													<td class="cell"><span>{{ $cancelledOrders->created_at->format('m-d-Y') }}</span></td>
													
													<td class="cell">{{ $cancelledOrders->pickup_location }}</td>
													<td class="cell"><span class="badge bg-danger">{{$cancelledOrders->delivery_status}}</span></td>
													<td class="cell"><span><b>{{$cancelledOrders->cancel_reason}}</b> , {{$cancelledOrders->other_reason}}</span></td>
													
												</tr>
												
												@empty
													<tr>
														<td colspan="10" class="text-center">
															<i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
															<p>No cancelled orders available at the moment.</p>
														</td>
													</tr>
											@endforelse
											</tr>
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
		<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="cancelModalLabel">Cancel Order</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				  <form id="cancelOrderForm" action="{{ route('view_order.cancel', 'placeholder') }}" method="POST">
		
					@csrf
					<!-- Reason to cancel -->
					<div class="mb-3">
					  <label for="cancelReason" class="form-label">Reason for Cancellation</label>
					  <select class="form-select" id="cancelReason" name="cancel_reason" required>
						<option value="">Select a reason</option>
						<option value="inventory_issues">Inventory Issues</option>
						<option value="payment_problems">Payment Problems</option>
						<option value="delivery_constraints">Delivery Constraints</option>
						<option value="customer_request">Customer Request</option>
						<option value="policy_violations">Policy Violations</option>
						<option value="suspicious_activity">Suspicious Activity</option>
						<option value="pricing_errors">Pricing or Technical Errors</option>
					  </select>
					</div>
					<!-- Other reason text input -->
					<div class="mb-3" id="otherReasonDiv"> <!-- d-none hides the element initially -->
						<label for="otherReason" class="form-label">State your Reason</label>
						<input type="text" class="form-control" id="otherReason" name="other_reason" placeholder="Please specify your reason" required>
					  </div>
				  </form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  <button type="submit" form="cancelOrderForm" class="btn btn-danger text-white">Submit</button>
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
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    
    
    <!-- Page Specific JS -->
    <script src="admin/assets/js/app.js"></script> 

	<script>
	function openCancelModal(buttonElement) {
		// Retrieve the order ID from the data attribute
		const orderId = buttonElement.getAttribute('data-order-id');
		
		// Log the order ID to the console (for testing)
		console.log('Order ID:', orderId);

		// Set the order ID in the form action
		const form = document.getElementById('cancelOrderForm');
		form.action = `/view_order/cancel/${orderId}`; 

		// Optionally, display the order ID in the modal
		document.getElementById('orderIdDisplay').innerText = `Order ID: ${orderId}`;

		// Show the modal
		const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
		modal.show();
}

function acceptConfirmation(event) {
          event.preventDefault(); // Prevent the default action (form submission or link navigation)
      
          // Use SweetAlert to confirm the deletion
          Swal.fire({
            title: 'Accepting of Orders',
            text: 'Are you sure you want to accept this order?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, accept it!',
            cancelButtonText: 'No, cancel',
          }).then((result) => {
            if (result.isConfirmed) {
              // If confirmed, proceed with the deletion (you can trigger the form submission or link navigation here)
              window.location.href = event.target.href; // Or use a form submission if it's a form
            }
          });
        }
		function pickupConfirmation(event) {
          event.preventDefault(); // Prevent the default action (form submission or link navigation)
      
          // Use SweetAlert to confirm the deletion
          Swal.fire({
            title: 'Pickup of Orders',
            text: 'Are you sure this order is now pick-up?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, accept it!',
            cancelButtonText: 'No, cancel',
          }).then((result) => {
            if (result.isConfirmed) {
              // If confirmed, proceed with the deletion (you can trigger the form submission or link navigation here)
              window.location.href = event.target.href; // Or use a form submission if it's a form
            }
          });
        }
		
		function openProofModal(event, deliveryId) {
			event.preventDefault();

			// Set the hidden field 'delivery_id' in the form with the selected delivery ID
			document.getElementById('deliveryId').value = deliveryId;

			// Show the modal directly
			var proofModal = new bootstrap.Modal(document.getElementById('proofOfDeliveryModal'));
			proofModal.show();  // This will trigger the modal to open
		}


    </script>

</body>
</html> 

