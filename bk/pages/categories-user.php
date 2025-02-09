<!-- Include the Categories header -->


<div class="categories">
    <h2>All Categories <br><br></h2>
    <div class="categories-container">

        <!-- Category : All -->
        <div class="category" onclick="filterProducts('All')">
            <div class="category-icon" style="background-color:rgb(255, 255, 255);">
                <img src="../img/logos/all.png">
            </div>
            <div class="category-label">All</div>
        </div>


        <!-- Category 1: Mobiles -->
        <div class="category" onclick="filterProducts('mobiles')">
            <div class="category-icon" style="background-color: #ff6f61;">
                <img src="https://www.olx.com.pk/assets/mobiles.8c768c96bfde33f18fcf5af2a8b9cf71.png" alt="Mobiles">
            </div>
            <div class="category-label">Mobiles</div>
        </div>

        <!-- Category 2: Vehicles -->
        <div class="category" onclick="filterProducts('vehicle')">
            <div class="category-icon" style="background-color: #ffd700;">
                <img src="https://www.olx.com.pk/assets/vehicles.29fb808d5118f0db56f68a39ce5392e2.png"
                    alt="Vehicles">
            </div>
            <div class="category-label">Vehicles</div>
        </div>

        <!-- Category 3: Property -->
        <div class="category" onclick="filterProducts('property')">
            <div class="category-icon" style="background-color: #ffcccb;">
                <img src="https://www.olx.com.pk/assets/property-for-sale.e3a00dbfdaa69fe5f713665f1069502f.png"
                    alt="Property">
            </div>
            <div class="category-label">Property</div>
        </div>

        <!-- Category 4: Electronics -->
        <div class="category" onclick="filterProducts('electronics')">
            <div class="category-icon" style="background-color: #fff5d9;">
                <img src="https://www.olx.com.pk/assets/electronics-home-appliances.46e034dd8adca44625c2c70e4d1b5984.png"
                    alt="Electronics">
            </div>
            <div class="category-label">Electronics</div>
        </div>

        <!-- Category 5: Bikes -->
        <div class="category" onclick="filterProducts('bikes')">
            <div class="category-icon" style="background-color: #b3f0f0;">
                <img src="https://www.olx.com.pk/assets/bikes.4dcd02c49b2b83aa5b4d629d1e2b383e.png" alt="Bikes">
            </div>
            <div class="category-label">Bikes</div>
        </div>

        <!-- Category 6: Services -->
        <div class="category" onclick="filterProducts('services')">
            <div class="category-icon" style="background-color: #ffa500;">
                <img src="https://www.olx.com.pk/assets/services.dc6aef196c0403dc61b0ee813f66fa5b.png"
                    alt="Services">
            </div>
            <div class="category-label">Services</div>
        </div>

        <!-- Category 7: Books -->
        <div class="category" onclick="filterProducts('books')">
            <div class="category-icon" style="background-color: #ff4d4d;">
                <img src="https://www.olx.com.pk/assets/books-sports-hobbies.6fee8d841b332d65a10f050f4a2ee1c8.png"
                    alt="Books">
            </div>
            <div class="category-label">Books</div>
        </div>

    </div>
</div>

<script>
    // function for User.php
    function filterProducts(category) {
        fetch(`../Backend/filtered_products.php?category=${category}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('product-list').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
</script>