<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>UAS - 20200120037 - Fajar Gema Ramadhan</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            mysqli_report(MYSQLI_REPORT_STRICT);
            function rupiah($angka)
            {
                $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
                return $hasil_rupiah;
            }
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=kuis", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Buat database "kuis" (jika belum ada)
                $query = "CREATE DATABASE IF NOT EXISTS kuis";
                $exe = $pdo->exec($query);
                if ($exe !== FALSE) {
            ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Database 'kuis' berhasil di buat / sudah tersedia</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else {
                    die("Query Error : " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
                };

                // Pilih database "kuis"
                $exe = $pdo->exec($query);
                if ($exe !== FALSE) {
                ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Database 'kuis' berhasil dipilih</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else {
                    die("Query Error : " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
                };

                // Hapus tabel "mahasiswa" (jika ada)
                $query = "DROP TABLE IF EXISTS mahasiswa";
                $exe = $pdo->exec($query);
                if ($exe !== FALSE) {
                } else {
                    die("Query Error : " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
                };

                // Buat tabel "mahasiswa"
                $query = "CREATE TABLE mahasiswa (
            kode VARCHAR(15) PRIMARY KEY,
            nama VARCHAR(50),
            jabatan VARCHAR(50),
            alamat TEXT,
            pendidikan VARCHAR(10),
            gol VARCHAR(10),
            gaji INT,
            created_at DATETIME
            )";
                $exe = $pdo->exec($query);
                if ($exe !== FALSE) {
                ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Tabel 'mahasiswa' berhasil dibuat</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                } else {
                    die("Query Error : " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
                };

                // Isi tabel "mahasiswa"
                $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                $timestamp = $sekarang->format("Y-m-d H:i:s");

                $data = [
                    ['SMK01', 'ANDI', 'KEPALA SEKOLAH', 'JAKARTA', 'S3', '3A', 25000000, $timestamp],
                    ['SMK02', 'ANTON', 'Wakil Kurikulim', 'SURABAYA', 'S2', '2A', 25000000, $timestamp],
                    ['SMK03', 'DEWI', 'Wakil Kesiswaan', 'SEMARANG', 'S1', '1A', 25000000, $timestamp],
                    ['SMK04', 'SINTA', 'Wakil Sarpras', 'BOGOR', 'S1', '3B', 25000000, $timestamp],
                    ['SMK05', 'RUDI', 'Wakil Humas', 'DEPOK', 'S2', '3C', 25000000, $timestamp],
                    ['SMK06', 'BUDI', 'Kepala Program', 'SUKABUMI', 'S2', '1A', 25000000, $timestamp],
                    ['SMK07', 'NOVI', 'Tata Usaha', 'CILACAP', 'D3', '3B', 25000000, $timestamp],
                    ['SMK08', 'CITRA', 'Pembina Osis', 'BANTEN', 'D3', '3B', 25000000, $timestamp],
                ];
                $query = "INSERT INTO mahasiswa (kode, nama, jabatan, alamat, pendidikan, gol, gaji, created_at) VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $count = 0;
                foreach ($data as $row) {
                    $count++;
                    $stmt->execute($row);
                }
                ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Tabel 'mahasiswa' berhasil di isi <?= $count ?> baris data</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

                echo "<hr>";
            } catch (Exception $e) {
                echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
            } finally {
                $pdo = NULL;
            }
            ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <script>
                window.setTimeout("waktu()", 1000);

                function waktu() {
                    var waktu = new Date();
                    setTimeout("waktu()", 1000);
                    document.getElementById("jam").innerHTML = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
                }
            </script>
            <?php
            $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $tanggal = $sekarang->format("d F Y");
            ?>
            <div class="col-md-10">
                <h4>Tanggal : <?php echo $tanggal; ?></h4>
            </div>
            <div class="col-md-2">
                <h4 id="jam"></h4>
            </div>

            <h2 class="text-center"> DAFTAR NAMA GURU DAN PEGAWAI </h2>
            <h2 class="text-center"> SMK PERTANIAN </h2>
            <h2 class="text-center"> TAHUN 2014 </h2>

            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=kuis", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $exe = $pdo->prepare("SELECT * FROM mahasiswa");
            $exe->execute();
            $result = $exe->fetchAll();

            ?>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>KODE GURU</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>PENDIDIKAN</th>
                        <th>GOL</th>
                        <th>GAJI</th>
                        <th>TANGGAL DIBUAT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($result)) {
                        foreach ($result as $row) {
                    ?>
                            <tr class="table-row">
                                <td><?php echo $row["kode"]; ?></td>
                                <td><?php echo $row["nama"]; ?></td>
                                <td><?php echo $row["jabatan"]; ?></td>
                                <td><?php echo $row["alamat"]; ?></td>
                                <td><?php echo $row["pendidikan"]; ?></td>
                                <td><?php echo $row["gol"]; ?></td>
                                <td><?php echo rupiah($row["gaji"]); ?></td>
                                <td><?php echo date('d F Y H:i:s', strtotime($row["created_at"])); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="table-row">
                            <td colspan="8" class="text-center">
                                <h3>DATA TIDAK DITEMUKAN</h3>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=kuis", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $exe = $pdo->prepare("SELECT * FROM mahasiswa");
            $exe->execute();
            $result = $exe->fetchAll();

            ?>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>KODE GURU</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>PENDIDIKAN</th>
                        <th>GOL</th>
                        <th>GAJI</th>
                        <th>TANGGAL DIBUAT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($result)) {
                        foreach ($result as $row) {
                    ?>
                            <tr class="table-row">
                                <td><?php echo $row["kode"]; ?></td>
                                <td><?php echo $row["nama"]; ?></td>
                                <td><?php echo $row["jabatan"]; ?></td>
                                <td><?php echo $row["alamat"]; ?></td>
                                <td><?php echo $row["pendidikan"]; ?></td>
                                <td><?php echo $row["gol"]; ?></td>
                                <td><?php echo rupiah($row["gaji"]); ?></td>
                                <td><?php echo date('d F Y H:i:s', strtotime($row["created_at"])); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="table-row">
                            <td colspan="8" class="text-center">
                                <h3>DATA TIDAK DITEMUKAN</h3> <br>
                                <p>catatan : mohon maaf ibu disini saya menggunakan kondisi dimana jika data ada akan menampilkan teks ini, <br> tetapi jika ibu mau menampilkan teks ini ditabel selain ini saya sudah buatkan</p>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=kuis", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "DELETE FROM mahasiswa WHERE kode = :kode";
            $exe = $pdo->prepare($query);
            $exe->execute(['kode' => "SMK08"]);
            if ($exe !== FALSE) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data dengan kode 'SMK08' berhasil di delete</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else {
                die("Query Error : " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
            };

            $exe = $pdo->prepare("SELECT * FROM mahasiswa");
            $exe->execute();
            $result = $exe->fetchAll();

            ?>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>KODE GURU</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>PENDIDIKAN</th>
                        <th>GOL</th>
                        <th>GAJI</th>
                        <th>TANGGAL DIBUAT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($result)) {
                        foreach ($result as $row) {
                    ?>
                            <tr class="table-row">
                                <td><?php echo $row["kode"]; ?></td>
                                <td><?php echo $row["nama"]; ?></td>
                                <td><?php echo $row["jabatan"]; ?></td>
                                <td><?php echo $row["alamat"]; ?></td>
                                <td><?php echo $row["pendidikan"]; ?></td>
                                <td><?php echo $row["gol"]; ?></td>
                                <td><?php echo rupiah($row["gaji"]); ?></td>
                                <td><?php echo date('d F Y H:i:s', strtotime($row["created_at"])); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="table-row">
                            <td colspan="8" class="text-center">
                                <h3>DATA TIDAK DITEMUKAN</h3>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>