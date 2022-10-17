html, css, javascript, php, docker, aws, nginx, mysql, redis

https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04-pt

https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-pt


sudo ln -s /etc/nginx/sites-available/sitecontas /etc/nginx/sites-enabled/

docker compose up --scale app=3

sudo yum-config-manager     --add-repo     https://download.docker.com/linux/centos/docker-ce.repo

sudo curl -L "https://github.com/docker/compose/releases/download/2.7.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

Rodei na aws
sudo chown $USER /var/run/docker.sock