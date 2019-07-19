## For reset github (Andy)
$ git branch
$ git remote rm origin
$ git remote add origin https://github.com/andysarbini/new_hris.git
$ git add .
$ git commit -m "update form kantor dropdown provinsi-kabupaten"
$ git pull --rebase origin master
$ git push origin master

git reset --mixed origin/master
git add .
git commit -m "This is a new commit for what I originally planned to be amended"
git push origin master

## How To Use

- git clone https://github.com/g3n1k/new_hris.git
- Change or Add Connections File in Database.php
- Running this Apps On your Browsers

## cara mengetest template
buat sebuah file baru di ````web/cms/modules/foo/views/````  

ex: **form_data_karyawan.php**

lalu buka browser dengan url 
http://url/foo/template/nama_file_tanpa_ext_php
````
http://localhost/foo/template/form_data_karyawan
````

## setting HTTPS

### docker
create new certificate in local linux
````
cd hris_new/sys/php
sudo openssl req -x509 -days 365 -newkey rsa:2048 -keyout ./localhost.key -out ./localhost.crt

Generating a RSA private key
....................................................+++++
.......................................................+++++
writing new private key to './localhost.key'
Enter PEM pass phrase:
Verifying - Enter PEM pass phrase:
-----
You are about to be asked to enter information that will be incorporated
into your certificate request.
What you are about to enter is what is called a Distinguished Name or a DN.
There are quite a few fields but you can leave some blank
For some fields there will be a default value,
If you enter '.', the field will be left blank.
-----
Country Name (2 letter code) [AU]:ID
State or Province Name (full name) [Some-State]:DKI JAKARTA
Locality Name (eg, city) []:JAKARTA
Organization Name (eg, company) [Internet Widgits Pty Ltd]:Company 
Organizational Unit Name (eg, section) []:Company
Common Name (e.g. server FQDN or YOUR name) []:localhost
Email Address []:g3n1k@yahoo.com

````
change the owner to user
````
sudo chown g3n1k localhost.*
````
crate new config file ```nano sys/php/https.conf```
````
Listen 443
<VirtualHost *:443>
    ServerName localhost
    DocumentRoot /var/www/html
    SSLEngine on
    SSLCertificateFile "/etc/apache2/sites-available/localhost.crt"
    SSLCertificateKeyFile "/etc/apache2/sites-available/localhost.key"
    <Directory /var/www/html>
        AllowOverride all
    </Directory>
</VirtualHost>
````
add config to `sys/php/Dockerfile`
````
ADD localhost.key /etc/apache2/sites-available/
ADD localhost.crt /etc/apache2/sites-available/
ADD https.conf /etc/apache2/conf-available/
````
rebuild conf
````
docker-compose down
docker-compose build
docker-compose up -d
````
## Contributing

Thank you for considering contributing to the HRIS INCONIS! The contribution guide can be found in the Application documentation.
Team Smartelco 2019 PT Smartelco Solusi Teknologi

## License

This Apps is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
