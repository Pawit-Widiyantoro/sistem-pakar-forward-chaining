<div class="container mx-auto px-10 py-5">
    <h2 class="text-2xl font-semibold mb-4">Basis Aturan</h2>
    <div class="mb-4">
        <a href="?page=aturan&action=insert">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah Aturan
            </button>
        </a>
    </div>
    <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
      <table class="table-auto w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
            <th class="px-6 py-2 text-xs text-gray-500">Nama Penyakit</th>
            <th class="px-6 py-2 text-xs text-gray-500">Keterangan</th>
            
            <th class="px-6 py-2 text-xs text-gray-500">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            
            <?php
                $no = 1;
                $sql = "SELECT basis_aturan.id_aturan, basis_aturan.id_penyakit, 
                        penyakit.nama_penyakit, penyakit.keterangan FROM basis_aturan INNER JOIN penyakit 
                        ON basis_aturan.id_penyakit = penyakit.id_penyakit 
                        ORDER BY nama_penyakit ASC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
            ?>

            <tr class="whitespace-nowrap">
                <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_penyakit']; ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['keterangan']; ?></td>
                
                <td class="px-6 py-4 text-sm text-center">
                    <a href="?page=aturan&action=detail&id=<?= $row['id_aturan'];?>">
                        <button class="bg-blue-500 text-white w-16 h-8 rounded hover:bg-blue-700">
                            Detail
                        </button>
                    </a>
                    <a href="?page=aturan&action=update&id=<?= $row['id_aturan'];?>">
                        <button class="bg-yellow-500 text-white w-16 h-8 rounded hover:bg-yellow-700">
                            Edit
                        </button>
                    </a>
                    <a href="?page=aturant&action=delete&id=<?= $row['id_aturan'];?>">
                        <button onclick="return confirm('Yakin ingin menghapus penyakit ini?')" class="bg-red-500 text-white w-16 h-8 rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </a>
                </td>
            </tr>

            <?php 
                }
                $conn->close();
            ?>
        <!-- More rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
