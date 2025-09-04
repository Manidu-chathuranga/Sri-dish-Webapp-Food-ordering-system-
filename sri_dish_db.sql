

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `business_applications`;
DROP TABLE IF EXISTS `rider_applications`;
DROP TABLE IF EXISTS `restaurant_applications`;
DROP TABLE IF EXISTS `order_details`;
DROP TABLE IF EXISTS `cart_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `foods`;
DROP TABLE IF EXISTS `restaurants`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `cities`;

CREATE TABLE `business_applications` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `current_sales_revenue` decimal(10,2) DEFAULT NULL,
  `marketing_goals` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','reviewed','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `cart_items`


CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_at_time` decimal(10,2) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `foods`

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping data for table `foods`

INSERT INTO `foods` (`id`, `restaurant_id`, `name`, `description`, `price`, `image_url`, `category`) VALUES
(101, 1, 'Chicken Kottu', 'Shredded flatbread, chicken, vegetables, and spices, chopped on a hot griddle.', 850.00, '../assets/images/food/chicken-kottu.jpg', 'Kottu'),
(102, 1, 'Pol Roti & Lunumiris', 'Traditional coconut flatbread with spicy onion sambol.', 450.00, '../assets/images/food/pol-roti.jpg', 'Sri Lankan'),
(103, 1, 'Fish Ambul Thiyal', 'Sour fish curry, a signature Sri Lankan dish, served with rice.', 950.00, '../assets/images/food/fish-ambul.jpg', 'Curry'),
(104, 1, 'String Hoppers with Kiri Hodi', 'Steamed rice flour noodles served with a creamy coconut gravy.', 650.00, '../assets/images/food/string-hoppers.jpg', 'Sri Lankan'),
(105, 1, 'Jaffna Crab Curry', 'Fiery crab curry made with authentic Jaffna spices and coconut milk.', 1500.00, '../assets/images/food/jaffna-crab.jpg', 'Curry'),
(106, 1, 'Watalappan', 'A sweet pudding made from coconut milk, jaggery, cashew nuts, and spices.', 400.00, '../assets/images/food/watalappan.jpg', 'Dessert'),
(201, 2, 'Cheese Kottu', 'Kottu with a generous layer of melted cheese.', 950.00, '../assets/images/food/cheese-kottu.jpg', 'Kottu'),
(202, 2, 'Vegetable Kottu', 'Mixed vegetables chopped and stir-fried with flatbread.', 600.00, '../assets/images/food/veg-kottu.jpg', 'Kottu'),
(203, 2, 'Dolphin Kottu', 'A special mix of kottu with chicken, cheese, and egg.', 1200.00, '../assets/images/food/dolphin-kottu.jpg', 'Kottu'),
(204, 2, 'Pol Sambol Kottu', 'Kottu with a unique flavor from fresh coconut sambol.', 800.00, '../assets/images/food/pol-sambol-kottu.jpg', 'Kottu'),
(301, 3, 'Plain Hoppers', 'Crispy, bowl-shaped pancakes made from fermented rice flour.', 200.00, '../assets/images/food/plain-hoppers.jpg', 'Hoppers'),
(302, 3, 'Egg Hopper', 'A plain hopper with a fried egg cooked into the center.', 250.00, '../assets/images/food/egg-hopper.jpg', 'Hoppers'),
(303, 3, 'String Hoppers', 'Steamed rice flour noodles served with curry.', 300.00, '../assets/images/food/string-hoppers.jpg', 'Hoppers'),
(304, 3, 'Seafood String Hopper Biryani', 'Layered with spiced rice, seafood, and vegetables.', 850.00, '../assets/images/food/seafood-hopper-biryani.jpg', 'Biryani'),
(305, 3, 'Milk Hopper with Treacle', 'A sweet, soft hopper served with kithul treacle.', 350.00, '../assets/images/food/milk-hopper.jpg', 'Hoppers'),
(401, 4, 'Chicken Dominator Pizza', 'Loaded with spicy chicken, onions, and capsicum.', 1800.00, '../assets/images/food/pizza-dominator.jpg', 'Pizza'),
(402, 4, 'Garlic Bread', 'Toasted bread with garlic butter and herbs.', 400.00, '../assets/images/food/garlic-bread.jpg', 'Side'),
(403, 4, 'Veggie Supreme Pizza', 'Mushrooms, onions, peppers, and olives on a classic crust.', 1650.00, '../assets/images/food/veggie-supreme.jpg', 'Pizza'),
(404, 4, 'Spaghetti Bolognese', 'Pasta with a rich meat and tomato sauce.', 950.00, '../assets/images/food/spaghetti.jpg', 'Pasta'),
(501, 5, 'Whopper', 'Flame-grilled beef patty with fresh vegetables.', 1100.00, '../assets/images/food/whopper.jpg', 'Burger'),
(502, 5, 'Chicken Royale', 'Crispy chicken fillet with lettuce and mayo.', 950.00, '../assets/images/food/chicken-royale.jpg', 'Burger'),
(503, 5, 'King Fries', 'Crispy, golden French fries, perfectly salted.', 350.00, '../assets/images/food/king-fries.jpg', 'Side'),
(504, 5, 'Onion Rings', 'Crispy fried onion rings with a side of dipping sauce.', 450.00, '../assets/images/food/onion-rings.jpg', 'Side'),
(601, 6, 'California Roll', 'Crab meat, avocado, and cucumber.', 750.00, '../assets/images/food/california-roll.jpg', 'Sushi'),
(602, 6, 'Spicy Tuna Roll', 'Fresh tuna mixed with spicy sauce.', 850.00, '../assets/images/food/spicy-tuna-roll.jpg', 'Sushi'),
(603, 6, 'Salmon Sashimi', 'Thinly sliced fresh raw salmon.', 1200.00, '../assets/images/food/salmon-sashimi.jpg', 'Sashimi'),
(604, 6, 'Dragon Roll', 'Eel and cucumber topped with avocado.', 1350.00, '../assets/images/food/dragon-roll.jpg', 'Sushi'),
(605, 6, 'Edamame', 'Steamed soybeans with sea salt.', 400.00, '../assets/images/food/edamame.jpg', 'Appetizer');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `status` enum('pending','completed','cancelled','delivering') NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `total_amount`, `payment_method`, `customer_name`, `customer_phone`, `customer_address`, `status`, `order_date`) VALUES
(1, 2, '3b5hrtugna8uu3sen12rrch4of', 2100.00, 'card', 'kaneera', '1234567984', 'asdasa', 'pending', '2025-08-09 16:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_item` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `food_id`, `quantity`, `price_per_item`) VALUES
(1, 1, 301, 1, 200.00),
(2, 1, 302, 1, 250.00),
(3, 1, 303, 1, 300.00),
(4, 1, 304, 1, 850.00),
(5, 1, 305, 1, 350.00);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT 0.0,
  `delivery_time_min` int(11) DEFAULT NULL,
  `delivery_time_max` int(11) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `address`, `description`, `image_url`, `rating`, `delivery_time_min`, `delivery_time_max`, `is_popular`) VALUES
