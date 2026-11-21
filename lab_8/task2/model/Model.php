<?php
require_once("Author.php");
require_once("Book.php");

class Model
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'library_mvc');
        if ($this->db->connect_error) {
            die("Помилка підключення до БД: " . $this->db->connect_error);
        }
        $this->db->set_charset("utf8mb4");
    }

    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }

    public function getBooks($searchQuery = "")
    {
        $sql = "SELECT b.id AS book_id, b.title, b.description, b.publish_year, b.pages, b.cover_photo,
                       a.id AS author_id, a.last_name, a.first_name, a.country
                FROM books b
                JOIN authors a ON b.author_id = a.id";

        if (!empty($searchQuery)) {
            $sql .= " WHERE b.title LIKE ? OR a.last_name LIKE ? OR a.first_name LIKE ? OR CONCAT(a.first_name, ' ', a.last_name) LIKE ?";
            $stmt = $this->db->prepare($sql);
            $like = "%" . $searchQuery . "%";
            $stmt->bind_param("ssss", $like, $like, $like, $like);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $this->db->query($sql);
        }

        $books = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $author = new Author(
                    $row['author_id'],
                    $row['last_name'],
                    $row['first_name'],
                    $row['country']
                );
                $books[] = new Book(
                    $row['book_id'],
                    $row['title'],
                    $row['description'],
                    $row['publish_year'],
                    $row['pages'],
                    $row['cover_photo'],
                    $author
                );
            }
        }
        return $books;
    }

    public function getBookById($id)
    {
        $sql = "SELECT b.id AS book_id, b.title, b.description, b.publish_year, b.pages, b.cover_photo,
                       a.id AS author_id, a.last_name, a.first_name, a.country
                FROM books b
                JOIN authors a ON b.author_id = a.id
                WHERE b.id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $author = new Author(
                $row['author_id'],
                $row['last_name'],
                $row['first_name'],
                $row['country']
            );
            return new Book(
                $row['book_id'],
                $row['title'],
                $row['description'],
                $row['publish_year'],
                $row['pages'],
                $row['cover_photo'],
                $author
            );
        }
        return null;
    }

    public function getAllAuthors()
    {
        $result = $this->db->query("SELECT id, last_name, first_name, country FROM authors");
        $authors = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $authors[] = new Author($row['id'], $row['last_name'], $row['first_name'], $row['country']);
            }
        }
        return $authors;
    }

    public function addAuthor($lastName, $firstName, $country)
    {
        $stmt = $this->db->prepare("INSERT INTO authors (last_name, first_name, country) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $lastName, $firstName, $country);
        return $stmt->execute();
    }

    public function addBook($title, $description, $publishYear, $pages, $coverPhoto, $authorId)
    {
        $stmt = $this->db->prepare("INSERT INTO books (title, description, publish_year, pages, cover_photo, author_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiisi", $title, $description, $publishYear, $pages, $coverPhoto, $authorId);
        return $stmt->execute();
    }
}
?>