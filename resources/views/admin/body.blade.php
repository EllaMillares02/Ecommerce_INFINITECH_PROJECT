<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        
        <h1 class="app-page-title">Overview</h1>
        
            
        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Products</h4>
                        <div class="stats-figure">{{ $total_prod }}</div>
                        
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask" href="{{url('/show_product')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Products Out of Stock</h4>
                        <div class="stats-figure" style="color: red;">{{ $productOutofStock }}</div>
                    </div>
                    <a class="app-card-link-mask" href="{{ route('outOfStock_product') }}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Customers</h4>
                        <div class="stats-figure">{{ $total_user }}</div>
                        <div class="stats-meta">
                            </div>
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Revenue</h4>
                        <div class="stats-figure">₱{{ number_format($total_revenue, 2) }}</div>
                        <div class="stats-meta"></div>
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask" href="{{url('/view_inventory')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
        </div><!--//row-->
        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Orders</h4>
                        <div class="stats-figure">{{ $pending_orders_count }}</div>
                            <div class="stats-meta">Pending</div>
                    <a class="app-card-link-mask" href="{{url('/view_order')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            </div>
            
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Orders</h4>
                        <div class="stats-figure">{{ $pickup_orders_count }}</div>
                        <div class="stats-meta">Pickup</div>
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask" href="{{url('/view_order')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Orders</h4>
                        <div class="stats-figure">{{ $delivery_orders_count }}</div>
                        <div class="stats-meta">
                            Delivery</div>
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask" href="{{url('/view_order')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Orders</h4>
                        <div class="stats-figure">{{ $completed_orders_count }}</div>
                        <div class="stats-meta">Completed</div>
                    </div><!--//app-card-body-->
                    <a class="app-card-link-mask" href="{{url('/view_order')}}"></a>
                </div><!--//app-card-->
            </div><!--//col-->
        </div><!--//row-->


        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Weekly Sales</h4>
                            </div><!--//col-->
                            <div class="col-auto">
                                <div class="card-header-action">
                                   
                                </div><!--//card-header-actions-->
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-3 p-lg-4">
                        <div class="mb-3 d-flex">   
                        
                        </div>
                        <div class="chart-container">
                            <canvas id="canvas-linechart" ></canvas>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
            
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">No. of Orders per Week</h4>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-header-->
                    <div class="app-card-body p-3 p-lg-4">
                        
                        <div class="chart-container">
                            <canvas id="canvas-barchart" ></canvas>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
            
        </div><!--//row-->
        
        
    </div><!--//container-fluid-->
</div><!--//app-content-->

