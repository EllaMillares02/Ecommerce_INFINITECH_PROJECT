<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                            <li data-filter=".{{ strtolower(str_replace(' ', '-', $category->category)) }}">
                                <a href="{{ route('category.products', $category->category) }}#product-container" style="color: black">
                                    {{ $category->category }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @foreach ($product as $products)
                
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 col-6 {{ strtolower(str_replace(' ', '-', $products->category)) }}">

                <div class="featured__item">
                   
                    <div class="featured__item__pic set-bg" data-setbg="product/{{$products->image}}"  ondblclick="redirectToProduct('{{ url('product_details', $products->id) }}')">

                        <div class="overlay" id="cart-overlay-{{ $products->id }}"  style="display: none;">
                            <form action="{{ url('add_cart', $products->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="product_name" id="product-name-{{ $products->id }}" value="{{ $products->title }}">
                                <input type="hidden" name="product_price" id="product-price-{{ $products->id }}" value="{{ $products->price }}">
            
                                        @if($products->flavors && $products->flavors->isNotEmpty())
                                                <div class="flavors-section">
                                                    <label>Select a Color:</label>
                                                    <div class="flavors-buttons">
                                                        @foreach($products->flavors as $index => $flavor)
                                                            <label class="flavor-option">
                                                                <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                <span>{{ $flavor->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($products->sizes && $products->sizes->isNotEmpty())
                                                <div class="sizes-section">
                                                    <label>Select a Size:</label>
                                                    <div class="sizes-buttons">
                                                        @foreach($products->flavors as $flavorIndex => $flavor)
                                                            <div class="flavor-sizes" id="sizes-for-flavor-{{ $flavor->id }}" 
                                                                style="display: {{ $flavorIndex === 0 ? 'block' : 'none' }};">
                                                                @foreach($flavor->sizes as $sizeIndex => $size)
                                                                    <label class="size-option">
                                                                        <input type="radio" name="selected_size" value="{{ $size->id }}" 
                                                                            data-price="{{ $size->price }}"
                                                                            onclick="updateProductInfo('{{ $products->id }}', '{{ $products->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" 
                                                                            {{ $flavorIndex === 0 && $sizeIndex === 0 ? 'checked' : '' }} required="">
                                                                        <span>{{ $size->size }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                            
                                    <input type="hidden" name="quantity" value="1" min="1">
                                    <input type="submit" class="btn btn-warning btn-sm mt-2" value="ADD TO CART">
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                </form>
                            
                        </div>

                        <div class="overlay" id="wishlist-overlay-{{ $products->id }}" style="display: none;">
                            <form action="{{ url('add_wishlist', $products->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="product_name" id="wishlist-product-name-{{ $products->id }}" value="{{ $products->title }}">
                                <input type="hidden" name="product_price" id="wishlist-product-price-{{ $products->id }}" value="{{ $products->price }}">
            
                                            @if($products->flavors && $products->flavors->isNotEmpty())
                                                <div class="flavors-section">
                                                    <label>Select a Color:</label>
                                                    <div class="flavors-buttons">
                                                        @foreach($products->flavors as $index => $flavor)
                                                            <label class="flavor-option">
                                                                <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                <span>{{ $flavor->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($products->sizes && $products->sizes->isNotEmpty())
                                                <div class="sizes-section">
                                                    <label>Select a Size:</label>
                                                    <div class="sizes-buttons">
                                                        @foreach($products->flavors as $flavorIndex => $flavor)
                                                            <div class="flavor-sizes" id="wish-sizes-for-flavor-{{ $flavor->id }}" 
                                                                style="display: {{ $flavorIndex === 0 ? 'block' : 'none' }};">
                                                                @foreach($flavor->sizes as $sizeIndex => $size)
                                                                    <label class="size-option">
                                                                        <input type="radio" name="selected_size" value="{{ $size->id }}" 
                                                                            data-price="{{ $size->price }}"
                                                                            onclick="updateProductInfoForWishlist('{{ $products->id }}', '{{ $products->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" 
                                                                            {{ $flavorIndex === 0 && $sizeIndex === 0 ? 'checked' : '' }} required="">
                                                                        <span>{{ $size->size }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                <input type="hidden" name="quantity" value="1" min="1">

                                <input type="submit" class="btn btn-warning btn-sm mt-2" value="ADD TO WISHLIST">
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                </form>
                            </div>

                            <div class="overlay" id="buy-overlay-{{ $products->id }}" style="display: none;">
                                <form action="{{ url('/checkout') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="quantity" value="1" min="1">
                                    <input type="hidden" name="image" value="/product/{{ $products->image }}">
                                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                                    <input type="hidden" name="productName" id="buy-product-name-{{ $products->id }}" value="">
                                    <input type="hidden" name="product_price" id="buy-product-price-{{ $products->id }}" value="">
                                    
                                                @if($products->flavors && $products->flavors->isNotEmpty())
                                                    <div class="flavors-section">
                                                        <label>Select a Color:</label>
                                                        <div class="flavors-buttons">
                                                            @foreach($products->flavors as $index => $flavor)
                                                                <label class="flavor-option">
                                                                    <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                    onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                    <span>{{ $flavor->name }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
    
                                                @if($products->sizes && $products->sizes->isNotEmpty())
                                                    <div class="sizes-section">
                                                        <label>Select a Size:</label>
                                                        <div class="sizes-buttons">
                                                            @foreach($products->flavors as $flavor)
                                                                <div class="flavor-sizes" id="buy-sizes-for-flavor-{{ $flavor->id }}" style="display: none;">
                                                                    @foreach($flavor->sizes as $size)
                                                                        <label class="size-option">
                                                                            <input type="radio" name="selected_size" value="{{ $size->id }}" data-price="{{ $size->price }}"
                                                                            onclick="updateProductInfoForBuy('{{ $products->id }}', '{{ $products->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" required="">
                                                                            <span>{{ $size->size }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
    
                                    <input type="submit" class="btn btn-warning btn-sm mt-2" value="BUY NOW">
                                        <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                    </form>
                                </div>

                                @php
                                    // Ensure sizes is not null before calling sum()
                                    $totalStock = optional($products->sizes)->sum('stock_quantity') ?? 0;
                                @endphp

                                @if($totalStock > 0)
                                    <label class="stock">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif  
                        
                        <ul class="featured__item__pic__hover">

                          <li>
                            <button type="button" class="icon-button" onclick="showOverlay('wishlist', {{ $products->id }})">
                                <i class="fa fa-heart"></i>
                            </button> 
                          </li>

                            <li>
                                <button type="button" class="icon-button" onclick="showOverlay('buy', {{ $products->id }})">
                                    <i><b>BUY</b></i></a></li>
                                </button>
                            <li>
                                <button type="button" class="icon-button" onclick="showOverlay('cart', {{ $products->id }})">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{url('product_details',$products->id)}}">{{$products->title}}</a></h6>

                        @if($products->discount_price!=null)
                            <h5>₱{{$products->discount_price}}</h5>

                            <h5 style="text-decoration: line-through; color: gray;">₱{{$products->price}}</h5>

                            @else
                                <h5 id="product-price-change-{{ $products->id }}">₱{{ $products->price }}</h5>
                                <h5>&nbsp;</h5>
                        @endif
  
                    </div>
                </div>
            </div>

            @endforeach
                
        </div>
    </div>
</section>
<!-- Featured Section End -->

<script>
     // Function to show the overlay for the product
     function showOverlay(type, productId) {
    // Find the overlay element based on type and productId
    const overlay = document.getElementById(`${type}-overlay-${productId}`);
    document.body.style.overflow = 'hidden';
    // Check if the overlay exists and set its display to block
    if (overlay) {
        overlay.style.display = 'flex'; // Or 'block' depending on your layout
    } else {
        console.error(`Overlay element for ${type} with ID ${productId} not found`);
    }
}


// Hide the overlay when "Cancel" is clicked
function hideOverlay(button) {
    const overlay = button.closest('.overlay');
    overlay.style.display = 'none';
    document.body.style.overflow = '';
}

function showSizesForFlavor(flavorId) {
    // Hide all size sections
    document.querySelectorAll('.flavor-sizes').forEach(section => {
        section.style.display = 'none';
    });

    // Show the sizes for the selected flavor
    const selectedSizeSection = document.getElementById(`sizes-for-flavor-${flavorId}`);
    if (selectedSizeSection) {
        selectedSizeSection.style.display = 'block';
    }

    const wishselectedSizeSection = document.getElementById(`wish-sizes-for-flavor-${flavorId}`);
    if (wishselectedSizeSection) {
        wishselectedSizeSection.style.display = 'block';
    }
    const buyselectedSizeSection = document.getElementById(`buy-sizes-for-flavor-${flavorId}`);
    if (buyselectedSizeSection) {
        buyselectedSizeSection.style.display = 'block';
    }
}

// Initial load to show sizes for the first flavor
document.addEventListener('DOMContentLoaded', () => {
    const firstFlavor = document.querySelector('[name="selected_flavor"]:checked');
    if (firstFlavor) {
        showSizesForFlavor(firstFlavor.value);
    }
});

let selectedFlavor = null;

function setSelectedFlavor(flavorName) {
    selectedFlavor = flavorName;
}
function getSelectedFlavor() {
    // Return the selected flavor stored in the global variable
    return selectedFlavor || "Default Flavor"; // Provide a fallback if no flavor is selected
}

// Function to update product info when either size or flavor changes
function updateProductInfo(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size
    const productNameField = document.getElementById(`product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price
    const productPriceField = document.getElementById(`product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
}

// Function to update product info for Wishlist (flavor, size, price)
function updateProductInfoForWishlist(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size for Wishlist
    const productNameField = document.getElementById(`wishlist-product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price for Wishlist
    const productPriceField = document.getElementById(`wishlist-product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
}

// Function to update product info for Wishlist (flavor, size, price)
function updateProductInfoForBuy(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size for Wishlist
    const productNameField = document.getElementById(`buy-product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price for Wishlist
    const productPriceField = document.getElementById(`buy-product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const flavorRadios = document.querySelectorAll('input[name="selected_flavor"]:checked');
    const sizeRadios = document.querySelectorAll('input[name="selected_size"]:checked');

    flavorRadios.forEach((radio) => {
        setSelectedFlavor(radio.nextElementSibling.innerText); // Use the flavor name
    });

    sizeRadios.forEach((radio) => {
        const productId = radio.closest('form').querySelector('input[name="product_id"]').value;
        const productName = radio.closest('form').querySelector('input[name="product_name"]').value;
        const flavorName = getSelectedFlavor();
        const sizeName = radio.nextElementSibling.innerText;
        const sizePrice = radio.dataset.price;

        updateProductInfo(productId, productName, flavorName, sizeName, sizePrice);
        updateProductInfoForWishlist(productId, productName, flavorName, sizeName, sizePrice);
        updateProductInfoForBuy(productId, productName, flavorName, sizeName, sizePrice);
    });
});
window.onload = function() {
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        if (radio.defaultChecked) {
            radio.checked = true;
        }
    });
};



// Automatically select and update product info for single size products
@foreach ($product as $products)
    @if($products->sizes && $products->sizes->count() === 1)
        document.addEventListener("DOMContentLoaded", function() {
            const singleSizeRadio = document.querySelector('#cart-overlay-{{ $products->id }} input[name="selected_size"][data-price="{{ $products->sizes[0]->price }}"]');
            if (singleSizeRadio) {
                singleSizeRadio.checked = true;
                const selectedFlavor = document.querySelector('#cart-overlay-{{ $products->id }} input[name="selected_flavor"]:checked');
                const flavorName = selectedFlavor ? selectedFlavor.nextElementSibling.innerText : '{{ $products->flavors[0]->name }}'; // default to first flavor
                updateProductInfo('{{ $products->id }}', '{{ $products->title }}', flavorName, '{{ $products->sizes[0]->size }}', {{ $products->sizes[0]->price }});
            }
        });
    @endif
@endforeach

// Automatically select and update product info for single size products in Wishlist
@foreach ($product as $products)
    @if($products->sizes && $products->sizes->count() === 1)
        document.addEventListener("DOMContentLoaded", function() {
            const singleSizeRadio = document.querySelector(`#wishlist-overlay-{{ $products->id }} input[name="selected_size"][data-price="{{ $products->sizes[0]->price }}"]`);
            if (singleSizeRadio) {
                singleSizeRadio.checked = true;
                const selectedFlavor = document.querySelector(`#wishlist-overlay-{{ $products->id }} input[name="selected_flavor"]:checked`);
                const flavorName = selectedFlavor ? selectedFlavor.nextElementSibling.innerText : '{{ $products->flavors[0]->name }}'; // default to first flavor
                updateProductInfoForWishlist('{{ $products->id }}', '{{ $products->title }}', flavorName, '{{ $products->sizes[0]->size }}', {{ $products->sizes[0]->price }});
            }
        });
    @endif
@endforeach

function redirectToProduct(url) {
    window.location.href = url; // Redirects to the specified URL
}


</script>