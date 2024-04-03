<!--
Nama: Silvia Nur Baiti
NPM: 21552011400
Kelas: TIF RP 221 PA
Pemrograman Web 2 - Semester 6
-->

<?php

// fungsi inheritance (kelas induk)
class Book {
    protected $title;
    protected $author;
    protected $year;
    protected $status;

    // Constructor
    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = 'available';
    }

    // Encapsulation
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getYear() {
        return $this->year;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Polymorphism (override)
    public function printDetails() {
        echo "Judul: " . $this->title . "\n";
        echo "Penulis: " . $this->author . "\n";
        echo "Tahun Terbit: " . $this->year . "\n";
        echo "Status: " . $this->status . "\n";
    }
}

// fungsi inheritance (kelas turunan)
class Library {
    private static $books = [];

    // Static method
    public static function addBook(Book $book) {
        self::$books[] = $book;
    }

    // Encapsulation
    public static function getBooks() {
        return self::$books;
    }

    // Polymorphism (override)
    public static function printBooks() {
        foreach (self::$books as $book) {
            $book->printDetails();
            echo "\n";
        }
    }
}

// menambah buku baru
$book1 = new Book("Harry Potter And Orde Phoenix", "J.K. Rowling", 2017);
$book2 = new Book("The Principles Of Power", "Dion Yulianto", 2023);
$book3 = new Book("Atomic Habits", "James Clear", 2020);
$book4 = new Book("Is It Bad or Good Habits", "Sabrina Ara", 2021);
$book5 = new Book("Bilal Bin Rabah", "Ana P Dewiyana", 2020);

Library::addBook($book1);
Library::addBook($book2);
Library::addBook($book3);
Library::addBook($book4);
Library::addBook($book5);

// status ketersediaan buku
$book1->setStatus('borrowed');
$book2->setStatus('available');
$book2->setStatus('available');
$book2->setStatus('borrowed');
$book2->setStatus('borrrowed');

// mencetak daftar buku yang tersedia
echo "Daftar Buku Perpustakaan Saat Ini:\n";
Library::printBooks();

?>
