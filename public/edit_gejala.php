<?php
    include "config.php";

    $id_gejala = $_GET['id'];

    if(isset($_POST['update'])){
        $nama_gejala = $_POST['gejala'];

        $sql = "UPDATE gejala SET nama_gejala='$nama_gejala' WHERE id_gejala='$id_gejala'";
        $result = $conn->query($sql);
        if($conn->query($sql) === TRUE){
            header("Location: ?page=gejala");
            exit(); // Ensure you exit after the header redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $sql = "SELECT * FROM gejala WHERE id_gejala='$id_gejala'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<div class="container mx-auto px-10 py-5">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="gejala" class="block text-sm font-medium text-gray-700">Nama Gejala</label>
                <input type="text" name="gejala" id="gejala" value="<?= $row['nama_gejala'] ;?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <a href="?page=gejala">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a>
                <input type="submit" name="update" value="Update" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
