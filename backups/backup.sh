#!/bin/bash

# database credentials
user="root"
password="it490"
host="127.0.0.1"
db_name="login"

# Other options
backup_path="/home/ekoshykar/git/it490f17/backups"
date=$(date +" %m %d %Y")

#set default file permissions
umask 177

#dump database into sql file
#dump = "--user=$user --password=$password --host=$host $db_name > $backup_path/$db_name-$date.sql"
echo $date
mysqldump -u 'root' -p'it490' login > /home/ekoshykar/git/it490f17/backups/"login-$date.sql"



#mysqldump --user=$user --password=$password --host=$host $db_name > $backup_path/$db_name-$date.sql

#delete files older than 30 days
find $backup_path/* -mtime +30 -exec rm {} \;
