<p align="center"><a href="https://syifa-laundry.com/" target="_blank"><img src="./public/img/icon/logo.png" width="400" alt="laudry app logo"></a></p>

## Tech

- [PHP](https://www.php.net/) - popular general-purpose scripting language that is especially suited to web development.

- [XAMPP](https://www.apachefriends.org/download.html) - XAMPP is an easy to install Apache distribution containing MariaDB, PHP, and Perl. Just download and start the installer. It's that easy.

OR

- [LARAGON](https://laragon.org/docs/) - LARAGON Laragon is a portable, isolated, fast & powerful universal development environment for PHP, Node.js, Python, Java, Go, Ruby. It is fast, lightweight, easy-to-use and easy-to-extend.

- [VSCODE](https://code.visualstudio.com/) - Code editing. Redefined.Free. Built on open source. Runs everywhere.

- [GOOGLE CHROME](https://www.google.com.sg/?hl=id) - The Browser built by Google.

## Requirement

- XAMPP v3.30
- LARAGON V3.1.7
- PHP 8.0.1
- VSCODE 1.8.0
- Powershell 5.1.2

## Structure

```
📦laundry
 ┣ 📂app
 ┣ 📂public
 ┣ 📂vendor
 ┣ 📜.env
 ┣ 📜.gitignore
 ┣ 📜.htaccess
 ┣ 📜.composer.json
 ┣ 📜.composer.lock
 ┣ 📜.readme.md
 ┗ 📜run.php
```

## installation

- !! ubah .env dan sudah memasukan ke dalam database file db_laundry.sql nya

### 1. RUNNING WITH PHP

- !!! pastika php sudah ada di environment variabel

lalu jalankan di terminal

```
php run.php

```

### 2. RUNNING WITH XAMPP

- simpan di dalam folder htdocs lalu BASEURL di .env sesuaikan dengan url htdocs nya

### 3. RUNNING WITH LARAGON

- sama dengan yang di xampp url nya saja yang di ganti (jika menggunakan laragon maka sesuaikan .test nya di .env dengan nama foldernya)
