CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(100) NOT NULL,
    admin_email VARCHAR(100) NOT NULL,
    admin_password VARCHAR(255) NOT NULL,
    admin_contact_no VARCHAR(20),
    admin_image VARCHAR(255) -- Path to the profile image
);
-- users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact_no VARCHAR(20),
    role ENUM('tenant', 'owner') NOT NULL, -- Defines whether user is a tenant or owner
    profile_image VARCHAR(255) -- Path to the profile image
);

-- properties 
CREATE TABLE properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Foreign key to users table (for owners)
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    location VARCHAR(255),
    type ENUM('villa', 'apartment', 'house', 'commercial'),
    property_images VARCHAR(255), -- Path to property images
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
-- bookings
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Foreign key to users table (for tenants)
    property_id INT, -- Foreign key to properties table
    booking_date DATE NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES properties(property_id) ON DELETE CASCADE
);
-- wishlist
CREATE TABLE wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Foreign key to users table (for tenants)
    property_id INT, -- Foreign key to properties table
    added_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES properties(property_id) ON DELETE CASCADE
);

-- payments
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Foreign key to users table
    property_id INT, -- Foreign key to properties table
    amount DECIMAL(10, 2),
    payment_method VARCHAR(50), -- E.g., credit card, PayPal, etc.
    payment_date DATE,
    status ENUM('done', 'pending', 'processing') DEFAULT 'pending',
    transaction_id VARCHAR(100),
    booking_id INT, -- Foreign key to bookings table
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES properties(property_id) ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE
);

-- admin_actions
CREATE TABLE admin_actions (
    action_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT, -- Foreign key to admins table
    action_type VARCHAR(50), -- E.g., 'Add Property', 'Update Payment'
    description TEXT,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admins(admin_id) ON DELETE CASCADE
);
