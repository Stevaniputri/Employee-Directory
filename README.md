# Employee Directory Management

## Setup Project
1. Clone repository ini.
2. Jalankan `composer install`.
3. Copy file `.env.example` ke `.env` dan sesuaikan konfigurasi database.
4. Jalankan `php artisan key:generate`.
5. Jalankan migrasi dan seeding: `php artisan migrate --seed`.

## Import Database
1. Gunakan tool seperti phpMyAdmin atau command line untuk mengimpor file `backup_file.sql` ke dalam database yang sudah dibuat.

## Fitur
### a. Menampilkan List Employee
- Halaman ini menampilkan daftar karyawan dengan fitur sorting, searching, dan paging menggunakan jQuery DataTables.

### b. Melihat Data Setiap Employee
- Klik tombol "Show" pada baris data karyawan untuk melihat rincian data karyawan tersebut.

### c. Menambah Data Employee Baru
- Klik tombol "Add New Employee" untuk membuka form kosong.
- Isi form sesuai validasi dan klik "Save" untuk menyimpan data.

### d. Mengubah Data Employee
- Klik tombol "Edit" pada baris data karyawan untuk mengubah data karyawan tersebut.
- Edit data sesuai kebutuhan dan klik "Save" untuk menyimpan perubahan.

### e. Menghapus Data Employee
- Klik tombol "Delete" pada baris data karyawan untuk menghapus data karyawan tersebut.
- Konfirmasi penghapusan di dialog yang muncul.

## Kontak
Untuk informasi lebih lanjut, hubungi andy.wijaya@agilis.id.
