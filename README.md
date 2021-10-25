# E-Progress

Aplikasi pengelolaan data mahasiswa anggota UKM Progress sederhana.

## Daftar Isi 🗂️

- [E-Progress](#e-progress)
	- [Daftar Isi 🗂️](#daftar-isi-️)
	- [Instalasi 🪛](#instalasi-)
	- [Penggunaan ⚙️](#penggunaan-️)
	- [Kontribusi 🌱](#kontribusi-)
	- [Isu 📢](#isu-)
	- [Lisensi ⚖️](#lisensi-️)

## Instalasi 🪛

Sebelum menjalankan aplikasi, ada beberapa tahapan instalasi agar
aplikasi dapat berjalan dengan baik.

Pertama-tama kita harus meng-install dependencies yang ada pada
`composer.json` dengan menggunakan command dibawah ini.

```shell
composer install && composer dump-autoload
```

> Pastikan kalian telah memiliki `composer`
> terinstall sebelumnya.

Sebelum melakukan migrasi file SQL, saya menyarankan
mengubah file konfigurasi database pada
`config/database.php` karena konfigurasi server tiap
komputer mungkin saja berbeda.

Selain itu, saya sarankan untuk membuat database dengan
nama yang sesuai dengan yang anda tulis pada konfigurasi
diatas.

Barulah kita memigrasikan file SQL yang ada pada root folder kita dengan nama file `migration.sql`.

Selesai, kalian bisa menggunakan aplikasi dengan damai
dan sedikit eksperimen.

## Penggunaan ⚙️

Untuk penggunaan saya serahkan pada kalian, agar sedikit
bereksperimen dengan aplikasinya. Namun, untuk kelengkapan
fitur masih sangat-sangat kurang. Kedepannya mungkin akan
dilengkapkan, CRUD sudah pasti terlaksana. Selamat mencoba! 🔥🔥🔥

## Kontribusi 🌱

Jika kalian ingin berkontribusi pada repository ini, kalian bebas melakukan `fork` dan `push`.

## Isu 📢

Jika ada isu atau bug terkait dengan aplikasi ini jangan
ragu untuk email ke ini.wipaaa@gmail.com atau kalian bisa
menulis [issue](https://github.com/wipaaa/php-eprogress/issues) disini.

## Lisensi ⚖️

Tidak ada lisensi yang berlaku, alias Open Source.
