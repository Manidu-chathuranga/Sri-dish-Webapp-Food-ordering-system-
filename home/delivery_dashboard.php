<?php
session_start();
$username = $_SESSION['username'] ?? 'Delivery Staff';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Dashboard</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        main {
            padding-top: 100px;
            min-height: calc(100vh - 150px);
        }
        .dashboard-section {
            max-width: 900px;
            margin: 50px auto;
            padding: 2rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        .order-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
        }
        .order-info {
            text-align: left;
        }
        .order-info h4 {
            font-size: 1.2rem;
            color: var(--primary-color);
        }
        .order-actions button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-weight: 600;
        }
        .action-start { background-color: #2196F3; }
        .action-complete { background-color: #4CAF50; }
        .action-start:hover { background-color: #0b7dda; }
        .action-complete:hover { background-color: #43a047; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <h1 class="logo">Sri Dish</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="logout.php" class="login-btn">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="dashboard-section">
            <h2 class="section-title">Delivery Dashboard</h2>
            <p>Here are the orders waiting to be delivered.</p>
            <div id="order-list">
                <p>Loading accepted orders...</p>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const orderList = document.getElementById('order-list');

            async function fetchAcceptedOrders() {
                try {
                    const response = await fetch('../api/get_orders.php');
                    const data = await response.json();
                    
                    orderList.innerHTML = '';
                    if (data.success && data.data.length > 0) {
                        const acceptedOrders = data.data.filter(order => order.status === 'accepted');
                        if (acceptedOrders.length > 0) {
                            acceptedOrders.forEach(order => {
                                const orderHtml = `
                                    <div class="order-card">
                                        <div class="order-info">
                                            <h4>Order ID: ${order.order_id}</h4>
                                            <p>Customer: ${order.customer_name}</p>
                                            <p>Address: ${order.customer_address}</p>
                                        </div>
                                        <div class="order-actions">
                                            <button class="action-start" onclick="updateOrderStatus(${order.order_id}, 'delivering')">Start Delivery</button>
                                        </div>
                                    </div>
                                `;
                                orderList.insertAdjacentHTML('beforeend', orderHtml);
                            });
                        } else {
                             orderList.innerHTML = '<p>No accepted orders at this time.</p>';
                        }
                    } else {
                        orderList.innerHTML = '<p>No orders to display.</p>';
                    }
                } catch (error) {
                    console.error('Error fetching orders:', error);
                    orderList.innerHTML = '<p>Failed to load orders. Please try again.</p>';
                }
            }

            async function updateOrderStatus(orderId, status) {
                let apiEndpoint = '';
                if (status === 'delivering') {
                    apiEndpoint = '../api/start_delivery.php';
                } else if (status === 'completed') {
                    apiEndpoint = '../api/complete_delivery.php';
                } else {
                    alert('Invalid status update.');
                    return;
                }

                try {
                    const response = await fetch(apiEndpoint, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ order_id: orderId })
                    });
                    const data = await response.json();
                    if (data.success) {
                        alert(data.message);
                        fetchAcceptedOrders();
                    } else {
                        alert(`Failed to update order: ${data.message}`);
                    }
                } catch (error) {
                    console.error('Error updating order status:', error);
                    alert('An error occurred. Please try again.');
                }
            }

            fetchAcceptedOrders();
        });
    </script>
</body>
</html>