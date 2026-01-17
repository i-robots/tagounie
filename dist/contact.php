<?php
    // Enable error reporting during development
    ini_set('display_errors', 1); // Show errors
    ini_set('display_startup_errors', 1); // Show errors during PHP startup
    error_reporting(E_ALL); // Report all PHP errors

    try {
        // Helper: detect whether the client expects JSON (AJAX / fetch)
        function wantsJson(): bool {
            $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
            $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';
            return (stripos($accept, 'application/json') !== false) || (strtolower($xhr) === 'xmlhttprequest');
        }

        // Helper: send response as JSON for fetch/ajax, otherwise return HTML blocks
        function sendResponse($success, $message) {
            if (wantsJson()) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => (bool)$success, 'message' => $message]);
                return;
            }

            if ($success) {
                echo '<div class="success-message w-form-done" tabindex="-1" role="region" aria-label="Homepage form success"><br /><div class="paragraph-18">' . htmlspecialchars($message) . '</div><br /></div>';
            } else {
                echo '<div class="error-message w-form-fail" tabindex="-1" role="region" aria-label="Homepage form failure"><br /><div>' . htmlspecialchars($message) . '</div><br /></div>';
            }
        }

        // Database connection settings
        $host = "localhost";
        $username = "kuuvguhztx_tangounitegww_db";
        $password = "uhkK2EnWZSMx59wbSCx6"; // Replace with your database password if needed
        $database = "kuuvguhztx_tangounitegww_db";

        // Connect to the database
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sanitize user input to prevent SQL injection
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $message = $conn->real_escape_string($_POST['message']);

            // Validate required fields
            if (empty($name) || empty($email)) {
                echo "Name and email fields are required.";
                exit;
            }

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $name, $email, $message); // 'sss' represents three string parameters

            if ($stmt->execute()) {
                // Success message (use JSON for fetch/ajax)
                sendResponse(true, 'Thank you for contacting us. One of our associates will return your message promptly.');
            } else {
                // Failure message
                $err = 'Oops! Something went wrong while submitting the form.';
                // Include DB error in message when in development (error_reporting is enabled above)
                $errDetail = $stmt->error ? ' DB: ' . $stmt->error : '';
                sendResponse(false, $err . $errDetail);
            }

            // Close the prepared statement
            $stmt->close();
        }
    } catch (Exception $e) {
        // Handle database connection errors
        sendResponse(false, 'Database Error: ' . $e->getMessage());
    } finally {
        // Close the database connection
        if ($conn) {
            $conn->close();
        }
    }
?>
