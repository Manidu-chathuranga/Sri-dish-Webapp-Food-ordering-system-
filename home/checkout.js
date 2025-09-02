document.addEventListener('DOMContentLoaded', async () => {
    const orderItemsList = document.getElementById('order-items-list');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryDelivery = document.getElementById('summary-delivery');
    const summaryTotal = document.getElementById('summary-total');
    const checkoutForm = document.getElementById('checkout-form');
    const paymentOptions = document.querySelector('.payment-options');
    const cardDetailsForm = document.getElementById('card-details-form');
    const cryptoDetailsForm = document.getElementById('crypto-details-form');
    const deliveryFee = 150.00;

    paymentOptions.addEventListener('change', (e) => {
        cardDetailsForm.style.display = 'none';
        cryptoDetailsForm.style.display = 'none';

        if (e.target.value === 'card') {
            cardDetailsForm.style.display = 'block';
        } else if (e.target.value === 'crypto') {
            cryptoDetailsForm.style.display = 'block';
        }
    });

    async function fetchOrderSummary() {
        try {
            const response = await fetch('../api/get_cart_items.php');
            const data = await response.json();

            orderItemsList.innerHTML = '';
            let currentSubtotal = 0;

            if (data.success && data.data.length > 0) {
                data.data.forEach(item => {
                    const itemTotal = item.quantity * item.price_at_time;
                    currentSubtotal += itemTotal;
                    const orderItemHtml = `
                        <div class="order-item">
                            <span>${item.food_name} x${item.quantity}</span>
                            <span>LKR ${itemTotal.toFixed(2)}</span>
                        </div>
                    `;
                    orderItemsList.insertAdjacentHTML('beforeend', orderItemHtml);
                });

                summarySubtotal.textContent = currentSubtotal.toFixed(2);
                summaryTotal.textContent = (currentSubtotal + deliveryFee).toFixed(2);
                summaryDelivery.textContent = deliveryFee.toFixed(2);
            } else {
                alert("Your cart is empty. Please add items before checking out.");
                window.location.href = 'cart.php';
            }
        } catch (error) {
            console.error('Error fetching order summary:', error);
        }
    }

    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(checkoutForm);
        const orderDetails = Object.fromEntries(formData.entries());

        if (orderDetails['payment_method'] === 'card') {
            const cardNumber = orderDetails['card-number'];
            if (cardNumber.length < 16) {
                alert("Please enter a valid card number.");
                return;
            }
        }
        
        try {
            const response = await fetch('../api/checkout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(orderDetails)
            });
            const data = await response.json();

            if (data.success) {
                if (orderDetails['payment_method'] === 'crypto') {
                    alert('Crypto Payment Simulated and Successful!');
                } else {
                    alert('Payment Successful!');
                }
                window.location.href = `order_confirmation.php?order_id=${data.order_id}`;
            } else {
                alert(`Checkout failed: ${data.message}`);
            }
        } catch (error) {
            console.error('Error during checkout:', error);
            alert('An error occurred during checkout. Please try again.');
        }
    });

    fetchOrderSummary();
});