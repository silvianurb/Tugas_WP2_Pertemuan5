<?php
class Book {
    protected $title;
    protected $author;
    protected $year;
    protected $status;
    protected $isbn;

    // Constructor: Menginisialisasi objek buku dengan judul, penulis, tahun terbit, dan nomor ISBN
    public function __construct($title, $author, $year, $isbn = null) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = 'available';
        $this->isbn = $isbn; // Inisialisasi properti ISBN
    }
  
    // Getter dan setter untuk properti-propertri buku
    // (Encapsulation: Menyembunyikan detail implementasi dari luar kelas)
  
    // Getter untuk mendapatkan judul buku
    public function getTitle() {
        return $this->title;
    }

    // Getter untuk mendapatkan penulis buku
    public function getAuthor() {
        return $this->author;
    }

    // Getter untuk mendapatkan tahun terbit buku
    public function getYear() {
        return $this->year;
    }

    // Getter untuk mendapatkan status buku
    public function getStatus() {
        return $this->status;
    }

    // Setter untuk mengatur status buku
    public function setStatus($status) {
        $this->status = $status;
    }

    // Getter untuk mendapatkan nomor ISBN buku
    public function getISBN() {
        return $this->isbn;
    }

    // Setter untuk mengatur nomor ISBN buku
    public function setISBN($isbn) {
        $this->isbn = $isbn;
    }
}

class ReferenceBook extends Book {
    protected $publisher;
  
    // Overriding: Mengimplementasikan kembali constructor dari kelas induk
    public function __construct($title, $author, $year, $isbn, $publisher) {
        parent::__construct($title, $author, $year, $isbn);
        $this->publisher = $publisher;
    }

    // Getter untuk mendapatkan penerbit buku
    public function getPublisher() {
        return $this->publisher;
    }
}

class Library {
    private static $books = [];
    private static $borrowedBooks = [];

    // Menambahkan buku ke perpustakaan
    public static function addBook(Book $book) {
        self::$books[] = $book;
    }

    // Meminjam buku dari perpustakaan
    public static function borrowBook(Book $book) {
        $bookId = spl_object_hash($book);
        if (!isset(self::$borrowedBooks[$bookId])) {
            self::$borrowedBooks[$bookId] = 0;
        }
        if (self::$borrowedBooks[$bookId] < 3) { // Batasan peminjaman
            self::$borrowedBooks[$bookId]++;
            $book->setStatus('borrowed');
            return true;
        }
        return false; // Jika sudah mencapai batasan peminjaman
    }

    // Mengembalikan buku yang dipinjam ke perpustakaan
    public static function returnBook(Book $book) {
        $bookId = spl_object_hash($book);
        if (isset(self::$borrowedBooks[$bookId])) {
            self::$borrowedBooks[$bookId]--;
            $book->setStatus('available');
        }
    }

    // Mendapatkan daftar semua buku di perpustakaan
    public static function getBooks() {
        return self::$books;
    }

    // Mengurutkan daftar buku berdasarkan tahun terbit
    public static function sortBooksByYear() {
        usort(self::$books, function($a, $b) {
            return $a->getYear() - $b->getYear();
        });
    }

    // Mengurutkan daftar buku berdasarkan penulis
    public static function sortBooksByAuthor() {
        usort(self::$books, function($a, $b) {
            return strcmp($a->getAuthor(), $b->getAuthor());
        });
    }

    // Menghapus buku dari perpustakaan
    public static function removeBook(Book $book) {
        $bookId = spl_object_hash($book);
        unset(self::$books[$bookId]);
    }

    // Menghitung denda keterlambatan pengembalian buku
    public static function calculateLateFine(Book $book, $returnDate) {
        // Ambil tanggal kembali dari buku
        $dueDate = strtotime("+14 days", $returnDate); // Misalnya batas waktu pengembalian adalah 14 hari dari tanggal pengembalian

        // Periksa apakah tanggal pengembalian melebihi tanggal jatuh tempo
        if ($returnDate > $dueDate) {
            $daysLate = ceil(($returnDate - $dueDate) / (60 * 60 * 24)); // Hitung jumlah hari keterlambatan
            $finePerDay = 1000; // Besaran denda per hari (misalnya 1000 per hari)
            return $daysLate * $finePerDay;
        }
        return 0; // Tidak ada keterlambatan
    }
}

// Menambahkan daftar buku
$book1 = new Book("Harry Potter And Orde Phoenix", "J.K. Rowling", 2017, "978-3-16-148410-0");
$book2 = new Book("The Principles Of Power", "Dion Yulianto", 2023, "978-3-16-148410-1");
$book3 = new Book("Atomic Habits", "James Clear", 2020, "978-3-16-148410-2");
$book4 = new Book("Bilal Bin Rabah", "Ana P Dewiana", 2021, "978-6-02-663394-1");
$book5 = new Book("Sapiens", "Yuval Noah Harari", 2022, "978-6-02-663394-1");
$book6 = new Book("The great story of Muhammad SAW", "Ahmad Hatta", 2014, "978-6-02-663394-1");
Library::addBook($book1);
Library::addBook($book2);
Library::addBook($book3);
Library::addBook($book4);
Library::addBook($book5);
Library::addBook($book6);
?>
