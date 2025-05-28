# AWS_Docker_Dynamic_Web_Hosting
This project runs two Docker containers on a single EC2 instance—one for the database and another for WordPress—with real-time data synchronization between them.



### Setup Guide ### 

Step 1: Create Docker Network and Containers. Add both the containers in the same network.
#  
  docker network create network_name
# MySQL Container
#
  docker run -d --name mysql_container \
  -e MYSQL_ROOT_PASSWORD=db_password \
  -e MYSQL_DATABASE=db_name \
  --network my_network mysql
# WordPress Container
#
  docker run -d --name wordpress_container \
  -e WORDPRESS_DB_HOST=mysql_container \
  -e WORDPRESS_DB_USER=root \
  -e WORDPRESS_DB_PASSWORD=db_password \
  -e WORDPRESS_DB_NAME=db_name \
  --network my_network -p 80:80 wordpress

Step 2: Verify Setup 
# 
  docker ps -a
  docker network inspect my_network
Open your EC2 public IP in a browser: http://<your-ec2-public-ip> → WordPress setup page should appear.

Step 3: Create Custom Web Page with Database Integration
Connect to the mysql container using "exec". Use databasae that is created above and run the table creation command. Please refer "DB_Creation.mysql" file for commands.

Connect to WordPress container:
# 
  docker exec -it wordpress_container bash
  cd /var/www/html
  apt update
  apt install nano -y
  rm -r index.php

Create your custom files:
# 
  nano index.html
  nano style.css
  nano login.php
Paste your respective HTML, CSS, and PHP code into these files.

Step 4: Access Your Web Page
Open in browser: http://<your-ec2-public-ip>/index.html
