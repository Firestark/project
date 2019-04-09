# Firestark

Firestark is a **non mvc PHP7 framework: Firestark**.
An example project can be found [here](https://github.com/firestark/goalstark)


## Getting started

1. Setup a virtual host pointing to the index.php inside the client directory.
2. In client/index.php correct the 'base url' on line 13 (currently it's: 'http://firestark-project').
3. Make sure the app can write inside the client/storage directory.
3. Run composer install inside the client directory.


### Example nginx vhost

```nginx
server {
    listen 80;
    listen [::]:80;

    server_name goalstark www.goalstark;

    root /home/username/Documents/goalstark®/client;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
    }
}
```