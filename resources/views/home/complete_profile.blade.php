<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pa-Buy | Ecommerce</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

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

    <style>
        body {
            background-color: #f8f9fa; 
        }
    
        .card {
            border-radius: 15px; 
        }
    
        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    
        .form-label {
            font-weight: bold;
        }
    
        .btn-primary {
            background-color: #EDBB0E;
            border: none;
        }
    
        .btn-primary:hover {
            background-color: #EDBB0E;
        }
        .card{
            margin-bottom: 50px;
        }
        .card-header{
            background-color: #EDBB0E;
        }
    </style>


</head>

<body>

    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> albaydairybox@gmail.com</li>
                                <li>We Deliver and You Can Pick-up Orders</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <script>
            @if (session('error_message'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error_message') }}',
                });
            @endif
        </script>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-white text-center">
                            <h4>Complete Your Profile</h4>
                        </div>
                        <div class="card-body">
                            <!-- Profile Form -->
                            <form method="POST" action="{{ route('saveProfile') }}">
                                @csrf
                                <!-- Address Field -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" :value="old('address')" required autofocus class="form-control" required placeholder="Enter your address">
                                </div>
    
                                <!-- Phone Field -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="flex items-center border border-gray-300 rounded-md shadow-sm">
                                        <!-- Philippine Flag -->
                                        <span class="inline-flex items-center px-3 bg-gray-100 border-r border-gray-300 rounded-l-md">
                                            <img src="https://flagcdn.com/w40/ph.png" alt="Philippine Flag" class="w-6 h-4" />
                                        </span>
                                        <!-- +63 Prefix -->
                                        <span class="inline-flex items-center px-3 bg-gray-100 border-r border-gray-300">
                                            +63
                                        </span>
                                        <!-- Phone Number Input -->
                                        <input 
                                            type="text" 
                                            id="phone" 
                                            name="phone" 
                                            class="block w-full border-none rounded-r-md focus:ring-0" 
                                            class="form-control"
                                            placeholder="9XXXXXXXXX" 
                                            pattern="9[0-9]{9}" 
                                            required 
                                        />
                                    </div>
                                </div>
    
                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter a new password" required>
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your new password" required>
                                </div>

    
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src="home/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChM5RFa_lzvr4pTBiaAK04zUkJez78_R0&libraries=places&callback=initMap" async defer></script>
<script>
    function initializeAutocomplete() {
        const addressInput = document.getElementById('address');

        // Initialize Google Places Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(addressInput, {
            types: ['establishment', 'geocode'], // Includes establishments and zones
            componentRestrictions: { country: "ph" } // Restrict to the Philippines
        });

        // Listen for when the user selects a suggestion
        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();

            // Validate if the place is valid
            if (place.geometry) {
                console.log("Selected Place:", place);
                console.log("Full Address:", place.formatted_address);

                // Optional: Extract components like zone, city, etc.
                const components = place.address_components;
                components.forEach(component => {
                    const types = component.types;
                    if (types.includes('sublocality') || types.includes('neighborhood')) {
                        console.log("Zone/Area:", component.long_name);
                    }
                    if (types.includes('locality')) {
                        console.log("City:", component.long_name);
                    }
                });
            } else {
                alert("Please select a valid address.");
            }
        });

        // Prevent gibberish input
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            const place = autocomplete.getPlace();
            if (!place || !place.geometry) {
                event.preventDefault();
                alert('Please select a valid address from the suggestions.');
                addressInput.focus();
            }
        });
    }

    // Initialize Autocomplete on page load
    window.addEventListener('load', initializeAutocomplete);
</script>
    

</body>

</html>
