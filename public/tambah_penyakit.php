<?php
    include "config.php";

    if(isset($_POST['simpan'])){
        $nama_penyakit = $_POST['penyakit'];
        $keterangan = $_POST['keterangan'];
        $solusi = $_POST['solusi'];

        $sql = "INSERT INTO penyakit VALUES(NULL,'$nama_penyakit', '$keterangan', '$solusi')";
        if($conn->query($sql) === TRUE){
            header("Location: ?page=penyakit");
            exit(); // Ensure you exit after the header redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<div class="container mx-auto px-10 py-5">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Nama nutrisi</label>
                <input type="text" name="penyakit" id="penyakit" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="solusi" class="block text-sm font-medium text-gray-700">Solusi</label>
                <input type="text" name="solusi" id="solusi" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <a href="?page=penyakit">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a>
                <input type="submit" name="simpan" value="Simpan" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
