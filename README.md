# PHP Challenge

This project contain the backend app for "PHP Challenge"

## Brief Description:
Your customer receives two XML models from his partner. This information must be
available for both web system and mobile app. XML content can be very extensive and we must
ensure the content will be fully processed.

## The challenge:
Create an application to manually upload the given XMLs and have an option
to asynchronously process them. The results of the processed data must be logged. Make the
processed information available via rest APIs.

# Installation

For running this project you need to install Docker and Docker Swarm Cluster(if you don't want to running with Docker swarm, just running in docker-compose).

The steps below are for the Ubuntu 20.04
```shell

# To install docker on linux ubuntu
curl -sSL https://get.docker.com/ | sh
sudo usermod -aG docker <you user>

# Reboot your pc

# Disabled IPV6
sudo vim /etc/sysctl.conf

# Add this lines on the end of the file sysctl.conf
net.ipv6.conf.all.disable_ipv6 = 1
net.ipv6.conf.default.disable_ipv6 = 1
net.ipv6.conf.lo.disable_ipv6 = 1

# For activate running the command bellow
sudo sysctl -p

# Now lets init docker swarm
docker swarm init

# For init the project running the command bellow
docker stack deploy --compose-file docker-compose.yml challenge

# For stop the project
docker stack rm challenge

```


