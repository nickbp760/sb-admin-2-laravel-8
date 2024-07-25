## CHIKADMIN
<p><b>
CHIKADMIN adalah simpel starter untuk laravel dengan template sb-admin-2 , keuntungan CHIKADMIN adalah kita tidak perlu memulai integrasi,sistem login autorisasi dari awal.
</b></p>

## Instalasi
- download zip <a href="https://github.com/rahmathidayat9/sb-admin-2-laravel-8/archive/master.zip">disini</a> 
- atau clone : git clone https://github.com/rahmathidayat9/sb-admin-2-laravel-8.git

## Setup
- buka direktori project di terminal anda.
- ketikan command : cp .env.example .env (copy paste file .env.example)
- buat database dengan nama laravel_sb_admin_2 (bebas)
- buka file .env dengan teks editor , edit bagian DB_DATABASE= menjadi DB_DATABASE=laravel_sb_admin_2 
(sesuaikan dengan nama database yang anda buat)

Lalu ketik command dibawah ini : 

- composer install
- php artisan optimize:clear 
- php artisan key:generate (generate app key)
- php artisan migrate (migrasi database)
- php artisan db:seed --class=UserClass (mengisi data table users) atau bisa juga php artisan db:seed (semua tabel)

## Login
- Email : admin@gmail.com
- Password : password

## Fitur
- Autentikasi dengan Laravel Auth
- Autorisasi dengan Laravel Gate
- Yajra DataTable Serverside
- jquery ajax crud dengan datatable serverside example

## Preview

<b>- Home<b>

<a href="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(837).png?raw=true">
<img src="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(837).png?raw=true">
</a>
<br><br>

<b>- Login<b>

<a href="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(803).png?raw=true">
	<img src="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(803).png?raw=true">
</a>
<br><br>

<b>- Dashboard<b>

<a href="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(830).png?raw=true">
	<img src="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(830).png?raw=true">
</a>
<br><br>

<b>- Profile<b>

<a href="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(831).png?raw=true">
	<img src="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(831).png?raw=true">
</a>
<br><br>

<b>- Yajra Crud Datatable<b>

<a href="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(805).png?raw=true">
	<img src="https://github.com/rahmathidayat9/readme-images/blob/master/laravel-sb-admin-2/Screenshot%20(805).png?raw=true">
</a>
<br><br>


## RUN IN UBUNTU 20.04

# update system
sudo apt-get update
sudo apt-get upgrade
# install php
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php8.2 php8.2-cli php8.2-mysql php8.2-pgsql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip

# clone repo
git clone https://github.com/nickbp760/sb-admin-2-laravel-8.git
cd sb-admin-2-laravel-8/
sudo apt install composer
composer update
composer install


# install postgress
sudo apt-get install postgresql postgresql-contrib
sudo service postgresql start
sudo -i -u postgres
	psql
		ALTER USER postgres PASSWORD 'new_password';
	\q
exit

# access postgress
sudo nano /etc/postgresql/12/main/postgresql.conf
change listen_addresses = '*'

sudo nano /etc/postgresql/12/main/pg_hba.conf
add host    all             all             0.0.0.0/0               md5

sudo service postgresql restart
hostname -I
