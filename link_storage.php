<?php

// Konfigurasi Path (Sesuaikan jika struktur folder hosting Anda berbeda)
// Asumsi:
// 1. File ini diupload ke 'public_html'
// 2. Folder aplikasi Laravel ada di '../laravel_app' (sejajar dengan public_html)
// 3. Folder storage target ada di '../laravel_app/storage/app/public'

$targetFolder = __DIR__ . '/../laravel_app/storage/app/public';
$linkFolder = __DIR__ . '/storage';

echo "<h1>Perbaikan Symlink Storage</h1>";
echo "<p>Target Folder (Asli): <code>" . $targetFolder . "</code></p>";
echo "<p>Link Folder (Shortcut): <code>" . $linkFolder . "</code></p>";

// 1. Cek apakah folder Target Asli benar-benar ada
if (!file_exists($targetFolder)) {
    die("<h3 style='color:red'>ERROR: Folder target tidak ditemukan!</h3>
         <p>Pastikan path <code>../laravel_app/storage/app/public</code> benar.</p>");
}

// 2. Cek apakah shortcut 'storage' di public_html sudah ada
if (file_exists($linkFolder)) {
    echo "<p>Shortcut 'storage' sudah ada.</p>";
    
    // Jika itu symlink, kita hapus dulu biar bersih
    if (is_link($linkFolder)) {
        echo "<p>Menghapus symlink lama...</p>";
        unlink($linkFolder);
    } 
    // Jika itu folder biasa (kadang terjadi kalau salah copy), coba hapus (hati-hati)
    elseif (is_dir($linkFolder)) {
        echo "<p>Folder 'storage' yang ada bukan symlink, mencoba menghapus (pastikan folder ini kosong/salah)...</p>";
        // rmdir hanya bisa hapus folder kosong. Jika isi file, harus manual via File Manager
        if (@rmdir($linkFolder)) {
            echo "<p>Folder lama berhasil dihapus.</p>";
        } else {
            die("<h3 style='color:red'>GAGAL: Tidak bisa menghapus folder 'storage' yang sudah ada.</h3>
                 <p>Silakan hapus folder 'public_html/storage' secara manual lewat File Manager cPanel, lalu refresh halaman ini.</p>");
        }
    }
}

// 3. Buat Symlink Baru
if (symlink($targetFolder, $linkFolder)) {
    echo "<h3 style='color:green'>SUKSES: Symlink berhasil dibuat!</h3>";
    echo "<p>Sekarang coba akses file/gambar di website Anda.</p>";
    echo "<p><strong>PENTING:</strong> Segera hapus file <code>link_storage.php</code> ini setelah selesai demi keamanan.</p>";
} else {
    echo "<h3 style='color:red'>GAGAL: Tidak bisa membuat symlink.</h3>";
    echo "<p>Kemungkinan fungsi <code>symlink()</code> dinonaktifkan oleh hosting atau izin folder tidak sesuai.</p>";
}
