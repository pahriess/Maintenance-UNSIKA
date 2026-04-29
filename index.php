<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// fungsi badge warna status
function badge($s){
    if($s=='Pending') return 'bg-yellow-100 text-yellow-700';
    if($s=='Diproses') return 'bg-blue-100 text-blue-700';
    if($s=='Selesai') return 'bg-green-100 text-green-700';
}

// ambil data
$result = mysqli_query($conn, "SELECT * FROM maintenance ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Maintenance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-red-700 text-white px-6 py-4 flex justify-between items-center shadow">
    <h1 class="font-bold text-lg">UNSIKA Maintenance</h1>

    <div class="flex items-center gap-4">
        <span class="text-sm bg-red-500 px-3 py-1 rounded-full">
            <?= htmlspecialchars($_SESSION['nama']) ?> (<?= $_SESSION['role'] ?>)
        </span>
        <a href="logout.php" class="bg-white text-red-700 px-3 py-1 rounded hover:bg-gray-200 transition">
            Logout
        </a>
    </div>
</nav>

<div class="max-w-6xl mx-auto mt-8 p-4">

<!-- FORM -->
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Buat Laporan</h2>

    <form action="proses_simpan.php" method="POST" class="grid gap-4">
        <input name="nama_pelapor" placeholder="Nama Pelapor"
            class="border p-2 rounded focus:ring-2 focus:ring-red-400" required>

        <input name="lokasi" placeholder="Lokasi"
            class="border p-2 rounded focus:ring-2 focus:ring-red-400" required>

        <textarea name="deskripsi" placeholder="Deskripsi Kerusakan"
            class="border p-2 rounded focus:ring-2 focus:ring-red-400" required></textarea>

        <button name="submit"
            class="bg-red-600 text-white py-2 rounded hover:bg-red-800 transition">
            Kirim Laporan
        </button>
    </form>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Laporan</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded-lg overflow-hidden">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Pelapor</th>
                    <th class="p-2 text-left">Lokasi</th>
                    <th class="p-2 text-left">Deskripsi</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(mysqli_num_rows($result) == 0): ?>
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Belum ada laporan
                        </td>
                    </tr>
                <?php else: ?>
                    <?php while($r = mysqli_fetch_assoc($result)): ?>
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-2">
                            <?= date('d/m/Y H:i', strtotime($r['created_at'])) ?>
                        </td>

                        <td class="p-2 font-medium">
                            <?= htmlspecialchars($r['nama_pelapor']) ?>
                        </td>

                        <td class="p-2">
                            <?= htmlspecialchars($r['lokasi']) ?>
                        </td>

                        <td class="p-2">
                            <?= htmlspecialchars($r['deskripsi']) ?>
                        </td>

                        <td class="p-2">
                            <span class="<?= badge($r['status']) ?> px-2 py-1 rounded text-xs">
                                <?= $r['status'] ?>
                            </span>
                        </td>

                        <td class="p-2">
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <form action="update_status.php" method="POST" class="flex gap-1">
                                    <input type="hidden" name="id" value="<?= $r['id'] ?>">

                                    <select name="status" class="border rounded p-1 text-xs">
                                        <option <?= $r['status']=='Pending'?'selected':'' ?>>Pending</option>
                                        <option <?= $r['status']=='Diproses'?'selected':'' ?>>Diproses</option>
                                        <option <?= $r['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                                    </select>

                                    <button class="bg-red-600 text-white px-2 rounded text-xs hover:bg-red-800">
                                        Update
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs italic">Admin only</span>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

</div>

</body>
</html>