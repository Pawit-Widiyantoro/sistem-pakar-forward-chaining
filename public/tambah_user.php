<?php
    include "config.php";

    if(isset($_POST['simpan'])){
        $username = strtolower(stripslashes($_POST['username']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $role = $_POST['role'];

        $validasi_nama = "SELECT username FROM users WHERE username = '$username'";
        $hasil_validasi = $conn->query($validasi_nama);
        if($hasil_validasi->fetch_assoc() === TRUE){
            echo "<script>alert('username sudah ada!')</script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users VALUES(NULL,'$username', '$password', '$role')";
        if($conn->query($sql) === TRUE){
            header("Location: ?page=user");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<div class="container mx-auto px-10 py-5">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" data-placeholder="Pilih role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm chosen">
                    <option value="" class=""></option>
                    <option value="bidan" class="">Bidan</option>
                    <option value="pasien" class="">Pasien</option>
                    <option value="admin" class="">Admin</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <a href="?page=user">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a>
                <input type="submit" name="simpan" value="Simpan" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
