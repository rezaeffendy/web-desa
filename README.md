## Cara Installasi

- **Buka Git Bash**
- **Download Repository Ta Desa Krimun**
```
git clone https://github.com/hakim-asrori/Ta-Desa-Krimun.git
```
- **Masuk directory Ta-Desa-Krimun**
```
cd Ta-Desa-Krimun
```
- **Installasi Resource Proyek**
```
composer install
```
- **Copy file .env.example ke .env**
```
cp .env.example .env // copy paste file .env.example ke .env
```
- **Edit file .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_databse
DB_USERNAME=root
DB_PASSWORD=
```
- **Tambahkan diakhir file .env**
```
FILESYSTEM_DISK=public
```
- **Migrate table-table ke database**
```
php artisan migrate:fresh --seed
```
- **Generate Key**
```
php artisan key:generate
```
- **Jalankan serve laravel**
```
php artisan serve
```
