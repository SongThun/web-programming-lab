<div id="about-page" class="container">
    <div id="banner-title" style="background-image: url('public/images/bg-purple.jpg')">
        <span class="c-yellow">Welcome to Lorem Ipsum</span>
        <h1>Your Home, Your Story</h1>
    </div>
    <div class="container-inset">
        <div class="container">
            <p>At Lorem Ipsum, we believe that every space tells a story — and we’re here to help you tell yours. Explore our curated collection of unique and elegant decorative objects designed to bring charm, style, and personality to every corner of your home or workspace.</p>
            <p class="mb-2">From modern minimalism to boho vibes and timeless classics, our range includes:</p>
            <div class="mb-2 mt-2">
                <li>Artistic vases & planters</li>
                <li>Wall art & framed prints</li>
                <li>Handcrafted sculptures & figurines</li>
                <li>Candles & holders</li>
                <li>Tabletop accents & seasonal décor</li>
            </div>
        </div>
        <div class="container text-center">
            <h1>Why choose Lorem Ipsum?</h1>
            <div class="flex space-between wrap">
                <div class="card">
                    <img src="public/images/quality.png" alt="">
                    <span class="mt-2">Handpicked, high-quality items</span>
                </div>
                <div class="card">
                    <img src="public/images/luxury.png" alt="">
                    <span class="mt-2">Affordable luxury</span>
                </div>
                <div class="card">
                    <img src="public/images/secure.png" alt="">
                    <span class="mt-2">Fast & secure checkout</span>
                </div>
                <div class="card">
                    <img src="public/images/shipping.png" alt="">
                    <span class="mt-2">Nationwide shipping</span>
                </div>
            </div>
        </div>
    </div>

    
</div>

<div class="flex bg-iris footer">
        <div>
            <h1>Contact us</h1>
            <p>Have a question or need help styling your space? We're happy to assist!</p>
            <ul>
                <li class="flex mb-1">
                    <i class='bx bx-envelope me-1' ></i> 
                    Email: hello@loremipsumdecor.com
                </li>
                <li class="flex mb-1">
                    <i class='bx bx-phone me-1'></i> 
                    Phone: +1 (800) 123-4567
                </li>
                <li class="flex mb-1">
                    <i class='bx bx-home me-1'></i> 
                    Address: 268 Ly Thuong Kiet, District 10, Ho Chi Minh city, Vietnam
                </li>
                <li class="flex mb-1">
                    <i class='bx bx-message-rounded me-1'></i> 
                    Live Chat: Available Mon–Fri, 9AM–6PM
                </li>
            </ul>
        </div>
        <div id="map"></div>
    </div>
<script>

    const map = L.map('map').setView([10.762622, 106.660172], 13); // Example: HCMUT location

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 100000,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([10.762622, 106.660172]).addTo(map)
        .bindPopup("We're here!", {
            className: 'custom-popup' // Add this line
        })
        .openPopup();
</script>