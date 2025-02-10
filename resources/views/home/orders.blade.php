<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="/public">
    <link rel="shortcut icon" href="home/favicon.ico"> 
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Craftee | Ecommerce</title>


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <!-- Css Styles -->
   
    <link rel="stylesheet" href="home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">
</head>

<body>
 
    @include('home.header')

    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                    <li><a href="{{ route('category.products', $category->category_name) }}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form"> 
                            <form action="{{ route('search_page') }}" method="GET">
                                <input type="text" name="query" placeholder="What do you need?" required>
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+63 907 802 4442</h5>
                                <span>available 8:00am-5:00pm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Orders</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('sweetalert::alert')
    <!-- Breadcrumb Section End -->
    @if (session('swal'))
    <script>
        Swal.fire({
            title: "{{ session('swal.title') }}",
            text: "{{ session('swal.text') }}",
            icon: "{{ session('swal.icon') }}"
        });
    </script>
@endif


    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">
                    For Pickup
                    <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px; left: -5px;">{{ $pickupOrdersCount }}</span>
                </a>
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">
                    To Receive
                    <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px; left: -5px;">{{ $deliveryOrdersCount }}</span>
                </a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">
                    Completed
                    <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px; left: -5px;">{{ $completeOrdersCount }}</span>
                </a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">
                    Cancelled
                    <span class="badge bg-danger rounded-circle" style="position: relative; top: -8px; left: -5px;">{{ $cancelOrdersCount }}</span>
                </a>
            </nav>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Products Ordered</th>
                                        <th class="cell">Total</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Order Date</th>
                                        <th class="cell">Pickup Date</th>
                                        <th class="cell">Meetup Location</th>
                                        <th class="cell"></th>
                                        <th class="cell">Remaining Time for Pickup</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @forelse ($orderItemspickup as $orders)
                                    @php
                                        // Split the strings into arrays
                                        $productTitles = explode(', ', $orders->product_title);       // Array of product titles
                                        $quantities = explode(', ', $orders->quantity);       // Array of quantities
                                        $images = explode(', ', $orders->image);               // Array of product images
                        
                                        // Concatenate titles and quantities for display
                                        $productsDisplay = [];
                                        for ($i = 0; $i < count($productTitles); $i++) {
                                            $productsDisplay[] = '<img class="img_design" src="' . $images[$i] . '" alt="" style="width: 30px; margin-right: 5px;"> ' . $productTitles[$i] . ' x ' . $quantities[$i];
                                        }
                                        $productsList = implode(', ', $productsDisplay);
                                    @endphp
                        
                                    <tr>
                                        <td class="cell">{!! $productsList !!}</td>
                                        <td class="cell">₱{{ $orders->price }}</td>
                                        <td class="cell"><span class="badge bg-success">{{ $orders->delivery_status }}</span></td>
                                        <td class="cell"><span>{{ $orders->created_at->format('m-d-Y') }}</span></span></td>
                                        <td class="cell">
                                            <span>{{ \Carbon\Carbon::parse($orders->delivery_date)->format('m-d-Y') }}</span>
                                            <span class="note">{{ \Carbon\Carbon::parse($orders->delivery_date)->format('h:i:s A') }}</span>
                                        </td>
                                        <td class="cell" style="width: 300px;"><span>{{ $orders->pickup_location }}</span></td>
                                        <td class="cell">
                                            <a 
                                                class="btn-sm app-btn-secondary view-order-btn" 
                                                href="#" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#orderDetailsModal"
                                                data-products="{{ $productsList }}"
                                                data-price="₱{{ $orders->price }}"
                                                data-status="{{ $orders->delivery_status }}"
                                                data-order-date="{{ $orders->created_at->format('m-d-Y h:i:s A') }}"
                                                data-delivery-date="{{ \Carbon\Carbon::parse($orders->delivery_date)->format('m-d-Y h:i:s A') }}"
                                                data-pickup="{{ $orders->pickup_location }}">
                                                View
                                            </a>
                                        </td>
                                        <td class="cell" style="color: red;">
                                                <span id="countdown"></span><br>

                                                <a id="cancelButton" class="btn-sm btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal"
                                                    data-order-id="{{ $orders->id }}" data-order-time="{{ $orders->created_at }}"
                                                    onclick="openCancelModal(event, this)"
                                                    >Cancel Order</a>

                                                <span class="tooltip-text">Cancellation is only available within 24 hours of ordering.</span>
                                        </td>                                        
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
                                                <p>No For Pickup Orders.</p>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div><!--//table-responsive-->
                       
                    </div><!--//app-card-body-->		
                </div><!--//app-card-->
                
            </div><!--//tab-pane-->
            
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Products Ordered</th>
                                            <th class="cell">Total</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Order Date</th>
                                            <th class="cell">Estimated <br> Delivery Date</th>
                                            <th class="cell">Delivery Address</th>
                                            <th class="cell"></th>
                                            <th class="cell">To Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @forelse ($orderItems as $orders)
                                        @php
                                            // Split the strings into arrays
                                            $productTitles = explode(', ', $orders->product_title);       // Array of product titles
                                            $quantities = explode(', ', $orders->quantity);       // Array of quantities
                                            $images = explode(', ', $orders->image);               // Array of product images
                            
                                            // Concatenate titles and quantities for display
                                            $productsDisplay = [];
                                            for ($i = 0; $i < count($productTitles); $i++) {
                                                $productsDisplay[] = '<img class="img_design" src="' . $images[$i] . '" alt="" style="width: 30px; margin-right: 5px;"> ' . $productTitles[$i] . ' x ' . $quantities[$i];
                                            }
                                            $productsList = implode(', ', $productsDisplay);
                                        @endphp
                            
                                        <tr>
                                            <td class="cell">{!! $productsList !!}</td>
                                            <td class="cell">₱{{ $orders->price }}</td>
                                            <td class="cell"><span class="badge bg-success">{{ $orders->delivery_status }}</span></td>
                                            <td class="cell" class="note"><span>{{ $orders->created_at->format('F d, Y') }}</span></td>
                                            <td class="cell">    
                                                <span class="note">{{ $minDate }} to <br> {{ $maxDate }}</span>
                                            </td>
                                            <td class="cell" style="width: 250px;"><span>{{ $orders->pickup_location }}</span></td>
                                            <td class="cell">
                                                <a 
                                                    class="btn-sm app-btn-secondary view-order-btn" 
                                                    href="#" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#orderDetailsModal"
                                                    data-products="{{ $productsList }}"
                                                    data-price="₱{{ $orders->price }}"
                                                    data-status="{{ $orders->delivery_status }}"
                                                    data-order-date="{{ $orders->created_at->format('m-d-Y h:i:s A') }}"
                                                    data-delivery-date="{{ \Carbon\Carbon::parse($orders->delivery_date)->format('m-d-Y h:i:s A') }}"
                                                    data-pickup="{{ $orders->pickup_location }}">
                                                    View
                                                </a>
                                            </td>
                                            
                                            <td class="cell">
                                                <a id="cancelButton" class="btn-sm btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal"
                                                    data-order-id="{{ $orders->id }}" data-order-time="{{ $orders->created_at }}"
                                                    onclick="openCancelModal(event, this)"
                                                    >Cancel Order</a>

                                                <span class="tooltip-text">Cancellation is only available within 24 hours of ordering.</span>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
                                                <p>No order to deliver at the moment.</p>
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
                                            <th class="cell">Products Ordered</th>
                                            <th class="cell">Total</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Order Date</th>
                                            <th class="cell">Estimated Delivery Date</th>
                                            <th class="cell">Delivery Address</th>
                                            <th class="cell">Proof of Delivery</th>
                                            <th class="cell"></th>
                                            <th class="cell">Order</th>
                                            <th class="cell">Rate Now</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orderComplete as $orders)
                                        @php
                                            // Split the strings into arrays
                                            $productTitles = explode(', ', $orders->product_title);       // Array of product titles
                                            $quantities = explode(', ', $orders->quantity);       // Array of quantities
                                            $images = explode(', ', $orders->image);               // Array of product images
                            
                                            // Concatenate titles and quantities for display
                                            $productsDisplay = [];
                                            for ($i = 0; $i < count($productTitles); $i++) {
                                                $productsDisplay[] = '<img class="img_design" src="' . $images[$i] . '" alt="" style="width: 30px; margin-right: 5px;"> ' . $productTitles[$i] . ' x ' . $quantities[$i];
                                            }
                                            $productsList = implode(', ', $productsDisplay);
                                        @endphp
                            
                                        <tr>
                                            <td class="cell">{!! $productsList !!}</td>
                                            <td class="cell">₱{{ $orders->price }}</td>
                                            <td class="cell"><span class="badge bg-success">{{ $orders->delivery_status }}</span></td>
                                            <td class="cell"><span>{{ $orders->created_at->format('m-d-Y') }}</span></td>
                                            <td class="cell">
                                                <span>{{ \Carbon\Carbon::parse($orders->delivery_date)->format('m-d-Y') }}</span>
                                                <span class="note">{{ \Carbon\Carbon::parse($orders->delivery_date)->format('h:i:s A') }}</span>
                                            </td>
                                            <td class="cell" style="width: 300px;"><span>{{ $orders->pickup_location }}</span></td>
                                            <td class="cell">
                                                @if($orders->proof_of_delivery)
                                                    <img src="{{ asset('proof_of_delivery/' . $orders->proof_of_delivery) }}" alt="Proof of Delivery" style="width: 50%;">
                                                @else
                                                    <small>No proof of delivery uploaded.</small>
                                                @endif

                                            </td>
                                            <td class="cell">
                                                <a 
                                                    class="btn-sm app-btn-secondary view-order-btn" 
                                                    href="#" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#orderDetailsModal"
                                                    data-products="{{ $productsList }}"
                                                    data-price="₱{{ $orders->price }}"
                                                    data-status="{{ $orders->delivery_status }}"
                                                    data-order-date="{{ $orders->created_at->format('m-d-Y h:i:s A') }}"
                                                    data-delivery-date="{{ \Carbon\Carbon::parse($orders->delivery_date)->format('m-d-Y h:i:s A') }}"
                                                    data-pickup="{{ $orders->pickup_location }}">
                                                    View
                                                </a>
                                            </td>
                                            <td class="cell">
                                                @if($orders->delivery_status === 'received')
                                                    <span class="received-text text-success px-2 py-1">Received</span><br>
                                                    <a class="btn-sm app-btn-secondary" href="{{url('e_receipt',$orders->id)}}">E-Receipt</a>
                                                @else
                                                    <a class="btn-sm app-btn-secondary" href="{{ route('order.received', ['id' => $orders->id]) }}">Received</a>
                                                @endif
                                            </td>
                                            <td class="cell">
                                                <a class="btn-sm app-btn-secondary" href="{{url('rate_now' ,$orders->id)}}">Rate</a>
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
                                            <th class="cell">Products Ordered</th>
                                            <th class="cell">Total</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Order Date</th>
                                            <th class="cell">Delivery Address</th>
                                            <th class="cell">Cancel Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orderItemscancel as $orders)
                                        @php
                                            // Split the strings into arrays
                                            $productTitles = explode(', ', $orders->product_title);       // Array of product titles
                                            $quantities = explode(', ', $orders->quantity);       // Array of quantities
                                            $images = explode(', ', $orders->image);               // Array of product images
                            
                                            // Concatenate titles and quantities for display
                                            $productsDisplay = [];
                                            for ($i = 0; $i < count($productTitles); $i++) {
                                                $productsDisplay[] = '<img class="img_design" src="' . $images[$i] . '" alt="" style="width: 30px; margin-right: 5px;"> ' . $productTitles[$i] . ' x ' . $quantities[$i];
                                            }
                                            $productsList = implode(', ', $productsDisplay);
                                        @endphp
                            
                                        <tr>
                                            <td class="cell">{!! $productsList !!}</td>
                                            <td class="cell">₱{{ $orders->price }}</td>
                                            <td class="cell"><span class="badge bg-danger">{{ $orders->delivery_status }}</span></td>
                                            <td class="cell"><span>{{ $orders->created_at->format('m-d-Y') }}</td>
                                            <td class="cell" style="width: 300px;"><span>{{ $orders->pickup_location }}</span></td>
                                            <td class="cell"><b>{{ $orders->cancel_reason }} ,</b> <br>{{ $orders->other_reason }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <i class="fa fa-truck" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
                                                <p>No cancelled orders at the moment.</p>
                                            </td>
                                        </tr>
                                    @endforelse
    
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->		
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
            
            
            
        </div><!--//container-fluid-->
    </div><!--//app-content-->

    <!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelModalLabel">Cancel Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="cancelOrderForm" action="{{ route('orders.cancel', 'placeholder') }}" method="POST">

            @csrf
            <!-- Reason to cancel -->
            <div class="mb-3">
                <p style="color: red;">Note: Cancellation is only available within 24 hours of ordering.</p><br>
              <label for="cancelReason" class="form-label">Reason for Cancellation</label>
              <select class="form-select" id="cancelReason" name="cancel_reason" required>
                <option value="">Select a reason</option>
                <option value="Found a better price">Found a better price</option>
                <option value="Item will arrive too late">Item will arrive too late</option>
                <option value="I order the wrong product">I order the wrong product</option>
                <option value="Changed my mind">Changed my mind</option>
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
          <button type="submit" form="cancelOrderForm" class="btn btn-danger text-white" id="CancelSubmit">Submit</button>
        </div>
      </div>
    </div>
  </div>

   {{-- Modal for Order Details --}}
   <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="order-tracking">
                    <div class="step pending">
                      <div class="circle"><i class="fa fa-clock"></i></div>
                      <p>Pending</p>
                    </div>
                    <div class="line"></div>
                    <div class="step for-accepted">
                      <div class="circle"><i class="fa fa-check"></i></div>
                      <p>Accepted</p>
                    </div>
                    <div class="line"></div>
                    <div class="step for-delivery">
                      <div class="circle"><i class="fa fa-truck"></i></div>
                      <small>For Delivery</small>
                    </div>
                    <div class="line"></div>
                    <div class="step completed">
                      <div class="circle" style="margin-top: -10px;"><i class="fa fa-star"></i></div>
                      <small>Completed</small>
                    </div>
                </div>
    
                <h5>Products:</h5>
                <div id="modalProductsList"></div>
                <hr>
                <p><strong>Total Price:</strong> <span id="modalPrice"></span></p>
                <p><strong>Delivery Status:</strong> <span id="modalDeliveryStatus"></span></p>
                <p><strong>Order Date:</strong> <span id="modalOrderDate"></span></p>
                <p><strong>Delivery Date:</strong> <span id="modalDeliveryDate"></span></p>
                <p><strong>Pickup Location:</strong> <span id="modalPickupLocation"></span></p>
            </div>
        </div>
    </div>
</div>

    @include('home.footer')

    <!-- Js Plugins -->
    <script src="home/js/jquery-3.3.1.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/jquery.nice-select.min.js"></script>
    <script src="home/js/jquery-ui.min.js"></script>
    <script src="home/js/jquery.slicknav.js"></script>
    <script src="home/js/mixitup.min.js"></script>
    <script src="home/js/owl.carousel.min.js"></script>
    
    <script src="admin/assets/plugins/popper.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    <!-- Page Specific JS -->
    <script src="admin/assets/js/app.js"></script> 

    <script src="home/js/main.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    // Listen for click events on elements with the class 'view-order-btn'
    document.querySelectorAll('.view-order-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Get data attributes
            const products = this.getAttribute('data-products');
            const price = this.getAttribute('data-price');
            const status = this.getAttribute('data-status'); // The order status (pending, processing, delivery)
            const orderDate = this.getAttribute('data-order-date');
            const deliveryDate = this.getAttribute('data-delivery-date');
            const pickupLocation = this.getAttribute('data-pickup');

            // Set the modal content
            document.getElementById('modalProductsList').innerHTML = products;
            document.getElementById('modalPrice').innerText = price;
            document.getElementById('modalDeliveryStatus').innerText = status;
            document.getElementById('modalOrderDate').innerText = orderDate;
            document.getElementById('modalDeliveryDate').innerText = deliveryDate;
            document.getElementById('modalPickupLocation').innerText = pickupLocation;

            // Reset all steps and lines
            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active');
            });
            document.querySelectorAll('.line').forEach(line => {
                line.classList.remove('active');
            });

            // Highlight based on status
            if (status === 'pending') {
                document.querySelector('.pending').classList.add('active');
            } else if (status === 'for delivery') {
                document.querySelector('.pending').classList.add('active');
                document.querySelector('.for-accepted').classList.add('active');
                document.querySelector('.for-delivery').classList.add('active');
                document.querySelectorAll('.line').forEach(line => line.classList.add('active'));
            }else if (status === 'for pickup'){
                document.querySelector('.pending').classList.add('active');
                document.querySelector('.for-accepted').classList.add('active');
                document.querySelector('.for-delivery').classList.add('active');
            }else if (status === 'completed') {
                document.querySelector('.completed').classList.add('active');
                document.querySelectorAll('.line').forEach(line => line.classList.add('active'));
                document.querySelector('.pending').classList.add('active');
                document.querySelector('.for-accepted').classList.add('active');
                document.querySelector('.for-delivery').classList.add('active');
            }else if (status === 'received') {
                document.querySelector('.completed').classList.add('active');
                document.querySelectorAll('.line').forEach(line => line.classList.add('active'));
                document.querySelector('.pending').classList.add('active');
                document.querySelector('.for-accepted').classList.add('active');
                document.querySelector('.for-delivery').classList.add('active');
            }
        });
    });
});

