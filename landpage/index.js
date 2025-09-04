document.addEventListener('DOMContentLoaded', function() {
    // Background Slider
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    
    setInterval(nextSlide, 5000);
    
    // Headline Rotator
    const headlines = document.querySelectorAll('.headline');
    let currentHeadline = 0;
    
    function rotateHeadlines() {
        headlines[currentHeadline].classList.remove('active');
        currentHeadline = (currentHeadline + 1) % headlines.length;
        headlines[currentHeadline].classList.add('active');
    }
    
    setInterval(rotateHeadlines, 4000);
    
    // Hamburger Menu Toggle
    const hamburger = document.querySelector('.hamburger-menu');
    const dropdown = document.querySelector('.dropdown-menu');
    
    hamburger.addEventListener('click', function() {
        this.classList.toggle('active');
        dropdown.classList.toggle('active');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!hamburger.contains(event.target) && !dropdown.contains(event.target)) {
            hamburger.classList.remove('active');
            dropdown.classList.remove('active');
        }
    });
    // Search Functionality
    const searchButton = document.querySelector('.search-btn');
    const searchInput = document.querySelector('.search-container input');

    searchButton.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query) {
            // Redirect to the search results page with the query in the URL
            window.location.href = `../landpage/search_results.php?q=${encodeURIComponent(query)}`;
        }
    });
    
    // Infinite horizontal scrolling for restaurants
    const restaurantGrid = document.querySelector('.restaurant-grid');
    const restaurantCards = document.querySelectorAll('.restaurant-card');
    
    // Double the cards for seamless looping
    restaurantGrid.innerHTML = restaurantGrid.innerHTML + restaurantGrid.innerHTML;
    
    // Adjust animation duration based on number of cards
    const cardCount = restaurantCards.length;
    const duration = cardCount * 17; // 3 seconds per card
    
    // Apply the animation dynamically
    restaurantGrid.style.animation = `scrollRestaurants ${duration}s linear infinite`;
    
});