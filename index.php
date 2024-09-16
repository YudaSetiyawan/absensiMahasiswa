<?php
include_once("koneksi.php");

// Mengambil semua data dari database
$result = mysqli_query($mysqli, "SELECT * FROM absen ORDER BY id DESC");

if (!$result) {
    die("Query gagal: " . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>UNIVERSITAS TUNAS BANGSA</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
        <div class="container d-flex justify-content-center">
            <h3 class="mb-0 p-2">ABSENSI MAHASISWA UNIVERSITAS TUNAS BANGSA</h3>
        </div>
    </nav>

    <div class="bg-light p-2 text-dark bg-opacity-10">
        <h4 class="p-4 text-center">DAFTAR KEHADIRAN MAHASISWA</h4>
        <div class="container">
            <form id="form_absen" name="form_absen" onsubmit="return false;">
                <div class="col-md-6 offset-md-3">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="Masukkan Jurusan">
                    </div>
                </div>
                <div class="text-center">
                    <button type="reset" class="btn btn-dark" name="Reset">Reset</button>
                    <button type="button" class="btn btn-success m-2 ps-4 pe-4" name="Submit" id="submitIn">In</button>
                    <button type="button" class="btn btn-danger ps-3 pe-3" name="Submit" id="submitOut">Out</button>
                </div>
            </form>

            <table class="my-5 table table-striped">
                <tr class="table-dark">
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>In</th>
                    <th>Out</th>
                </tr>
                <?php
                while ($r = mysqli_fetch_array($result)) {
                ?>
                    <tr class="table-secondary">
                        <td><?php echo htmlspecialchars($r['nama']); ?></td>
                        <td><?php echo htmlspecialchars($r['jurusan']); ?></td>
                        <td><?php echo htmlspecialchars($r['in']); ?></td>
                        <td><?php echo htmlspecialchars($r['out']); ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#submitIn').click(function() {
                var nama = $('input[name="nama"]').val();
                var jurusan = $('input[name="jurusan"]').val();

                $.ajax({
                    url: 'proses_absen.php',
                    type: 'POST',
                    data: {
                        nama: nama,
                        jurusan: jurusan,
                        action: 'in'
                    },
                    success: function(response) {
                        alert(response); // Menampilkan pesan dari server
                        location.reload(); // Reload halaman setelah sukses
                    },
                    error: function() {
                        alert('Gagal menambahkan waktu In');
                    }
                });
            });

            $('#submitOut').click(function() {
                var nama = $('input[name="nama"]').val();

                $.ajax({
                    url: 'proses_absen.php',
                    type: 'POST',
                    data: {
                        nama: nama,
                        action: 'out'
                    },
                    success: function(response) {
                        alert(response); // Menampilkan pesan dari server
                        location.reload(); // Reload halaman setelah sukses
                    },
                    error: function() {
                        alert('Gagal menambahkan waktu Out');
                    }
                });
            });
        });
    </script>
</body>
</html>
