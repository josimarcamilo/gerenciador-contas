html, css, javascript, php, docker, aws, nginx, mysql, redis

https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04-pt

https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-pt


sudo ln -s /etc/nginx/sites-available/sitecontas /etc/nginx/sites-enabled/


nginx:
    image: nginx
    volumes:
        - ./nginx:/usr/share/nginx/html