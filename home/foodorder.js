
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', async (event) => {
            const foodId = event.target.dataset.foodId;
            const foodName = event.target.dataset.foodName;
            const foodPrice = event.target.dataset.foodPrice;
            
            try {
                const response = await fetch('../api/add_to_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ food_id: foodId, quantity: 1, price: foodPrice }),
                });

                const data = await response.json();

                if (data.success) {
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                } else {
                    alert(`Failed to add ${foodName} to cart: ${data.message}`);
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                alert('There was an error adding to cart. Please try again.');
            }
        });
    });

    async function updateCartCount() {
        try {
            const response = await fetch('../api/get_cart_items.php');
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