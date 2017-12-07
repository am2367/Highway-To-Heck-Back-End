#!/bin/bash


#this file will start selected running scripts, then restart them along with a few services.


#kill processes
ps -ef | grep testRabbitMQServer.php |grep -v grep | awk '{print $2}' | xargs kill -9


ps -ef | grep dmz.php |grep -v grep | awk '{print $2}' | xargs kill -9


ps -ef | grep dbListener.php |grep -v grep | awk '{print $2}' | xargs kill -9


#restart apache2 service & rabbitmq-server
service apache2 restart

service rabbitmq-server restart


#restart the previously killed scripts
./testRabbitMQServer.php . &

./dmz.php . &

./dbListener.php . &


