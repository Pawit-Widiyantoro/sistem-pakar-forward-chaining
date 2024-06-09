<?php
    session_start();  
    include "config.php";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){

            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['status'] = "y";
    
                header("Location:index.php");
                exit();
            } else{
                // tampilkan pesan password salah
                $_SESSION['error'] = "Password salah!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            // tampilkan pesan tidak ada data user
            $_SESSION['error'] = "Username tidak ada!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
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
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md h-3/4">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Log In</h1>
            <div class="h-4">
            <?php
                if(isset($_SESSION['error'])){
                    echo "<p class='text-red-500 text-center mb-4'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }
            ?>
            </div>
            <form action="" method="post" class="space-y-4">
            <div>
                <input type="text" name="username" id="username" placeholder="Username" required class="mt-1 py-2 block w-full border-b-2 border-gray-100 focus:outline-none shadow-sm focus:border-gray-800 focus:ring-gray-800">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password" required class="mt-1 py-2 block w-full border-b-2 border-gray-100 focus:outline-none shadow-sm focus:border-gray-800 focus:ring-gray-800">
            </div>
            <div>
                <button type="submit" name="submit" class="mt-5 w-full py-2 px-4 bg-gray-600 text-white font-semibold rounded-md shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">Login</button>
            </div>
            <p class="mt-4 text-center text-gray-400">Belum memiliki akun? <a href="register.php" class="text-gray-700">Register</a></p>
            </form>
        </div>
    </div>
</body>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
</html>
<?php
ob_end_flush();
?>