# Task 2 Solution

## install nginx and php
```bash
sudo apt install nginx php-fpm php-cli 
systemctl start nginx
systemctl start 
```


## Create PHP application
> /var/www/html/task2/DateTime.php

```
<?php
date_default_timezone_set('Africa/Cairo');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cairo Date & Time</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            padding: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
        }
        .time { font-size: 3em; color: #fff; margin: 20px 0; }
        .date { font-size: 1.8em; color: #f0f0f0; margin: 10px 0; }
        .info { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; margin: 20px 0; }
        a { color: #fff; text-decoration: none; padding: 10px 20px; background: rgba(255,255,255,0.2); border-radius: 5px; }
    </style>
    <meta http-equiv="refresh" content="1"> <!-- Auto-refresh every second -->
</head>
<body>
    <h1>🕐 Cairo Time Zone</h1>
    <div class="time"><?= date('H:i:s') ?></div>
    <div class="date"><?= date('l, F j, Y') ?></div>
    
    <div class="info">
        <p><strong>Server timezone:</strong> <?= date_default_timezone_get() ?></p>
        <p><strong>Unix timestamp:</strong> <?= time() ?></p>
        <p><strong>24-hour format:</strong> <?= date('H:i:s') ?></p>
        <p><strong>12-hour format:</strong> <?= date('h:i:s A') ?></p>
    </div>
    
    <a href="<?= $_SERVER['PHP_SELF'] ?>">Manual Refresh</a>
</body>
</html>

```


## Create the Configuration file for Nginx

> /etc/nginx/conf.d/task2.conf

```
server {

    listen 85;
    listen 89;

    server_name task2.com localhost;

    root /var/www/html/task2;
    index DateTime.php;


    location /Screenshots/ {
        root /var/www/html/task2;
        expires 30d;
        add_header Cache-Control "public";
        gzip on;
        gzip_types image/png image/jpeg image/gif;
   }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        #fastcgi_pass 127.0.0.1:9089;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

`listen 89;` and `listen 85;` used to configure nginx to listen on port 85 and 89

`server_name task2.com localhost;` assign the domain name for the server
 _echo "127.0.0.1" task2.com >>etc/hosts_ #for accessing the application from the
 web-browser using task2.com:_PortNum_


`root /var/www/html/task2;` the root directory for Nginx to access the files _DateTime.php ,Screenshots/_

`index task2.html DateTime.php;` the default index files

`location /Screenshots/` allow accessing the content of Screenshots directory from the browser 

`expires 30d;`  and `add_header Cache-Control "public";`  allow caching for 30 days

`gzip on;` active gzip 
`gzip_types image/png image/jpeg image/gif;` define gzip_types


`location ~ \.php$`  allow nginx to run php application

`fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;`  Run the php application on nginx using socket

to run the application using _port_ uncomment *#fastcgi_pass 127.0.0.1:9089;* in the _task2.conf_ file
