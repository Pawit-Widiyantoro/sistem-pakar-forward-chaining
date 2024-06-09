<?php
    include "config.php";

    if(isset($_POST['simpan'])){
        $nama_penyakit = $_POST['nama_penyakit'];

        // validation
        $sql = "SELECT basis_aturan.id_aturan, basis_aturan.id_penyakit, penyakit.nama_penyakit
                FROM basis_aturan
                INNER JOIN penyakit
                ON basis_aturan.id_penyakit=penyakit.id_penyakit
                WHERE nama_penyakit='$nama_penyakit'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
?>
            <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-3 my-3 rounded relative' role='alert'>
                <strong class='font-bold'>Penyakit sudah ada!</strong>
                <span class='block sm:inline'>Pilih penyakit lain!</span>
                <span class='absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer' onclick="this.parentElement.style.display='none';">
                    &times;
                </span>
            </div>      
<?php             
        }else{

            // ambil id
            $sql = "SELECT * FROM penyakit WHERE nama_penyakit='$nama_penyakit'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id_penyakit = $row['id_penyakit'];

            // insert basis aturan
            $sql = "INSERT INTO basis_aturan VALUES(NULL,'$id_penyakit')";
            $conn->query($sql);


            // insert detail basis aturan
            $sql = "SELECT * FROM basis_aturan ORDER BY id_aturan DESC";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id_aturan = $row['id_aturan'];
            
            $id_gejala = $_POST['id_gejala'];
            $jumlah = count($id_gejala);
            $i = 0;
            while($i < $jumlah){
                $index_gejala = $id_gejala[$i];
                $sql = "INSERT INTO detail_basis_aturan VALUES('$id_aturan','$index_gejala')";
                $conn->query($sql);
                $i++;
            }
            header("Location: ?page=aturan");
        }
    }
?>

<div id="alert-container"></div>
<div class="container mx-auto px-10 py-5">
    <div class="w-3/4 mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post" name="form" onsubmit="return validateForm()">
            <!-- penyakit -->
            <div class="mb-4">
                <label for="penyakit" class="block text-sm font-medium text-gray-700">Kebutuhan Nutrisi</label>
                <select name="nama_penyakit" data-placeholder="Pilih nama penyakit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm chosen">
                <option value="" class=""></option>
                <?php
                    $sql = "SELECT * FROM penyakit ORDER BY nama_penyakit ASC";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                ?>
                    <option value="<?= $row['nama_penyakit']; ?>"><?= $row['nama_penyakit']; ?></option>
                <?php
                    }
                ?>
                </select>
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
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php
                            $no = 1;
                            $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="<?= 'id_gejala[]'; ?>" value="<?= $row['id_gejala']; ?>">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                        </tr>
                        <?php
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
                <input type="submit" name="simpan" value="Simpan" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validateForm() {
        // Check if penyakit is selected
        const nama_penyakit = document.forms['form']['nama_penyakit'].value;
        if (nama_penyakit === "") {
            document.getElementById('alert-container').innerHTML = `
                <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-3 my-3 rounded relative' role='alert'>
                    <strong class='font-bold'>Pilih penyakit terlebih dahulu!</strong>
                    <span class='absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer' onclick="this.parentElement.style.display='none';">
                        &times;
                    </span>
                </div>`;
            return false;
        }

        // Check if at least one gejala is selected
        const checkboxes = document.getElementsByName('id_gejala[]');
        let isChecked = false;

        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            document.getElementById('alert-container').innerHTML = `
                <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-3 my-3 rounded relative' role='alert'>
                    <strong class='font-bold'>Pilih setidaknya satu gejala!</strong>
                    <span class='absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer' onclick="this.parentElement.style.display='none';">
                        &times;
                    </span>
                </div>`;
            return false;
        }

        return true;
    }
</script>

