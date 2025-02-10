
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{url('/')}}"><img src="img/logoCraftee.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{url('show_wishlist')}}"><i class="fa fa-heart"></i> <span>{{ $wishlistCount }}</span></a></li>
                <li><a href="{{url('show_cart')}}"><i class="fa fa fa-shopping-cart"></i> <span>{{ $cartCount }}</span></a></li>
                <li><a onclick="openChatChoiceModal()"><i class="fa fa-comment"></i> <span>{{ $newMessagesCount }}</span></a></li>
            </ul>
        </div>

            @if (Route::has('login'))

                            @auth
                            <div class="header__top__right__auth">
                                @livewire('navigation-menu')
                                <!--<x-app-layout></x-app-layout>-->
                            </div>

                            @else
                                
                            <div class="header__top__right__auth">
                                <a href="{{ route('login_page') }}"><i class="fa fa-user"></i> Login</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{ route('register_page') }}" class="ml-2">| Register</a>
                            </div>
                            @endauth
            @endif

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{ url('show_shop') }}">Shop</a></li>
                <li><a href="{{ url('blogs') }}">Blogs</a></li>
                <li><a href="{{ url('orders') }}">Orders</a></li>
                <li><a href="{{ url('contact') }}">Contact Us</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">

                <a href="https://www.facebook.com/sharer/sharer.php?u=" id="facebook-share" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=" id="twitter-share" target="_blank">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/" id="instagram-share" target="_blank">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="https://www.pinterest.com/pin/create/button/?url=" id="pinterest-share" target="_blank">
                    <i class="fa fa-pinterest"></i>
                </a>

            
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> craftee2025@gmail.com</li>
                <li>We Deliver and You Can Pick-up Orders</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> craftee2025@gmail.com</li>
                                <li>We Deliver and You Can Pick-up Orders</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=" id="facebook-share" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=" id="twitter-share" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="https://www.instagram.com/" id="instagram-share" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="https://www.pinterest.com/pin/create/button/?url=" id="pinterest-share" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                            </div>

                            @if (Route::has('login'))

                                @auth
                                    <div class="header__top__right__auth">
                                        @livewire('navigation-menu')
                                    </div>

                                    @else
                                        
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('login_page') }}"><i class="fa fa-user"></i> Login</a>
                                    </div>
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('register_page') }}" class="ml-2">| Register</a>
                                    </div>
                                @endauth
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{url('/')}}"><img src="img/logoCraftee.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu original-menu">
                        <ul>
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class="{{ request()->is('show_shop') ? 'active' : '' }}"><a href="{{ url('show_shop') }}">Shop</a></li>
                            <li class="{{ request()->is('orders') ? 'active' : '' }}"><a href="{{ url('orders') }}">Orders</a></li>
                            <li class="{{ request()->is('blogs') ? 'active' : '' }}"><a href="{{ url('blogs') }}">Blogs</a></li>
                            <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>

            <div class="page-with-floating-menu">
                <nav class="header__menu floating-menu">
                    <ul>
                        <li class="{{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}" title="Home">
                                <div class="circle-icon"><i class="fa fa-home"></i></div>
                            </a>
                        </li><br>
                        <li class="{{ request()->is('show_shop') ? 'active' : '' }}">
                            <a href="{{ url('show_shop') }}" title="Shop">
                                <div class="circle-icon"><i class="fab fa-shopify"></i></div>
                            </a>
                        </li><br>
                        <li class="{{ request()->is('orders') ? 'active' : '' }}">
                            <a href="{{ url('orders') }}" title="Orders">
                                <div class="circle-icon"><i class="fas fa-boxes"></i></div>
                            </a>
                        </li><br>
                        <li class="{{ request()->is('blogs') ? 'active' : '' }}">
                            <a href="{{ url('blogs') }}" title="Blogs">
                                <div class="circle-icon"><i class="fab fa-blogger-b"></i></div>
                            </a>
                        </li><br>
                        <li class="{{ request()->is('show_wishlist') ? 'active' : '' }}">
                            <a href="{{ url('show_wishlist') }}" title="Wishlist">
                                <div class="circle-icon"><i class="fa fa-heart"></i></div>
                            </a>
                        </li><br><li class="{{ request()->is('show_cart') ? 'active' : '' }}">
                            <a href="{{ url('show_cart') }}" title="Cart">
                                <div class="circle-icon"><i class="fa fa fa-shopping-cart"></i></div>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>

                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{url('show_wishlist')}}"><i class="fa fa-heart"></i> <span>{{ $wishlistCount }}</span></a></li>
                            <li><a href="{{url('show_cart')}}"><i class="fa fa fa-shopping-cart"></i> <span>{{ $cartCount }}</span></a></li>
                            <li><a onclick="openChatChoiceModal()"><i class="fa fa-comment"></i> <span>{{ $newMessagesCount }}</span></a></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <div class="modal fade" id="chatChoiceModal" tabindex="-1" role="dialog" aria-labelledby="chatChoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="chatChoiceModalLabel">Chat with Store Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Select the following options:</p><br><br>
              <!-- Admin Button -->
 
                <div class="col-md-12">
                    <button class="btn w-100" style="height: 60px; background-color: #ff4f93; color: #fff;" onclick="startChat(1)">
                        <i class="fa fa-user mr-2"></i> Admin
                    </button>
                </div>           

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    

</div>

<script>
    window.addEventListener('scroll', () => {
    const floatingMenu = document.querySelector('.floating-menu');
    const originalMenu = document.querySelector('.original-menu');
    
    if (window.scrollY > originalMenu.offsetHeight) {
        floatingMenu.style.display = 'block';
    } else {
        floatingMenu.style.display = 'none';
    }
});
let scrollTimeout;

window.addEventListener('scroll', () => {
    const floatingMenu = document.querySelector('.floating-menu');

    // Show the floating menu on scroll
    floatingMenu.style.display = 'block';

    // Clear the previous timeout
    clearTimeout(scrollTimeout);

    // Hide the menu after 3 seconds of no scrolling
    scrollTimeout = setTimeout(() => {
        floatingMenu.style.display = 'none';
    }, 3000);
});

function openChatChoiceModal() {
        $('#chatChoiceModal').modal('show');
    }

    // Function to start chat with chosen user (admin or delivery rider)
    function startChat(userType) {
        // Close the modal
        $('#chatChoiceModal').modal('hide');

        // Redirect to the Chatify URL based on the user's choice
        if (userType === 1) {
            // If the user chooses admin (ID 1)
            window.location.href = "{{ url('/chatify/2') }}"; // Admin's Chatify URL
        }
    }
</script>