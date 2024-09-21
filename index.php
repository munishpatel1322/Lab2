<?php
// Include the Book class
require 'Book.php';

// Start session to store books
session_start();

// Initialize an array to store books if it doesn't exist in session
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

$error = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $year = $_POST['year'] ?? '';

    // Attempt to create a new Book object and catch any exceptions
    try {
        $book = new Book($title, $author, $year);
        $_SESSION['books'][] = $book; // Add the book to the session array
    } catch (Exception $e) {
        $error = $e->getMessage(); // Capture the error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management System</title>
</head>
<body>
    <h1>Book Management System</h1>

    <!-- Display error message if something goes wrong -->
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Book entry form -->
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>"><br><br>

        <label>Author:</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($author ?? ''); ?>"><br><br>

        <label>Year:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year ?? ''); ?>"><br><br>

        <button type="submit">Add Book</button>
    </form>

    <h2>List of Books</h2>

    <!-- Call the static method to display books -->
    <?php Book::displayBooks($_SESSION['books']); ?>
</body>
</html>
