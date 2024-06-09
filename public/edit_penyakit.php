<?php
    include "config.php";

    $id_penyakit = $_GET['id'];

    if(isset($_POST['update'])){
        $nama_penyakit = $_POST['penyakit'];
        $keterangan = $_POST['keterangan'];
        $solusi = $_POST['solusi'];

        $sql = "UPDATE penyakit SET nama_penyakit='$nama_penyakit', keterangan='$keterangan', solusi='$solusi' WHERE id_penyakit='$id_penyakit'";
        $result = $conn->query($sql);
        if($conn->query($sql) === TRUE){
            header("Location: ?page=penyakit");
            exit(); // Ensure you exit after the header redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $sql = "SELECT * FROM penyakit WHERE id_penyakit='$id_penyakit'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<div class="container mx-auto px-10 py-5">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Nama nutrisi</label>
                <input type="text" name="penyakit" id="penyakit" value="<?= $row['nama_penyakit'] ;?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" value="<?= $row['keterangan'] ;?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="solusi" class="block text-sm font-medium text-gray-700">Solusi</label>
                <input type="text" name="solusi" id="solusi" value="<?= $row['solusi'] ;?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <a href="?page=penyakit">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a>
                <input type="submit" name="update" value="Update" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
