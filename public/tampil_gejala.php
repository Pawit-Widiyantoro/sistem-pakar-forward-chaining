<div class="container mx-auto px-10 py-5">
    <h2 class="text-2xl font-semibold mb-4">Data Gejala</h2>
    <div class="mb-4">
        <a href="?page=gejala&action=insert">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah Gejala
            </button>
        </a>
    </div>
    <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
      <table class="table-auto w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-2 text-xs text-gray-500 w-5">No.</th>
            <th class="px-6 py-2 text-xs text-gray-500">Nama Gejala</th>
            
            <th class="px-6 py-2 text-xs text-gray-500">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            
            <?php
                $no = 1;
                $sql = "SELECT * FROM gejala ORDER BY nama_gejala ASC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
            ?>

            <tr class="whitespace-nowrap">
                <td class="px-6 py-4 text-sm text-gray-500"><?= $no++; ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['nama_gejala']; ?></td>
                
                <td class="px-6 py-4 text-sm text-center">
                    <a href="?page=gejala&action=update&id=<?= $row['id_gejala'];?>">
                        <button class="bg-yellow-500 text-white w-16 h-8 rounded hover:bg-yellow-700">
                            Edit
                        </button>
                    </a>
                    <a href="?page=gejala&action=delete&id=<?= $row['id_gejala'];?>">
                        <button onclick="return confirm('Yakin ingin menghapus gejala ini?')" class="bg-red-500 text-white w-16 h-8 rounded hover:bg-red-700">
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