<?php
require_once("Author.php");

class Book
{
    private $id;
    private $title;
    private $description;
    private $publishYear;
    private $pages;
    private $coverPhoto;
    private $author;

    public function __construct($id, $title, $description, $publishYear, $pages, $coverPhoto, Author $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishYear = $publishYear;
        $this->pages = $pages;
        $this->coverPhoto = $coverPhoto;
        $this->author = $author;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPublishYear()
    {
        return $this->publishYear;
    }
    public function getPages()
    {
        return $this->pages;
    }
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }
    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setPublishYear($publishYear)
    {
        $this->publishYear = $publishYear;
    }
    public function setPages($pages)
    {
        $this->pages = $pages;
    }
    public function setCoverPhoto($coverPhoto)
    {
        $this->coverPhoto = $coverPhoto;
    }
    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    public function getShortDescription($limit = 60)
    {
        if (mb_strlen($this->description, 'UTF-8') <= $limit) {
            return $this->description;
        }
        return mb_substr($this->description, 0, $limit, 'UTF-8') . '...';
    }
}
?>