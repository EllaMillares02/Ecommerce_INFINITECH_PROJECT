<div id="app-sidepanel" class="app-sidepanel"> 
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding d-flex align-items-center">
            <a class="app-logo d-flex align-items-center" href="{{ url('redirect') }}">
                <img class="logo-icon me-2" src="img/logoCraftee.png" alt="logo">
                <span class="logo-text">DASHBOARD</span>
            </a>
        </div><!--//app-branding-->  
        
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('redirect') ? 'active' : '' }}" href="{{url('redirect')}}">
                        <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        </svg>
                         </span>
                         <span class="nav-link-text">Overview</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

                <li class="nav-item ">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link" href="{{ url('/chatify') }}">
                        <span class="nav-icon app-utility-item">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 2a2 2 0 0 0-2 2v9.586l2.293-2.293A1 1 0 0 1 3 11h9a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm0 1h10a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H3.414l-1.707 1.707A1 1 0 0 1 1 10.586V4a1 1 0 0 1 1-1z"/>
                              </svg>                                    
                              <span class="icon-badge"> {{ $newMessagesCount }}</span>
                         </span>
                         <span class="nav-link-text">Messages</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('view_category') ? 'active' : '' }}" href="{{url('view_category')}}">
                        <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                        <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
                        </svg>
                         </span>
                         <span class="nav-link-text">Category</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                        <span class="nav-icon">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
                        <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
                        </svg>
                         </span>
                         <span class="nav-link-text">Products</span>
                         <span class="submenu-arrow">
                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                         </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link" href="{{url('/show_product')}}">Show Products</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="{{url('/view_product')}}">Add Products</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="{{url('/sale')}}">Add OnSales Product</a></li>
                        </ul>
                    </div>
                </li><!--//nav-item-->

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('view_order') ? 'active' : '' }}" href="{{url('/view_order')}}">
                        <span class="nav-icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                            <circle cx="3.5" cy="5.5" r=".5"/>
                            <circle cx="3.5" cy="8" r=".5"/>
                            <circle cx="3.5" cy="10.5" r=".5"/>
                        </svg>
                         </span>
                         <span class="nav-link-text">Orders</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('view_coupons') ? 'active' : '' }}" href="{{url('/view_coupons')}}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-coupon">
                                <path d="M2 2.5A1.5 1.5 0 0 1 3.5 1h9A1.5 1.5 0 0 1 14 2.5v2.063a1 1 0 1 0 0 1.875V9.5a1 1 0 1 0 0 1.875v2.125A1.5 1.5 0 0 1 12.5 15h-9A1.5 1.5 0 0 1 2 13.5v-2.125a1 1 0 1 0 0-1.875V6.438a1 1 0 1 0 0-1.875V2.5zM3.5 2a.5.5 0 0 0-.5.5v2.063a1 1 0 0 1 0 1.875V9.5a1 1 0 0 1 0 1.875v2.125a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-2.125a1 1 0 0 1 0-1.875V6.438a1 1 0 0 1 0-1.875V2.5a.5.5 0 0 0-.5-.5h-9z"/>
                                <path d="M6.5 6a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm-1.854-2.646a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l1-1a.5.5 0 1 0-.708-.708L8.5 4.293 7.646 3.354z"/>
                              </svg>                              
                         </span>
                         <span class="nav-link-text">Coupons</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->

               
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('view_inventory') ? 'active' : '' }}" href="{{url('/view_inventory')}}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-stack" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.489 1.687a.5.5 0 0 0-.478 0l-6 3.25a.5.5 0 0 0 0 .876l6 3.25a.5.5 0 0 0 .478 0l6-3.25a.5.5 0 0 0 0-.876l-6-3.25z"/>
                                <path d="M.489 7.943a.5.5 0 0 1 .671-.223L8 11.076l6.84-3.356a.5.5 0 0 1 .448.894l-6.5 3.25a.5.5 0 0 1-.478 0l-6.5-3.25a.5.5 0 0 1-.223-.671z"/>
                                <path d="M.489 10.943a.5.5 0 0 1 .671-.223L8 14.076l6.84-3.356a.5.5 0 1 1 .448.894l-6.5 3.25a.5.5 0 0 1-.478 0l-6.5-3.25a.5.5 0 0 1-.223-.671z"/>
                              </svg>
                              
                              
                         </span>
                         <span class="nav-link-text">Inventory</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('manage_blogs') ? 'active' : '' }}" href="{{url('/manage_blogs')}}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6.5L9.5 0H4zm8 14H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5v4a1 1 0 0 0 1 1h4v8a1 1 0 0 1-1 1z"/>
                                <path d="M6 4h4v1H6V4zm0 2h6v1H6V6zm0 2h6v1H6V8zm0 2h6v1H6v-1zm0 2h3v1H6v-1z"/>
                              </svg>                              
                         </span>
                         <span class="nav-link-text">Blog Details</span>
                    </a><!--//nav-link-->
                </li>

                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ request()->is('changeBanner') ? 'active' : '' }}" href="{{url('/changeBanner')}}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
                              </svg>
                         </span>
                         <span class="nav-link-text">Banners Images</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->	
                
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link nav-link {{ request()->is('addAdmin') ? 'active' : '' }}" href="{{url('/addAdmin')}}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                            <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Add Admin/Staff</span>
                    </a><!--//nav-link-->
                </li>

            </ul><!--//app-menu-->
        </nav><!--//app-nav-->
   
    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->