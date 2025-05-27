<?php
session_start();
require 'db_connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize response
$response = ['success' => false, 'message' => ''];

// Verify database connection
if ($conn->connect_error) {
    $response['message'] = 'Database connection failed: ' . $conn->connect_error;
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data with proper sanitization
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $feedback_type = $_POST['feedback-type'] ?? '';
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $message = trim($_POST['message'] ?? '');
    $contact_permission = isset($_POST['contact-permission']) ? 1 : 0;
    $user_id = $_SESSION['user_id'] ?? null;

    // Debug received data
    error_log("Received feedback data: " . print_r($_POST, true));

    // Validate inputs
    $errors = [];
    
    if (empty($name)) $errors['name'] = 'Name is required';
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    if (empty($feedback_type)) $errors['type'] = 'Feedback type is required';
    if ($rating < 1 || $rating > 5) $errors['rating'] = 'Please provide a valid rating (1-5)';
    if (empty($message)) $errors['message'] = 'Message is required';

    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("INSERT INTO feedback 
                                  (user_id, name, email, feedback_type, rating, message, contact_permission) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }
            
            $stmt->bind_param("isssisi", $user_id, $name, $email, $feedback_type, $rating, $message, $contact_permission);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Thank you for your feedback!';
                error_log("Feedback submitted successfully for: $email");
            } else {
                throw new Exception("Execute failed: " . $stmt->error);
            }
            
            $stmt->close();
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            $response['message'] = 'Error submitting feedback. Please try again.';
            $response['error'] = $e->getMessage(); // For debugging
        }
    } else {
        $response['message'] = 'Please correct the following errors:';
        $response['errors'] = $errors;
    }
} else {
    $response['message'] = 'Invalid request method.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>