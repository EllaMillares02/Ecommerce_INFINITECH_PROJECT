/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    $('.hero__categories__all').on('click', function(){
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });
    $(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        smartSpeed: 500,
        autoHeight: false,
        autoplay: true
    });
    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
		Price Range Slider
	------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('₱' + ui.values[0]);
            maxamount.val('₱' + ui.values[1]);
        }
    });
    minamount.val('₱' + rangeSlider.slider("values", 0));
    maxamount.val('₱' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
		Single Product
	--------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });
    
    var proQty = $('.pro-qty2');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    
/*-------------------
    Quantity change
--------------------- */
var proQty = $('.pro-qty');

// Add increment and decrement buttons
proQty.prepend('<span class="dec qtybtn">-</span>');
proQty.append('<span class="inc qtybtn">+</span>');

// Handle quantity change
proQty.on('click', '.qtybtn', function (event) {
    event.preventDefault();

    var $button = $(this);
    var $input = $button.parent().find('input');
    var oldValue = parseInt($input.val(), 10);
    var productId = $input.data('product-id').replace('acc-', '');
    var newVal;

    // Increment or decrement quantity
    if ($button.hasClass('inc')) {
        newVal = oldValue + 1;
    } else {
        newVal = Math.max(oldValue - 1, 1); // Ensure the minimum value is 1
    }

    // Update the input value
    $input.val(newVal);

    // Send AJAX request to update the cart
    $.ajax({
        url: '/update_cart',
        method: 'POST',
        data: {
            id: productId,
            quantity: newVal,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                // Update the product price dynamically
                $('.product-total-' + productId + ' span').text(response.productSubtotal);

                // Update the cart total dynamically
                $('.cart-total').text(response.cartTotal);
            } else {
                alert('Failed to update cart. Please try again.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error updating cart:', error);
            alert('An error occurred while updating the cart. Please try again.');
        }
    });
});

/*-------------------
    Checkout price
--------------------- */
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const subtotalElement = document.querySelector('.subtotal'); 
    const totalElement = document.querySelector('.total'); 
    let totalPrice = 0;

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const itemPrice = parseFloat(this.getAttribute('data-product-price'));

            if (this.checked) {
                totalPrice += itemPrice;
            } else {
                totalPrice -= itemPrice;
            }

            subtotalElement.textContent = '₱' + totalPrice.toFixed(2);
            totalElement.textContent = '₱' + totalPrice.toFixed(2); 
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const selectedProductsInput = document.getElementById('selected_products');
    const checkoutForm = document.getElementById('checkoutForm');
    const checkoutButton = document.querySelector('#checkoutForm button');


    // Function to collect selected products
    function collectSelectedProducts() {
        let selectedProducts = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                const product = {
                    cart_id: checkbox.getAttribute('data-cart-id'),
                    title: checkbox.getAttribute('data-product-title'),
                    price: checkbox.getAttribute('data-product-price'),
                    quantity: checkbox.getAttribute('data-product-quantity'),
                    img: checkbox.getAttribute('data-product-img'),
                    prod_id: checkbox.getAttribute('data-product-id')
                };
                selectedProducts.push(product);
            }
        });
        
        // Enable or disable the checkout button
        if (selectedProducts.length > 0) {
            checkoutButton.disabled = false; // Enable the button
        } else {
            checkoutButton.disabled = true;  // Disable the button
        }
        // Store selected products as a JSON string in the hidden input field
        selectedProductsInput.value = JSON.stringify(selectedProducts);
    }

    // Attach change event listener to each checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', collectSelectedProducts);
    });

    // Collect selected products when form is submitted
    checkoutForm.addEventListener('submit', function(event) {
        collectSelectedProducts();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const subtotal = parseFloat(document.getElementById('subtotal').innerText.replace('₱', '').replace(',', ''));
    const ship = document.getElementById('shipping');
    const totalElement = document.getElementById('total'); // Element displaying the total
    const totalAmountInput = document.getElementById('totalAmount'); // Hidden input for total

    // Function to update total based on selected shipping option
    function updateTotal() {
        const shippingOptions = document.querySelectorAll('input[name="shipping"]');
        let shippingFee = 0;

        // Find the checked radio button
        shippingOptions.forEach(option => {
            if (option.checked) {
                shippingFee = parseFloat(option.value);
            }
        });

        // Calculate new total
        const total = subtotal + shippingFee;
        totalElement.innerText = `₱${total.toFixed(2)}`; // Update displayed total
        totalAmountInput.value = total.toFixed(2); // Update hidden total input value
        ship.innerText= '₱'+ shippingFee;
    }

    // Add event listeners to shipping options to recalculate total on change
    const shippingOptions = document.querySelectorAll('input[name="shipping"]');
    shippingOptions.forEach(option => {
        option.addEventListener('change', updateTotal);
    });

    // Initial calculation on page load
    updateTotal();
});



