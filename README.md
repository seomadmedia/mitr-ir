<VirtualHost *:80>
    ServerName mitr.ir
    DocumentRoot "c:/wamp64/www/mitr.ir"
    <Directory "c:/wamp64/www/mitr.ir/">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
