<?php
date_default_timezone_set('Asia/Jakarta'); // Set timezone yang sesuai

include_once("koneksi.php");

if (isset($_POST['action'])) {
    $nama = $_POST['nama'];
    $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : ''; // Untuk aksi 'in'
    $action = $_POST['action'];
    $time = date('Y-m-d H:i:s');

    if ($action == 'in') {
        // Insert waktu kehadiran 'in' jika tidak ada
        $query = "INSERT INTO absen (nama, jurusan, `in`) VALUES ('$nama', '$jurusan', '$time')
                  ON DUPLICATE KEY UPDATE `in` = VALUES(`in`), jurusan = VALUES(jurusan)";
        if (mysqli_query($mysqli, $query)) {
            echo "Waktu IN berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } elseif ($action == 'out') {
        // Update waktu pulang 'out' untuk entri yang tepat
        $query = "UPDATE absen SET `out`='$time' WHERE nama='$nama' AND `out` IS NULL ORDER BY id DESC LIMIT 1";
        if (mysqli_query($mysqli, $query)) {
            echo "Waktu Out berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }
}
?>
