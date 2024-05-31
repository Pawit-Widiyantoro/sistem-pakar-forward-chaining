<?php
    include "config.php";

    $id_aturan = $_GET['id'];
    $sql = "SELECT basis_aturan.id_aturan,basis_aturan.id_penyakit, 
                    penyakit.nama_penyakit, penyakit.keterangan
            FROM basis_aturan
            INNER JOIN penyakit ON basis_aturan.id_penyakit=penyakit.id_penyakit
            WHERE basis_aturan.id_aturan='$id_aturan'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>
<div class="container mx-auto px-10 py-5">
    <div class="w-2/3 mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Nama penyakit</label>
                <input type="text" name="penyakit" id="penyakit" value="<?= $row['nama_penyakit'] ;?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" value="<?= $row['keterangan'] ;?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                        $sql =  "SELECT detail_basis_aturan.id_aturan, detail_basis_aturan.id_gejala,
                                        gejala.nama_gejala
                                FROM detail_basis_aturan
                                INNER JOIN gejala ON detail_basis_aturan.id_gejala=gejala.id_gejala
                                WHERE detail_basis_aturan.id_aturan='$id_aturan'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                    ?>

                    <tr class="whitespace-nowrap">
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                    </tr>

                    <?php 
                        }
                        $conn->close();
                    ?>
                <!-- More rows as needed -->
                </tbody>
            </table>

            <div class="flex items-center justify-between mt-5">
                <a href="?page=aturan">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Kembali
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>