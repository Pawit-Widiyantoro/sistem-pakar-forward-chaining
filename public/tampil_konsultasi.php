<?php
    include "config.php";

    date_default_timezone_set("Asia/Jakarta");

    if(isset($_POST['proses'])){
        $nama_pasien = $_POST['nama_pasien'];
        $tgl = date("Y/m/d");
        $id_user = $_SESSION['id_user'];

        // insert tabel konsultasi
        $sql = "INSERT INTO konsultasi VALUES(NULL,'$tgl','$nama_pasien','$id_user')";
        $conn->query($sql);

        // insert detail konsultasi
        $sql = "SELECT * FROM konsultasi ORDER BY id_konsultasi DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_konsultasi = $row['id_konsultasi'];
        
        $id_gejala = $_POST['id_gejala'];
        $jumlah = count($id_gejala);
        $i = 0;
        while($i < $jumlah){
            $index_gejala = $id_gejala[$i];
            $sql = "INSERT INTO detail_konsultasi VALUES('$id_konsultasi','$index_gejala')";
            $conn->query($sql);
            $i++;
        }
        
        // take data dari tabel penyakit
        $sql = "SELECT * FROM penyakit";
        $result=$conn->query($sql);
        while($row = $result->fetch_assoc()){
            $id_penyakit = $row['id_penyakit'];
            $nama_penyakit = $row['nama_penyakit'];
            $jml_ok = 0;

            // cek jumlah gejala
            $sql2 = "SELECT COUNT(id_penyakit) AS jumlah_gejala
                     FROM basis_aturan INNER JOIN detail_basis_aturan ON basis_aturan.id_aturan = detail_basis_aturan.id_aturan
                     WHERE id_penyakit = '$id_penyakit'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $jumlah_gejala = $row2['jumlah_gejala'];

            // cari gejala pada tabel basis_aturan
            $sql3 = "SELECT id_penyakit, id_gejala
                     FROM basis_aturan INNER JOIN detail_basis_aturan ON basis_aturan.id_aturan = detail_basis_aturan.id_aturan
                     WHERE id_penyakit = '$id_penyakit'";
            $result3 = $conn->query($sql3);
            while($row3 = $result3->fetch_assoc()){
                $id_gejala2 = $row3['id_gejala'];

                $sql4 = "SELECT id_gejala FROM detail_konsultasi
                        WHERE id_konsultasi = '$id_konsultasi' AND id_gejala = '$id_gejala2'";
                $result4 = $conn->query($sql4);
                if($result4->num_rows > 0){
                    $jml_ok+=1; 
                }
            }

            // perhitungan
            if($jumlah_gejala>0){
                $peluang = round(($jml_ok / $jumlah_gejala) * 100 , 2);
            } else {
                $peluang = 0;
            }

            // simpan detail_penyakit
            if($peluang>0){
                $sql = "INSERT INTO detail_penyakit VALUES ('$id_konsultasi', '$id_penyakit', '$peluang')";
                $conn->query($sql);
            }
            header("Location: ?page=konsultasi&action=hasil&id_konsultasi=$id_konsultasi");
        }
    }

?>

<div id="alert-container"></div>
<div class="container mx-auto px-10 py-5">
    <div class="w-3/4 mx-auto bg-white p-5 rounded-lg shadow-lg">
        <form action="" method="post" name="form" onsubmit="return validateForm()">
            <!-- penyakit -->
            <div class="mb-4">
                <label for="pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                <input type="text" name="nama_pasien" id="pasien" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                <!-- <a href="?page=aturan">
                    <button type="button" class="bg-red-500 text-white w-20 h-8 rounded hover:bg-red-700">
                        Batal
                    </button>
                </a> -->
                <input type="submit" name="proses" value="Proses" class="bg-green-500 text-white w-20 h-8 rounded hover:bg-green-700">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validateForm() {
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

