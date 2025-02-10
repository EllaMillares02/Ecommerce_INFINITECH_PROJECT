<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="home/favicon.ico"> 
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Craftee | Ecommerce</title>

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
        .faq-question {
            cursor: pointer;
        }
        .btn-link {
        color: #ff4f93;
        font-weight: bold; 
        text-decoration: none;
        }

        .btn-link:hover {
            color: #911243; 
            text-decoration: underline;
        }
    </style>

</head>

<body>

    @include('home.header')

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

    <div class="container my-5">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>
        
        <div id="faqAccordion" class="accordion">
            <!-- FAQ Item 1 -->
            <div class="card">
                <div class="card-header" id="heading1">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            What is Craftee?
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#faqAccordion">
                    <div class="card-body">
                        Craftee is an online shopping platform designed for HandiCrafts Businesses. It allows customers to purchase a variety of dairy and related products conveniently online.
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="card">
                <div class="card-header" id="heading2">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            How do I create an account?
                        </button>
                    </h5>
                </div>
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#faqAccordion">
                    <div class="card-body">
                        To create an account, click on Register and follow the prompts to enter your details. You’ll receive an email for verification. After confirming your email account, you can access your account securely.
                    </div>
                </div>
            </div>

            <!-- Repeat the same structure for all the other questions -->
            <!-- Question 3 -->
            <div class="card">
                <div class="card-header" id="heading3">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            How do I use the Virtual Shopping Cart?
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#faqAccordion">
                    <div class="card-body">
                        You can add products to your Virtual Shopping Cart by selecting items you’re interested in purchasing. Your cart saves these items for you to review and purchase whenever you’re ready.
                    </div>
                </div>
            </div>

            <!-- Add remaining questions in similar structure -->
            <!-- Example question 4 -->
            <div class="card">
                <div class="card-header" id="heading4">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Can I cancel my order after it’s placed?
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, you can cancel your order within one day after placing it, before it moves to the confirmation stage. After this period, orders may no longer be eligible for cancellation due to preparation and delivery processes.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="heading5">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            How do I leave feedback on products I purchased?
                        </button>
                    </h5>
                </div>
                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#faqAccordion">
                    <div class="card-body">
                        After completing your purchase, you’ll be prompted to leave a review and rate the product. You can access this feature in your Order History section.
                    </div>
                </div>
            </div>
                <div class="card">
                    <div class="card-header" id="heading6">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                How can I track the freshness of products?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#faqAccordion">
                        <div class="card-body">
                            Each product listing shows an expiration date where applicable. The platform’s Inventory and Expiration Tracking system ensures that only fresh items are available for sale.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading7">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                What payment methods are accepted?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#faqAccordion">
                        <div class="card-body">
                            Craftee currently accepts Cash on Delivery (COD) and cash payments for walk-in customers only. This ensures a secure and convenient payment option, particularly for local deliveries and in-store purchases.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading8">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                Can I see my purchase history?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#faqAccordion">
                        <div class="card-body">
                            Yes, you can view your purchase history in the My Orders section, which includes your past orders, reviews, and rewards points earned.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading9">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                How does the Rewards System work?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#faqAccordion">
                        <div class="card-body">
                            Each time you make a purchase, you earn points that can be redeemed on future purchases. Check your Rewards Balance in your account to see your current points.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading10">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                How secure is my account on Craftee?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#faqAccordion">
                        <div class="card-body">
                            Craftee uses End-to-End Encryption to protect your data and Two-Factor Authentication (2FA) that adds extra security during sign-in and purchase confirmations.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading11">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                How do I contact customer support?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#faqAccordion">
                        <div class="card-body">
                            Reach out through the Sending you question below section or Contact Us page. Support is available to assist with questions, order issues, or technical help.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading12">
                        <h5 class="mb-0">
                            <button class="btn btn-link faq-question collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                What is the return and refund policy?
                            </button>
                        </h5>
                    </div>
                    <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#faqAccordion">
                        <div class="card-body">
                            Craftee does not allow returns or refunds. All sales are final, so please double-check your order details before completing your purchase. For any issues with your order, you may contact the seller directly for assistance.
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact__form__title">
                            <h2>Send Us Your Questions</h2>
                        </div>
                    </div>
                </div>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="name" placeholder="Your name" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="col-lg-12 text-center">
                            <textarea name="message" placeholder="Your Questions or Concern" required></textarea>
                            <button type="submit" class="site-btn">SEND MESSAGE</button>
                        </div>
                    </div>
                </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
