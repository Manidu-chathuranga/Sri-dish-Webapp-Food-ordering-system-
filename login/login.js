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
    
    // Welcome Message Rotator
    const messages = document.querySelectorAll('.message-text');
    let currentMessage = 0;
    
    function rotateMessages() {
        messages[currentMessage].classList.remove('active');
        currentMessage = (currentMessage + 1) % messages.length;
        messages[currentMessage].classList.add('active');
    }
    
    messages[0].classList.add('active');
    setInterval(rotateMessages, 3000);
    
    // Form validation
    const loginForm = document.querySelector('.login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            if (username.value.trim() === '') {
                e.preventDefault();
                showError(username, 'Username is required');
            }
            
            if (password.value.trim() === '') {
                e.preventDefault();
                showError(password, 'Password is required');
            }
        });
    }
    
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        let errorElement = formGroup.querySelector('.error-text');
        
        if (!errorElement) {
            errorElement = document.createElement('small');
            errorElement.className = 'error-text';
            formGroup.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
        input.style.borderColor = '#e74c3c';
        
        setTimeout(() => {
            errorElement.textContent = '';
            input.style.borderColor = '#FFD1D1';
        }, 3000);
    }
    
    // Social login buttons
    const socialButtons = document.querySelectorAll('.social-btn');
    socialButtons.forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.classList.contains('google') ? 'Google' : 
                           this.classList.contains('facebook') ? 'Facebook' : 'Apple';
                           
            alert(`Continue with ${platform} would be implemented here`);
        });
    });
});