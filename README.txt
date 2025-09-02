# Sri-dish-Webapp-Food-ordering-system-

                                                           ==== WELCOME TO SRI DISH ====
                        - users with local restaurants, enabling them to easily browse menus, place orders, and track their deliveries-

Installation and Setup:

------>1. Local Server Setup (XAMPP/WAMP)
	*Start Your Server: Open your XAMPP control panel and start the Apache and MySQL services. They should both show a green status.
	*Find Your Project Folder: Navigate to your web server's root directory:
	*XAMPP: C:\xampp\htdocs\

------>2. Database Setup
	*Open phpMyAdmin: In your browser, go to http://localhost/phpmyadmin/.
	*Create Database: In the left-hand menu, click "New" to create a new database. Name it sri_dish_db and click 	"Create."
	*Import the SQL File:(sri_dish_db.sql)
	*Click on your new sri_dish_db database in the left menu.
	*Click the "Import" tab at the top.
	*Click "Choose File" and select your sri_dish_db_final.sql file.
	 Scroll to the bottom and click "Go."

------>3. Configure Project Files
	*File Organization: Make sure your SRIDISH folder, containing all your project files, is placed inside 	htdocs.
	*Database Credentials: Open the file SRIDISH/api/db_connect.php. Change the DB_USER and DB_PASS to match your 	local server.
	*For XAMPP, this is typically DB_USER: 'root' and DB_PASS: ''.

------>4. Run the Project
	*Open in Browser: In your browser's address bar, type the URL to your project's main page.
	*Go to: http://localhost/SRIDISH/
	*Log In: The site will redirect you to the login page. Use the sample credentials:
	 Email: admin@gmail.com
	 Password: admin123
							Done!!

Project Features:

	● User Authentication & Security: 
		├──Includes a secure login and session management system. Users are required to log in to access the main site.
	● Dynamic Homepage: 
		├──A visually engaging landing page with an animated background, sliding headlines, and a responsive layout.
	● Restaurant & Menu Browse: 
		├──Users can view a categorized list of popular restaurants and click on a card to see a detailed menu of food items.
	● Interactive Shopping Cart: 
		├──Features a fully functional cart that allows users to add food items, update quantities, and remove items dynamically without page reloads.
	● Secure Checkout: 
		├──A multi-step checkout process with a form for delivery details and simulated payment options (credit card, cash on delivery, Crypto) to finalize the order.
	● Order History: 
		├──A dedicated "My Orders" page where logged-in users can view a list of their past orders, including details and status.
	● Business Partnership Applications: 
		├──Provides dedicated application forms for:
	● Restaurant Partners: 
		├──Allows restaurant owners to submit an application to list their business.
	● Delivery Riders: 
		├──Allows individuals to apply to become a delivery partner.
	● Business Growth: 
		├──A form for existing partners to request business and marketing support.
	● Clean and Responsive UI: 
		├──The website is built with a modern, clean design that adapts to various screen sizes, from desktop to mobile.



### Copyright and License

Copyright (c) 2025 Sri Dish PVT LTD. All rights reserved.

