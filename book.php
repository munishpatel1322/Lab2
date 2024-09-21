<?php
class Book {
    private $title;
    private $author;
    private $year;

    // Constructor to initialize the book object
    public function __construct($title, $author, $year) {
        if (empty($title) || empty($author) || empty($year)) {
            throw new Exception("All fields are required.");
        }
        if (!is_numeric($year) || $year < 0) {
            throw new Exception("Invalid year.");
        }

        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    // Getters for each attribute
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getYear() {
        return $this->year;
    }

    // Static method to display all books in a table
    public static function displayBooks($books) {
        if (empty($books)) {
            echo "<p>No books have been added yet.</p>";
        } else {
            echo "<table border='1'>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                    </tr>";
            foreach ($books as $book) {
                echo "<tr>
                        <td>" . htmlspecialchars($book->getTitle()) . "</td>
                        <td>" . htmlspecialchars($book->getAuthor()) . "</td>
                        <td>" . htmlspecialchars($book->getYear()) . "</td>
                      </tr>";
            }
            echo "</table>";
        }
    }
}
?>
