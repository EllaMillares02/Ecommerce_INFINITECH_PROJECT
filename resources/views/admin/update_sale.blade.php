<!DOCTYPE html>
<html lang="en"> 
<head>
    <base href="/public">
    <title>Admin Dashboard</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="admin/favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="admin/assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="admin/assets/css/portal.css">

    <style>
        .div_center{
            text-align: center;
            padding-top:  20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px;
            margin: auto;
            width: 50%;
        }
        .top{
            width: 50%;
            margin: auto;
        }
    </style>

</head> 

<body class="app">   	

    @include('admin.header')


    <div class="app-wrapper">
	    
        <div class="app-content pt-3 p-md-3 p-lg-4">
            
            <div class="container-xl div_center">
                
                @if(session()->has('message'))

                <div class="alert alert-success">

                    {{session()->get('message')}}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    
                </div>
                
             @endif

                <h1 class="app-page-title text-center ">Update Sale Products</h1>

      

                <form action="{{url('/update_sale_confirm',$sales->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                <div class="div_design">
                    <select id="product" name="product_id" class="form-control" required>
                        <option value="{{ $sales->product_id }}" selected>Change or Select Again: {{ $sales->product->title }}</option>
                        @foreach($products as $product)
                            <option 
                                value="{{ $product->id }}" 
                                data-flavors="{{ json_encode($product->flavors) }}" 
                                data-sizes="{{ json_encode($product->sizes->pluck('size')) }}" 
                                data-prices="{{ json_encode($product->sizes->pluck('price')) }}">
                                {{ $product->title }}
                            </option>
                        @endforeach
                    </select>
                    
                    <div id="options-container" style="display: block;">
                        <label for="flavor">Select Flavor:</label>
                        <select id="flavor" name="flavor" class="form-control" required>
                            <option value="{{ $sales->flavor }}" selected>{{ $sales->flavor }}</option>
                        </select>
                    
                        <label for="size">Select Size:</label>
                        <select id="size" name="size" class="form-control" required>
                            <option value="{{ $sales->size }}" selected>{{ $sales->size }}</option>
                        </select>
                    
                        <label for="price">Price:</label>
                        <input 
                            type="text" 
                            class="form-control mt-2" 
                            name="price" 
                            id="price" 
                            value="{{ $sales->price }}" 
                            readonly>
                    </div>

                <div class="div_design">
                <label for="discount_value">Discount Value:</label>
                <input type="number" name="discount_value" class="form-control" placeholder="Enter discount value" value="{{$sales->discount}}" required>
                </div>

                <div class="div_design">
                <label for="start_date">Sale Start Date:</label>
                <input type="date" name="start_date" class="form-control" value="{{$sales->start_date}}" required>
                </div>

                <div class="div_design">
                <label for="end_date">Sale End Date (Optional):</label>
                <input type="date" name="end_date" class="form-control" value="{{$sales->end_date}}">
                </div>

                <input type="hidden" name="title" id="title" value="">

                <button type="submit" class="btn btn-primary text-white">Save Sale Product</button>
                </form>
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

    <!-- Charts JS -->
    <script src="admin/assets/plugins/chart.js/chart.min.js"></script> 
    <script src="admin/assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="admin/assets/js/app.js"></script> 

    <script>
        document.getElementById('product').addEventListener('change', function () {
    const selectedProduct = this.options[this.selectedIndex];
    const flavors = JSON.parse(selectedProduct.getAttribute('data-flavors') || '[]');
    const sizes = JSON.parse(selectedProduct.getAttribute('data-sizes') || '[]');
    const prices = JSON.parse(selectedProduct.getAttribute('data-prices') || '[]');

    const flavorSelect = document.getElementById('flavor');
    const sizeSelect = document.getElementById('size');
    const priceInput = document.getElementById('price');

    flavorSelect.innerHTML = '<option value="" selected>Select Flavor</option>';
    sizeSelect.innerHTML = '<option value="" selected>Select Size</option>';
    priceInput.value = '';

    if (selectedProduct.value) {
        flavors.forEach(flavor => {
            const option = document.createElement('option');
            option.value = flavor.id;
            option.textContent = flavor.name;
            flavorSelect.appendChild(option);
        });

        sizes.forEach((size, index) => {
            const option = document.createElement('option');
            option.value = size;
            option.textContent = size;
            option.setAttribute('data-price', prices[index]);
            sizeSelect.appendChild(option);
        });
        document.getElementById('options-container').style.display = 'block';
    } else {
        document.getElementById('options-container').style.display = 'none';
    }
});

// Prepopulate price when size is selected
document.getElementById('size').addEventListener('change', function () {
    const selectedSize = this.options[this.selectedIndex];
    const price = selectedSize.getAttribute('data-price');
    document.getElementById('price').value = price || '';
});

function updateTitleAndPrice() {
    const productSelect = document.getElementById('product');
    const flavorSelect = document.getElementById('flavor');
    const sizeSelect = document.getElementById('size');
    const titleInput = document.getElementById('title'); // Hidden input for title
    const priceInput = document.getElementById('price'); // Hidden input for price

    const selectedProduct = productSelect.options[productSelect.selectedIndex]?.text.trim() || '';
    const selectedFlavor = flavorSelect.options[flavorSelect.selectedIndex]?.text.trim() || '';
    const selectedSize = sizeSelect.options[sizeSelect.selectedIndex]?.text.trim() || '';
    const selectedPrice = sizeSelect.options[sizeSelect.selectedIndex]?.getAttribute('data-price') || '';

    // Combine product, flavor, and size into the title
    titleInput.value = [selectedProduct, selectedFlavor, selectedSize].filter(Boolean).join(' ');

    // Set the price
    priceInput.value = selectedPrice;

    console.log('Generated Title:', titleInput.value); // Debugging
    console.log('Selected Price:', priceInput.value); // Debugging
}

// Attach event listeners to update title and price dynamically
document.getElementById('product').addEventListener('change', updateTitleAndPrice);
document.getElementById('flavor').addEventListener('change', updateTitleAndPrice);
document.getElementById('size').addEventListener('change', updateTitleAndPrice);


    </script>
</body>
</html> 

