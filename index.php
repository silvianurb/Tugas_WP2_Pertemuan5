<?php
require_once 'library.php'; // Mengimpor file library.php yang berisi definisi kelas dan fungsi-fungsi terkait perpustakaan.

// Implementasi Pengurutan Buku
Library::sortBooksByYear(); // Mengurutkan daftar buku berdasarkan tahun terbit.

// Menghitung tanggal pengembalian buku
$returnDate = strtotime("2024-05-01"); // Mendapatkan tanggal pengembalian buku
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Perpustakaan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Mengimpor Bootstrap CSS -->
    <link rel="stylesheet" href="styles.css"> <!-- Mengimpor stylesheet kustom -->
</head>
<body>

<div class="container">
    <h1 class="text-center mt-5 mb-3">Daftar Buku Perpustakaan</h1>

    <!-- Form Pencarian Buku -->
    <form class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari buku berdasarkan judul atau penulis" id="searchInput">
        </div>
    </form>

    <!-- Daftar Buku -->
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                    <th>Nomor ISBN</th>
                </tr>
            </thead>
            <tbody id="bookList">
                <?php
                // Menampilkan daftar buku dalam bentuk tabel
                $books = Library::getBooks(); // Mendapatkan daftar buku dari perpustakaan
                foreach ($books as $book) {
                    echo '<tr>';
                    echo '<td>' . $book->getTitle() . '</td>'; // Menampilkan judul buku
                    echo '<td>' . $book->getAuthor() . '</td>'; // Menampilkan penulis buku
                    echo '<td>' . $book->getYear() . '</td>'; // Menampilkan tahun terbit buku
                    // Menampilkan status buku dengan warna hijau jika tersedia dan merah jika dipinjam
                    echo '<td>' . ($book->getStatus() === 'available' ? '<span class="text-success">Tersedia</span>' : '<span class="text-danger">Dipinjam</span>') . '</td>';
                    echo '<td>' . $book->getISBN() . '</td>'; // Menampilkan Nomor ISBN buku
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script untuk melakukan pencarian dinamis -->
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let keyword = this.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#bookList tr');

        rows.forEach(function(row) {
            let title = row.querySelector('td:first-child').textContent.toLowerCase().trim();
            let author = row.querySelector('td:nth-child(2)').textContent.toLowerCase().trim();

            if (title.includes(keyword) || author.includes(keyword)) {
                row.style.display = ''; // Menampilkan baris jika judul atau penulis cocok dengan kata kunci
            } else {
                row.style.display = 'none'; // Menyembunyikan baris jika tidak cocok
            }
        });
    });
</script>

  <!-- Header -->
  <footer class="text-center mt-5 mb-3">
      <h5>Silvia Nur Baiti - 21552011400 - UTS - Pemrograman Web 2</h5>
  </footer>


</body>
</html>
