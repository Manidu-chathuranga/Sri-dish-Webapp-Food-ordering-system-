
document.addEventListener('DOMContentLoaded', async () => {
    const ordersContainer = document.getElementById('orders-container');

    async function fetchMyOrders() {
        try {
            const response = await fetch('../api/get_orders.php');
            const data = await response.json();

            if (data.success && data.data.length > 0) {
                ordersContainer.innerHTML = ''; 
                data.data.forEach(order => {
                    const orderHtml = `
                        <div class="order-card">
                            <h4>Order ID: ${order.order_id} 
                                <span class="order-status status-${order.status}">${order.status.charAt(0).toUpperCase() + order.status.slice(1)}</span>
                            </h4>
                            <p>Order Date: ${new Date(order.order_date).toLocaleString()}</p>
                            <p>Total Amount: LKR ${order.total_amount}</p>
                            <div class="order-details">
                                <ul class="order-details-list">
                                    ${order.items.map(item => `<li>${item.food_name} x ${item.quantity} (LKR ${item.price_per_item})</li>`).join('')}
                                </ul>
                            </div>
                        </div>
                    `;
                    ordersContainer.insertAdjacentHTML('beforeend', orderHtml);
                });
            } else {
                ordersContainer.innerHTML = '<p class="empty-orders-message">You haven\'t placed any orders yet.</p>';
            }
        } catch (error) {
            console.error('Error fetching orders:', error);
            ordersContainer.innerHTML = '<p class="empty-orders-message">Failed to load orders. Please try again later.</p>';
        }
    }

    fetchMyOrders();
});