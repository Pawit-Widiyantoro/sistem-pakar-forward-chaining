<div class="container mx-auto px-10 py-5">
    <h2 class="text-2xl font-semibold mb-4">Riwayat Konsultasi</h2>
    <div class="mb-4">
        <a href="?page=konsultasi&action=insert">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Konsultasi Baru
            </button>
        </a>
    </div>
    <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
      <table class="table-auto w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
            <th class="px-6 py-2 text-xs text-gray-500">Tanggal</th>
            <th class="px-6 py-2 text-xs text-gray-500">Nama Pasien</th>
            
            <th class="px-6 py-2 text-xs text-gray-500">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            
            <?php
                $id_user = $_SESSION['id_user'];
                $no = 1;
                $sql = "SELECT * FROM konsultasi WHERE id_user = '$id_user' ORDER BY tanggal DESC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
            ?>

            <tr class="whitespace-nowrap">
                <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['tanggal']; ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama']; ?></td>
                
                <td class="px-6 py-4 text-sm text-center">
                    <a href="?page=konsultasi&action=detail&id=<?= $row['id_konsultasi'];?>">
                        <button class="bg-blue-500 text-white w-16 h-8 rounded hover:bg-blue-700">
                            Detail
                        </button>
                    </a>
                    <!-- <a href="?page=aturan&action=update&id=<?= $row['id_aturan'];?>">
                        <button class="bg-yellow-500 text-white w-16 h-8 rounded hover:bg-yellow-700">
                            Edit
                        </button>
                    </a> -->
                    <!-- <a href="?konsultasi_admin&action=delete&id=<?= $row['id_aturan'];?>">
                        <button onclick="return confirm('Yakin ingin menghapus penyakit ini?')" class="bg-red-500 text-white w-16 h-8 rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </a> -->
                </td>
            </tr>

            <?php 
                }
                $conn->close();
            ?>
        </tbody>
      </table>
    </div>
  </div>
