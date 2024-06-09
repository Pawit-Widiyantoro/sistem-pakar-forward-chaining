<?php
    include "config.php";

    $id_user = $_GET['id'];

    if(isset($_POST['update'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $sql = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id_user='$id_user'";
        $result = $conn->query($sql);
        if($conn->query($sql) === TRUE){
            header("Location: ?page=user");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $sql = "SELECT * FROM users WHERE id_user='$id_user'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<div class="container mx-auto px-10 py-5">
    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="<?= $row['username'] ;?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" value="<?= $row['password'] ;?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" data-placeholder="Pilih role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm chosen">
                    <option value="<?= $row['role'] ;?>" class=""><?= $row['role'] ;?></option>
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
                <input type="submit" name="update" value="Update" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>
