# AplikasiSKM
Aplikasi SKM Dinas Kesehatan Pengendalian Penduduk Keluarga Berencana

## Cara Run Secara Lokal di xampp
### 1. buka terminal dan clone github ini di htdocs
```
git clone https://github.com/Ilhamsahid/AplikasiSKM
```
### 2. buka direktori ini C:\xampp\apache\conf\extra lalu buka httpd-vhosts.conf di notepad
### 3. tambahkan kode ini di httpd-vhost.conf
```
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/xampp/htdocs/AplikasiSKM/public"

    <Directory "C:/xampp/htdocs/AplikasiSKM/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
### 4. buka xampp lalu aktifkan apache dan mysql
### 5. buka browser dan ketik localhost lalu aplikasi skm harusnya bisa berjalan, pastikan jangan lupa eksport database ke phpmyadmin
