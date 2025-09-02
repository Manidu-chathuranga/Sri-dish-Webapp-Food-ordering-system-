
document.addEventListener('DOMContentLoaded', () => {
    const cartItemsList = document.getElementById('cart-items-list');
    const emptyCartPlaceholder = document.getElementById('empty-cart-placeholder');
    const cartSummarySection = document.getElementById('cart-summary-section');
    const subtotalAmount = document.getElementById('subtotal-amount');
    const totalAmount = document.getElementById('total-amount');
    const checkoutButton = document.getElementById('checkout-button');
    const deliveryFee = 150.00;

    async function fetchCartItems() {
        try {
            const response = await fetch('../api/get_cart_items.php');
            const data = await response.json();

            cartItemsList.innerHTML = '';
            let currentSubtotal = 0;

            if (data.success && data.data.length > 0) {
                data.data.forEach(item => {
                    const itemTotal = item.quantity * item.price_at_time;
                    currentSubtotal += itemTotal;

                    const cartItemHtml = `
                        <li class="cart-item" data-food-id="${item.food_id}">
                            <div class="cart-item-details">
                                <img src="${item.image_url || '../assets/images/food/placeholder.jpg'}" alt="${item.food_name}">
                                <div class="cart-item-info">
                                    <h3>${item.food_name}</h3>
                                </div>
                            </div>
                            <div class="cart-item-controls">
                                <button class="quantity-btn decrease-quantity" data-food-id="${item.food_id}">-</button>
                                <span class="cart-item-quantity-display">${item.quantity}</span>
                                <button class="quantity-btn increase-quantity" data-food-id="${item.food_id}">+</button>
                                <button class="remove-item-btn" data-food-id="${item.food_id}"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="cart-item-price">LKR ${itemTotal.toFixed(2)}</div>
                        </li>
                    `;
                    cartItemsList.insertAdjacentHTML('beforeend', cartItemHtml);
                });

                subtotalAmount.textContent = currentSubtotal.toFixed(2);
                totalAmount.textContent = (currentSubtotal + deliveryFee).toFixed(2);
                
                emptyCartPlaceholder.style.display = 'none';
                cartSummarySection.style.display = 'block';
                checkoutButton.style.display = 'block';

            } else {
                emptyCartPlaceholder.style.display = 'block';
                cartSummarySection.style.display = 'none';
                checkoutButton.style.display = 'none';
            }
            attachCartEventListeners();
        } catch (error) {
            console.error('Error fetching cart items:', error);
            alert('Could not load cart items. Please try again.');
        }
    }

    function attachCartEventListeners() {
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.onclick = () => updateCartItemQuantity(button.dataset.foodId, 1);
        });
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.onclick = () => updateCartItemQuantity(button.dataset.foodId, -1);
        });
        document.querySelectorAll('.remove-item-btn').forEach(button => {
            button.onclick = () => removeCartItem(button.dataset.foodId);
        });
    }

    async function updateCartItemQuantity(foodId, change) {
        try {
            const response = await fetch('../api/update_cart_quantity.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ food_id: foodId, change: change })
            });
            const data = await response.json();
            if (data.success) {
                fetchCartItems();
            } else {
                alert(`Error updating quantity: ${data.message}`);
            }
        } catch (error) {
            console.error('Error updating cart quantity:', error);
            alert('Failed to update quantity.');
        }
    }

    async function removeCartItem(foodId) {
        if (!confirm('Are you sure you want to remove this item?')) {
            return;
        }
        try {
            const response = await fetch('../api/remove_from_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ food_id: foodId })
            });
            const data = await response.json();
            if (data.success) {
                alert('Item removed from cart.');
                fetchCartItems();
            } else {
                alert(`Error removing item: ${data.message}`);
            }
        } catch (error) {
            console.error('Error removing item:', error);
            alert('Failed to remove item from cart.');
        }
    }

    checkoutButton.addEventListener('click', () => {
        window.location.href = 'checkout.php';
    });

    fetchCartItems();
});