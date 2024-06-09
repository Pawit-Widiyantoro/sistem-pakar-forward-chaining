<?php
    include "config.php";

    $id_konsultasi = $_GET['id'];
    $sql = "SELECT * FROM konsultasi WHERE id_konsultasi='$id_konsultasi'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>
<div class="container mx-auto px-10 py-5">
    <div class="w-2/3 mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                <input type="text" name="nama" id="nama" value="<?= $row['nama'] ;?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- tabel gejala -->
            <label class="block text-sm font-medium text-gray-700">Gejala</label>
            <table class="table-auto w-full mt-2">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
                    <th class="px-6 py-2 text-xs text-gray-500">Nama Gejala</th>

                </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                        $no = 1;
                        $sql =  "SELECT detail_konsultasi.id_konsultasi, detail_konsultasi.id_gejala, gejala.nama_gejala
                                FROM detail_konsultasi
                                INNER JOIN gejala ON detail_konsultasi.id_gejala=gejala.id_gejala
                                WHERE id_konsultasi='$id_konsultasi'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                    ?>

                    <tr class="whitespace-nowrap">
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                    </tr>

                    <?php 
                        }
                        
                    ?>
                </tbody>
            </table>

            <!-- hasil konsultasi -->
            <label class="block text-sm font-medium text-gray-700">Hasil konsultasi</label>
            <table class="table-auto w-full mt-2">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
                        <th class="px-6 py-2 text-xs text-gray-500">Kebutuhan Nutrisi</th>
                        <th class="px-6 py-2 text-xs text-gray-500">Persentase</th>
                        <th class="px-6 py-2 text-xs text-gray-500">Solusi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                        $no = 1;
                        $sql =  "SELECT detail_penyakit.id_konsultasi, detail_penyakit.id_penyakit, detail_penyakit.persentase, penyakit.nama_penyakit, penyakit.solusi
                                FROM detail_penyakit
                                INNER JOIN penyakit ON detail_penyakit.id_penyakit=penyakit.id_penyakit
                                WHERE id_konsultasi='$id_konsultasi'
                                ORDER BY persentase DESC";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                    ?>

                    <tr class="whitespace-nowrap">
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_penyakit']; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $row['persentase'] . '%'; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $row['solusi']; ?></td>
                    </tr>

                    <?php 
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>

            <div class="flex items-center justify-between mt-5">
                <a href="?page=konsultasi_admin">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Kembali
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>