document.addEventListener('DOMContentLoaded', function() {
    const codOption = document.getElementById('cod');
    const pickUpOption = document.getElementById('pick-up');
    const storeAddress = document.getElementById('store-address');
    const deliveryLocationInput = document.getElementById('delivery-address');
    const estimatedDateInput = document.getElementById('estimated-delivery');
    const pickupTimeInput = document.getElementById('pickup-time');

    // Flatpickr configuration for pick-up time
    flatpickr("#pickup-time-input", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i", // 24-hour format
        time_24hr: true,
        minTime: "08:00", // Set minimum time to 8 AM
        maxTime: "17:00"  // Set maximum time to 5 PM
    });

    // Function to handle showing/hiding elements based on delivery type
    function handleDeliveryTypeChange() {
        if (pickUpOption.checked) {
            storeAddress.style.display = 'block'; // Show store address
            deliveryLocationInput.style.display = 'none'; // Hide meet-up location input
            pickupTimeInput.style.display = 'block'; // Show pick-up time input
            estimatedDateInput.style.display = 'none'; // Hide delivery date input

            // Automatically set today's date for pick-up
            const today = new Date();
            deliveryDatePicker.setDate(today);  // Set today's date in the Flatpickr instance
            deliveryDateInput.value = today.toISOString().split('T')[0]; // Set the value of the input to today's date
        } else if (codOption.checked) {
            storeAddress.style.display = 'none'; // Hide store address
            deliveryLocationInput.style.display = 'block'; // Show meet-up location input
            pickupTimeInput.style.display = 'none'; // Hide pick-up time input
            estimatedDateInput.style.display = 'block'; // Show delivery date input

            // Clear the delivery date so the user can choose Thursday/Friday
            deliveryDatePicker.clear();
            deliveryDateInput.value = ""; // Clear the input field
        }
    }

    // Add event listeners to radio buttons
    pickUpOption.addEventListener('change', handleDeliveryTypeChange);
    codOption.addEventListener('change', handleDeliveryTypeChange);

    // Ensure the initial state matches the selected option on page load
    handleDeliveryTypeChange();
});

document.addEventListener('DOMContentLoaded', function() {
    const pickupTimeInput = document.getElementById('pickup-time-input');

    // Flatpickr configuration for pick-up time in 12-hour format
    flatpickr(pickupTimeInput, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour format with AM/PM
        time_24hr: false, // Disable 24-hour format
        minTime: "08:00", // Set minimum time to 8 AM
        maxTime: "05:00 PM", // Set maximum time to 5 PM
        minuteIncrement: 30, // Increment in 30-minute intervals
        altInput: true, // Show a more human-readable format
        altFormat: "h:i K", // e.g., 8:00 AM
        onReady: function(selectedDates, dateStr, instance) {
            // Optionally, set a default time if needed
            const defaultTime = new Date();
            defaultTime.setHours(8); // Set default time to 8 AM
            defaultTime.setMinutes(0);
            instance.setDate(defaultTime); // Set the default time in Flatpickr
        }
    });
});


function to24HourFormat(time) {
    const [timePart, modifier] = time.split(' ');
    let [hours, minutes] = timePart.split(':');
    
    if (modifier === 'PM' && hours !== '12') {
        hours = parseInt(hours, 10) + 12; // Convert PM to 24-hour format
    } else if (modifier === 'AM' && hours === '12') {
        hours = '00'; // Convert 12 AM to 00
    }

    return `${hours}:${minutes}`; // Return in "HH:mm" format
}

document.getElementById('placeOrderForm').addEventListener('submit', function(event) {
    const codOption = document.getElementById('cod'); // Cash on Delivery option
    const pickUpOption = document.getElementById('pick-up'); // Pick-up at store option
    const pickupLocation = document.getElementById('address').value; // User's meet-up location
    const deliveryDateInput = document.getElementById('estimated-delivery');
    const pickupTimeInput = document.getElementById('pickup-time-input'); // Pick-up time input

    // Set the delivery type
    if (codOption.checked) {
        document.getElementById('hidden_delivery_type').value = 'delivery';
        document.getElementById('hidden_meetup_location').value = pickupLocation; // Set pickup location for COD
        document.getElementById('hidden_delivery_date').value = deliveryDateInput.value; 
    } else if (pickUpOption.checked) {
        document.getElementById('hidden_delivery_type').value = 'pickup';
        document.getElementById('hidden_meetup_location').value = "Pickup @ Craftee, Guinobatan, 4503 Albay"; // Store address for pick-up
        
        // Set today's date and the user's chosen time for pick-up
        const today = new Date().toISOString().split('T')[0]; // Format date as "YYYY-MM-DD"
        const pickupTime = pickupTimeInput.value; // User's pick-up time
        const formattedTime = to24HourFormat(pickupTime); // Convert to 24-hour format
        const deliveryDateTime = `${today} ${formattedTime}`; // Combine today's date with the user's time
        document.getElementById('hidden_delivery_date').value = deliveryDateTime; // Save to hidden field
    }

    // Validation
    if (codOption.checked && !pickupLocation) {
        alert("Please enter a meet-up location for Cash on Delivery.");
        event.preventDefault();  // Prevent form submission if the meet-up location is empty
    }

    if (pickUpOption.checked && !pickupTimeInput.value) {
        alert("Please select a pick-up time.");
        event.preventDefault();  // Prevent form submission if the pick-up time is empty
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const cancelReason = document.getElementById('cancelReason');
    const otherReasonDiv = document.getElementById('otherReasonDiv');
    const otherReasonInput = document.getElementById('otherReason');

    cancelReason.addEventListener('change', function() {
        if (this.value === 'Other') {
            otherReasonDiv.classList.remove('d-none');  // Show textbox
            otherReasonInput.setAttribute('required', 'required');  // Make the textbox required
        } else {
            otherReasonDiv.classList.add('d-none');  // Hide textbox
            otherReasonInput.removeAttribute('required');  // Remove required attribute
        }
    });
});


})(jQuery);