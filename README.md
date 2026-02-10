hSistem Manajeman dan Stok Toko Sederhana
Kelompok 8
- Dimas Rizqi Fauzan
- Tiara Putri Anastasya
- M. Fathir AL Fath

  Dekripsi umum:
  Sistem ini menjelaskan gambaran umum dan rancangan teknis Sistem Informasi Point of Sale (POS) berbasis web sebagai solusi pendukung proses transaksi penjualan. Sistem dirancang untuk mengelola data barang, transaksi penjualan, serta penyajian laporan secara terintegrasi dan efisien. Dokumentasi ini menjadi pedoman bagi pengembang dan pengelola dalam memahami struktur, modul, serta alur kerja aplikasi. Sistem mendukung dua jenis pengguna, yaitu Owner dan Kasir, dengan hak akses berbeda sesuai peran masing-masing.
  Point of Sale (POS)
  Sistem yang digunakan untuk mencatat transaksi penjualan dan mengelola data terkait secara terkomputerisasi.Melibatkan beberapa entitas, yaitu : 
  - Owner : Pengguna dengan hak akses penuh terhadap sistem, termasuk pengelolaan data barang, karyawan, dan laporan.
  - Kasir : Pengguna yang bertugas melakukan transaksi penjualan dan mengoperasikan sistem pada saat proses penjualan berlangsung.
  - Barang : Produk atau item yang tersedia untuk dijual melalui sistem POS.
  - Transaksi : Aktivitas penjualan barang yang dilakukan oleh kasir dan dicatat ke dalam sistem.
  - Laporan Penjualan : Informasi rekapitulasi transaksi yang digunakan untuk evaluasi dan pengambilan keputusan.
  Tujuan utama sistem ini adalah:
    1. Membantu proses transaksi penjualan secara cepat dan efisien
    2. Mengelola data barang dan stok secara otomatis danakurat 
    3. Menyediakan laporan penjualan untuk evaluasi bisnis
    4. Meningkatkan akurasi pencatatan data
    5. Menerapkan konsep Rekayasa Perangkat Lunak dan OOP (Object-Oriented Programming)
  
  1. Arsitektur Sistem
     Sistem menggunakan arsitektur Three-Tier Architecture:
     - Presentation Layer (UI)
     - Application Layer (Logic PHP + MVC)
     - Data Layer (MySQL Database)
  2. Design Pattern yang diterapkan:
     - MVC Pattern
     - Singleton (Database Connection)
     - Factory
     - Dependency Injection
  3. Struktur Database (Ringkas)
     Beberapa tabel utama:
     - user
     - barang
     - transaksi
     - detail_transaksi
     - karyawan
     - supplier
    Relasi:
     - 1 user → banyak transaksi
     - 1 transaksi → banyak detail transaksi
     - detail transaksi → terhubung ke barang
  4. Tampilan Sistem
     Fitur halaman:
     - Login
     - Dashboard
     - Manajemen Barang
     - Transaksi Penjualan
     - Laporan Penjualan
     - Manajemen Karyawan


  https://sg.docworkspace.com/d/sbCairtDqC7dNuPz_vw9uv052bw9mrk9ezw?sa=601.1074
  
    
