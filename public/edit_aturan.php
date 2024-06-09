<?php

    include "config.php";

    $id_aturan = $_GET['id'];

    $sql = "SELECT basis_aturan.id_aturan, basis_aturan.id_penyakit, penyakit.nama_penyakit 
            FROM basis_aturan INNER JOIN penyakit ON basis_aturan.id_penyakit = penyakit.id_penyakit 
            WHERE id_aturan='$id_aturan'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(isset($_POST['update'])){
        $id_gejala = $_POST['id_gejala'];

        if($id_gejala!=Null){
            $jumlah = count($id_gejala);
            $i = 0;
            while($i < $jumlah){
                $index_gejala = $id_gejala[$i];
                $sql = "INSERT INTO detail_basis_aturan VALUES('$id_aturan','$index_gejala')";
                $conn->query($sql);
                $i++;
            }
        }
        header("Location: ?page=aturan");
    }

?>

<div id="alert-container"></div>
<div class="container mx-auto px-10 py-5">
    <div class="w-3/4 mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <!-- penyakit -->
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Kebutuhan Nutrisi</label>
                <input type="text" name="gejala" id="gejala" value="<?= $row['nama_penyakit']; ?>" readonly
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- end penyakit -->
            <!-- gejala -->
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Pilih Gejala</label>
                <table class="mt-1 table-auto w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500 w-5"></th>
                            <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
                            <th class="px-6 py-2 text-xs text-gray-500">Nama Gejala</th>
                            <th class="px-6 py-2 text-xs text-gray-500"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php
                            $no = 1;
                            $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){

                                $id_gejala = $row['id_gejala'];
                                $sql2 = "SELECT * FROM detail_basis_aturan WHERE id_aturan='$id_aturan' AND id_gejala='$id_gejala'";
                                $result2 = $conn->query($sql2);
                                if($result2->num_rows > 0){
                                    
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" disabled="disabled">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-right">
                                <a href="?page=aturan&action=delete_gejala&id_aturan=<?= $id_aturan ?>&id_gejala=<?= $id_gejala ?>">
                                    <button type="button" onclick="return confirm('Yakin ingin menghapus gejala ini?')" class="bg-red-500 text-white w-16 h-8 rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php
                            } else {   
                        ?> 
                            <tr>
                                <td>
                                    <input type="checkbox" name="<?= 'id_gejala[]'; ?>" value="<?= $row['id_gejala']; ?>">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-right">
                                    <button class="bg-slate-500 text-white w-16 h-8 rounded">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php
                            }
                            }
                            $conn->close()
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end gejala -->
            <div class="flex items-center justify-between">
                <a href="?page=aturan">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a>
                <input type="submit" name="update" value="Update" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
