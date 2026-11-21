<?php
require_once("model/Model.php");

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $book = $this->model->getBookById((int) $_GET['id']);
            include 'view/viewbook.php';
        } else {
            $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : "";
            $books = $this->model->getBooks($searchQuery);
            include 'view/booklist.php';
        }
    }
}
?>