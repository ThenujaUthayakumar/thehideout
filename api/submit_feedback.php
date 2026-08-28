<?php
/**
 * The Hide Out Cafe — Submit Feedback / Contact API
 * Handles both review submissions and contact form inquiries.
 */
require_once __DIR__ . '/../config/functions.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Session-based rate limiting
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rateLimitKey = 'feedback_last_submit';
$cooldown = 60; // seconds
if (!empty($_SESSION[$rateLimitKey]) && (time() - $_SESSION[$rateLimitKey]) < $cooldown) {
    $remaining = $cooldown - (time() - $_SESSION[$rateLimitKey]);
    echo json_encode(['success' => false, 'message' => "Please wait {$remaining} seconds before submitting again."]);
    exit;
}

// Determine type: 'review' or 'inquiry'
$type = sanitize($_POST['type'] ?? 'review');
if (!in_array($type, ['review', 'inquiry'])) {
    $type = 'review';
}

// Validate inputs
$name    = sanitize($_POST['name'] ?? '');
$email   = sanitize($_POST['email'] ?? '');
$message = sanitize($_POST['message'] ?? '');
$rating  = (int)($_POST['rating'] ?? 5);
$subject = sanitize($_POST['subject'] ?? '');

$errors = [];

if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Please enter your name (at least 2 characters).';
}
if (strlen($name) > 100) {
    $errors[] = 'Name must be 100 characters or less.';
}
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Please write a message (at least 10 characters).';
}
if (strlen($message) > 2000) {
    $errors[] = 'Message must be 2000 characters or less.';
}

if ($type === 'review') {
    if ($rating < 1 || $rating > 5) {
        $errors[] = 'Rating must be between 1 and 5.';
    }
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Insert into database
try {
    db()->query(
        "INSERT INTO website_feedback (name, email, rating, message, type, subject, is_approved, created_at)
         VALUES (:name, :email, :rating, :message, :type, :subject, 0, NOW())",
        [
            ':name'    => $name,
            ':email'   => $email ?: null,
            ':rating'  => $type === 'review' ? $rating : 0,
            ':message' => $message,
            ':type'    => $type,
            ':subject' => $subject ?: null
        ]
    );

    // Set rate limit
    $_SESSION[$rateLimitKey] = time();

    $successMsg = $type === 'review'
        ? 'Thank you for your review! It will appear after approval.'
        : 'Your message has been sent! We\'ll get back to you soon.';

    echo json_encode(['success' => true, 'message' => $successMsg]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again later.']);
}
