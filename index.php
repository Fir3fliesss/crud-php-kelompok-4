<?php
// Include file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Inisialisasi variabel dengan nilai awal kosong
$NIK = "";
$nama = "";
$kelas = "";
$jurusan = "";
$talent = "";
$eskul = "";
$nomor_wa = "";
$sukses = "";
$error = "";

// Cek apakah parameter 'op' ada dalam URL
if (isset($_GET['op'])) {
    // Jika 'op' ada, simpan nilai 'op' ke dalam variabel $op
    $op = $_GET['op'];
} else {
    // Jika 'op' tidak ada, set nilai $op menjadi string kosong
    $op = "";
}

// Jika 'op' adalah 'ubah', lakukan operasi untuk mengambil data siswa berdasarkan NIK
if ($op == 'ubah') {
    // Ambil nilai NIK dari parameter URL
    $NIK = $_GET['NIK'];
    
    // Query untuk mengambil data siswa berdasarkan NIK
    $query = "SELECT * FROM tb_siswa WHERE NIK = '$NIK'";
    $ubah = mysqli_query($conn, $query);
    
    // Ambil data siswa dari hasil query
    $tampil = mysqli_fetch_array($ubah);
    
    // Assign nilai-nilai dari data siswa ke dalam variabel yang sesuai
    $nama = $tampil['nama'];
    $kelas = $tampil['kelas'];
    $jurusan = $tampil['jurusan'];
    $talent = $tampil['talent'];
    $eskul = $tampil['eskul'];
    $nomor_wa = $tampil['nomor_wa'];

    // Periksa apakah data siswa ditemukan
    if (!$nama) {
        // Jika tidak ditemukan, set pesan error
        $error = "Data Tidak Ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Data Talent Day Dan Extrakurikuler</title>
</head>

<body>
    <nav class="navbar bg-body-tertiary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CRUD
            </a>
        </div>
    </nav>

    <div class="card">
        <?php
        if ($sukses) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses; ?>
            </div>
        <?php
        }

        if ($error) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php
        }
        ?>

        <!-- Form untuk tambah data siswa -->
        <form action="simpan.php" method="POST">
            <div class="mb-3 row">
                <label for="NIK" class="col-sm-2 col-form-label">NIK SISWA</label>
                <div class="col-sm-10">
                    <input type="number" name="NIK" value="<?php echo $NIK ?>" class="form-control" id="NIK" placeholder="ex : 010101">
                </div>
                <label for="nama" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $nama ?>" placeholder="ex : Ucup">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas Siswa</label>
                <div class="col-sm-10">
                    <select id="kelas" name="kelas" class="form-select form-select-sm" aria-label="Small select example">
                        <option value="X" <?php if ($kelas == 'X') echo 'selected'; ?>>X</option>
                        <option value="XI" <?php if ($kelas == 'XI') echo 'selected'; ?>>XI</option>
                        <option value="XII" <?php if ($kelas == 'XII') echo 'selected'; ?>>XII</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan Siswa</label>
                <div class="col-sm-10">
                    <select id="jurusan" name="jurusan" class="form-select" aria-label="Default select example">
                        <option value="Rekayasa Perangkat Lunak" <?php if ($jurusan == 'Rekayasa Perangkat Lunak') echo 'selected'; ?>>Rekayasa Perangkat Lunak</option>
                        <option value="Multimedia" <?php if ($jurusan == 'Multimedia') echo 'selected'; ?>>Multimedia</option>
                        <option value="Teknik Jaringan Dan Komputer" <?php if ($jurusan == 'Teknik Jaringan Dan Komputer') echo 'selected'; ?>>Teknik Jaringan Dan Komputer</option>
                        <option value="Perbankan Keuangan Mikro" <?php if ($jurusan == 'Perbankan Keuangan Mikro') echo 'selected'; ?>>Perbankan Keuangan Mikro</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row mt-4">
                <label for="talent" class="col-sm-2 col-form-label">Talent Day</label>
                <div class="col-sm-10">
                    <select id="talent" name="talent" class="form-select">
                        <option value="Programming" <?php if ($talent == 'Programming') echo 'selected'; ?>>Programming</option>
                        <option value="Broadcasting" <?php if ($talent == 'Broadcasting') echo 'selected'; ?>>Broadcasting</option>
                        <option value="Animasi" <?php if ($talent == 'Animasi') echo 'selected'; ?>>Animasi</option>
                        <option value="Tata Boga" <?php if ($talent == 'Tata Boga') echo 'selected'; ?>>Tata Boga</option>
                        <option value="Musik Modern" <?php if ($talent == 'Musik Modern') echo 'selected'; ?>>Musik Modern</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row mt-4">
                <label for="eskul" class="col-sm-2 col-form-label">Extrakurikuler</label>
                <div class="col-sm-10">
                    <select id="eskul" name="eskul" class="form-select">
                        <option value="Badminton" <?php if ($eskul == 'Badminton') echo 'selected'; ?>>Badminton</option>
                        <option value="English Club" <?php if ($eskul == 'English Club') echo 'selected'; ?>>English Club</option>
                        <option value="Japan Club" <?php if ($eskul == 'Japan Club') echo 'selected'; ?>>Japan Club</option>
                        <option value="Basket" <?php if ($eskul == 'Basket') echo 'selected'; ?>>Basket</option>
                        <option value="Taekwondo" <?php if ($eskul == 'Taekwondo') echo 'selected'; ?>>Taekwondo</option>
                    </select>
                </div>
            </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nomor Whatsapp</label>
            <div class="col-sm-10">
                <input type="text" name="nomor_wa" class="form-control" id="no" value="<?php echo $nomor_wa ?>" placeholder="ex : 0857">
            </div>
        </div>
        <div class="col-12" align="left">
            <button type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>

    <!-- Tabel untuk menampilkan data siswa -->
    <div class="card">
        <div class="card-header text-white bg-dark">
            Data Siswa
        </div>
        <table class="card-body">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Talent</th>
                    <th scope="col">Eskul</th>
                    <th scope="col">Nomor Whatsapp</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tb_siswa ORDER BY NIK ASC";
                $tampil = mysqli_query($conn, $query);
                $urut = 1;
                while ($result = mysqli_fetch_array($tampil)) {
                    $NIK = $result['NIK'];
                    $nama = $result['nama'];
                    $kelas = $result['kelas'];
                    $jurusan = $result['jurusan'];
                    $talent = $result['talent'];
                    $eskul = $result['eskul'];
                    $nomor_wa = $result['nomor_wa'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $urut++; ?></th>
                        <td><?php echo $NIK; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $kelas; ?></td>
                        <td><?php echo $jurusan; ?></td>
                        <td><?php echo $talent; ?></td>
                        <td><?php echo $eskul; ?></td>
                        <td><?php echo $nomor_wa; ?></td>
                        <td>
                            <a href="index.php?op=ubah&NIK=<?php echo $NIK; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                            <a href="delete.php?NIK=<?php echo $NIK; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ???')"><button type="button" class="btn btn-danger">Hapus</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
