document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    
    setInterval(nextSlide, 5000);
    const hamburger = document.querySelector('.hamburger-menu');
    const dropdown = document.querySelector('.dropdown-menu');
    
    hamburger.addEventListener('click', function() {
        this.classList.toggle('active');
        dropdown.classList.toggle('active');
    });
    
    document.addEventListener('click', function(event) {
        if (!hamburger.contains(event.target) && !dropdown.contains(event.target)) {
            hamburger.classList.remove('active');
            dropdown.classList.remove('active');
        }
    });

    function createParticles() {
        const container = document.getElementById('particles');
        if (!container) return;
        const particleCount = 30;
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            const size = Math.random() * 20 + 5;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDuration = `${duration}s`;
            particle.style.animationDelay = `${delay}s`;
            container.appendChild(particle);
        }
    }
    
    createParticles();
    
    function animateOnScroll() {
        const elements = document.querySelectorAll('.coupon-card, .restaurant-card, .step-card');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (elementTop < windowHeight - 100) {
                element.classList.add('animate');
            }
        });
    }
    
    
    const orderNowButtons = document.querySelectorAll('.order-now-btn');
    orderNowButtons.forEach(button => {
        button.addEventListener('click', function() {
            const restaurantId = this.dataset.restaurantId;
            if (restaurantId) {
                window.location.href = `foodorder.php?restaurant_id=${restaurantId}`;
            } else {
                console.error('Restaurant ID not found.');
            }
        });
    });

    async function updateCartCount() {
        try {
            const response = await fetch('api/get_cart_items.php');
            const data = await response.json();
            if (data.success) {
                const totalItems = data.data.reduce((acc, item) => acc + item.quantity, 0);
                document.getElementById('cart-count').textContent = totalItems;
            } else {
                console.error('Failed to fetch cart count:', data.message);
                document.getElementById('cart-count').textContent = 0;
            }
        } catch (error) {
            console.error('Error fetching cart count:', error);
            document.getElementById('cart-count').textContent = 0;
        }
    }

    updateCartCount(); 
});