function openCancelModal(event, buttonElement) {
    // Prevent the modal from being triggered immediately
    event.preventDefault();
    
    // Retrieve the order ID and creation time from the data attributes
    const orderId = buttonElement.getAttribute('data-order-id');
    const orderTime = new Date(buttonElement.getAttribute('data-order-time'));
    const cancellationButton = document.getElementById('CancelSubmit');
    
    // Log the order ID and creation time to the console (for testing)
    console.log('Order ID:', orderId);
    console.log('Order Time:', orderTime);

    // Calculate the time difference between now and the order creation time (in hours)
    const currentTime = new Date();
    const timeDifference = (currentTime - orderTime) / (1000 * 60 * 60); // Convert to hours

    // Check if the order was placed more than 24 hours ago
    if (timeDifference > 24) {
        // If it's been more than 24 hours, show a SweetAlert and prevent opening the modal
        Swal.fire({
            title: 'Cancellation Not Allowed',
            text: 'You can only cancel your order within 24 hours of placing it.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });

        cancellationButton.disabled = true;
        
        return; 

    }
    cancellationButton.disabled = false;
    // If the order is within 24 hours, set the form action and show the modal
    const form = document.getElementById('cancelOrderForm');
    form.action = `/orders/cancel/${orderId}`; 

    // Optionally, display the order ID in the modal
    document.getElementById('orderIdDisplay').innerText = `Order ID: ${orderId}`;
    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
    modal.show();
}
document.addEventListener("DOMContentLoaded", function () {
    // Set up the target time for 5 PM today (Philippines Time)
    const now = new Date(); // Current date and time
    const targetTime = new Date(
        now.getFullYear(),
        now.getMonth(),
        now.getDate(),
        17, // 5 PM in 24-hour format
        0,
        0
    );

    const countdownElement = document.getElementById("countdown");

    // Function to calculate and update the countdown
    function updateCountdown() {
        const currentTime = new Date();
        const remainingTime = targetTime - currentTime;

        // If the time has already passed, show a cancellation message
        if (remainingTime <= 0) {
            countdownElement.innerHTML = "Cancelled (time expired)";
            countdownElement.style.color = "red"; // Optional: Highlight in red
            return;
        }

        // Calculate hours, minutes, and seconds remaining
        const hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
        const seconds = Math.floor((remainingTime / 1000) % 60);

        // Format the time with leading zeros
        countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
    }

    // Update the countdown every second
    const timerInterval = setInterval(updateCountdown, 1000);

    // Stop the timer when time expires
    setTimeout(() => {
        clearInterval(timerInterval);
    }, targetTime - now); // Stop after target time passes
});

    </script>
</body>

</html>