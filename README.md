
# FamLink

## Description

FamLink is a PHP-based application tailored for simplified family management within church communities. It offers intuitive features for registering new families, adding family members, and updating their sacramental information.

## Features

### Family Registration
- Users can register new families using unique registration numbers.

### Family Member Registration and Updating
- **Personal Information Entry:** Users can input full names, dates of birth, select relations, and specify alive statuses.
- **Sacramental Information:** Users can record sacramental dates such as baptism, holy communion, and confirmation.
- **Data Submission:** The "Add" button submits entered information securely.

### Navigation
- A user-friendly interface includes a "Main Menu" button for easy navigation back to the primary app menu.

## Installation

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/yourusername/FamLink.git
   ```

2. Set up a PHP server environment (e.g., XAMPP, WAMP).

3. Import the SQL database file provided:
   - Open phpMyAdmin or your preferred database management tool.
   - Create a new database (e.g., `famlink_db`).
   - Import the SQL file (`famlink_db.sql`) located in the repository.

4. Configure the database connection in the appropriate PHP files:
   - Update the database configuration in `config.php` (or similar file) with your database credentials:
     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "famlink_db";
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

5. Access the application through your web browser:
   - Open your browser and navigate to `http://localhost/FamLink`.

## Usage

1. Navigate to the application URL in your web browser.

2. Register new families using the provided registration numbers.

3. Add family members by entering their personal and sacramental information.

4. Update family member information as necessary.

5. Utilize the "Main Menu" button for seamless navigation within the app.

## Contributing

Contributions to FamLink are welcome! Please fork the repository, make your changes, and submit a pull request with a clear description of your enhancements.

## Credits

FamLink is developed and maintained by Shenal Senarathne.

## License

This project is licensed under the Apache License. See the LICENSE file for details.
