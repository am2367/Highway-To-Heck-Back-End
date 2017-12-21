#!/bin/bash

# database credentials
user="root"
password="it490"
host="127.0.0.1"
db_name="login"

# Other options
backup_path="/home/prod/git/it490f17/backups"
date=$(date +"%m%d%Y")

#set default file permissions
umask 177

#dump database into sql file


mysqldump --user=$user --password=$password $db_name> $backup_path/"login-$date.sql"


#send backup files to deployment server
sshpass -p "it490" scp "login-$date.sql" QA@192.168.0.107:/home/QA/git/it490f17/backups
echo sshpass -p "it490" scp "login-$date.sql" QA@192.168.0.107:/home/QA/git/it490f17/backups
#echo "login-$date.sql"

#delete files older than 30 days
find $backup_path/* -mtime +30 -exec rm {} \;
