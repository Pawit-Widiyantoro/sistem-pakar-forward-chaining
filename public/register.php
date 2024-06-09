<?php
    session_start();  
    include "config.php";

    if(isset($_POST['submit'])){
        $username = strtolower(stripslashes($_POST['username']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $role = $_POST['role'];

        $validasi_nama = "SELECT username FROM users WHERE username = '$username'";
        $hasil_validasi = $conn->query($validasi_nama);
        if($hasil_validasi->fetch_assoc() > 0){
            $_SESSION['error'] = "Username sudah digunakan!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        if($password !== $password2){
            $_SESSION['error'] = "Konfirmasi password tidak sesuai!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users VALUES(NULL,'$username', '$password', '$role')";
        if($conn->query($sql) === TRUE){
            header("Location: ?page=login");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://kit.fontawesome.com/your-fontawesome-kit-code.js" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="../src/output.css">
    <title>Homepage</title>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen h-2/3 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Register</h1>
            <div class="h-4">
            <?php
                if(isset($_SESSION['error'])){
                    echo "<p class='text-red-500 text-center mb-4'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']); // Clear error after displaying it
                }
            ?>
            </div>
            <form action="" method="post" class="space-y-4">
            <input type="hidden" name="role" value="pasien">
            <div>
                <!-- <label for="LSTAT" class="block text-sm font-medium text-gray-700">LSTAT</label> -->
                <input type="text" name="username" id="username" placeholder="Username" required class="mt-1 py-2 block w-full border-b-2 border-gray-100 focus:outline-none shadow-sm focus:border-gray-800 focus:ring-gray-800">
            </div>
            <div>
                <!-- <label for="LSTAT" class="block text-sm font-medium text-gray-700">LSTAT</label> -->
                <input type="password" name="password" id="password" placeholder="Password" required class="mt-1 py-2 block w-full border-b-2 border-gray-100 focus:outline-none shadow-sm focus:border-gray-800 focus:ring-gray-800">
            </div>
            <div>
                <!-- <label for="LSTAT" class="block text-sm font-medium text-gray-700">LSTAT</label> -->
                <input type="password" name="password2" id="password2" placeholder="Confirm Password" required class="mt-1 py-2 block w-full border-b-2 border-gray-100 focus:outline-none shadow-sm focus:border-gray-800 focus:ring-gray-800">
            </div>
            <div>
                <button type="submit" name="submit" class="mt-5 w-full py-2 px-4 bg-gray-600 text-white font-semibold rounded-md shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">Register</button>
            </div>
            <p class="mt-4 text-gray-400 text-center">Sudah memiliki akun? <a href="login.php" class="text-gray-700">Login</a></p>
            </form>
        </div>
    </div>
</body>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
</html>
<?php
ob_end_flush(); // End output buffering and flush the output
?>