(1, 'Spice Garden', '123 Galle Road, Colombo 03', 'Experience authentic Sri Lankan cuisine with a modern twist.', 'assets/images/restaurants/spice-garden.jpg', 4.6, 30, 45, 1),
(2, 'The Kottu Shop', '45 Main Street, Nugegoda', 'Serving the most popular and delicious kottu varieties.', 'assets/images/restaurants/kottu-shop.jpg', 4.9, 20, 35, 1),
(3, 'Hoppers House', '789 Kandy Road, Kandy', 'A dedicated restaurant for all your hopper cravings.', 'assets/images/restaurants/hoppers-house.jpg', 4.5, 25, 40, 0),
(4, 'Pizza Hut', '10 Main Street, Colombo 05', 'World-famous pizzas, pastas, and sides.', 'assets/images/restaurants/pizza-hut.jpg', 4.2, 30, 45, 1),
(5, 'Burger King', '15 High-Level Road, Battaramulla', 'Home of the Whopper and delicious fast-food classics.', 'assets/images/restaurants/burger-king.jpg', 4.3, 20, 35, 1),
(6, 'Sushi Palace', '20 Park Street, Colombo 07', 'Fresh and authentic Japanese sushi and sashimi.', 'assets/images/restaurants/sushi-palace.jpg', 4.8, 40, 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_applications`
--

CREATE TABLE `restaurant_applications` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `restaurant_address` text NOT NULL,
  `description` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','reviewed','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rider_applications`
--

CREATE TABLE `rider_applications` (
  `id` int(11) NOT NULL,
  `rider_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','reviewed','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'testuser', 'test@example.com', 'password123', '2025-08-09 16:10:44'),
(2, 'admin', 'admin@gmail.com', '$2y$10$QYnktSnd60QeczR8vM6YyOecHe/VyfwZTfe.C8NX/w6cOnPJ3JIeq', '2025-08-09 16:11:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_applications`
--
ALTER TABLE `business_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_applications`
--
ALTER TABLE `restaurant_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider_applications`
--
ALTER TABLE `rider_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_applications`
--
ALTER TABLE `business_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant_applications`
--
ALTER TABLE `restaurant_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rider_applications`
--
ALTER TABLE `rider_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_food_id` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `fk_foods_restaurant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_food_id` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `fk_order_details_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

