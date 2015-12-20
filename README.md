# clean-backups

You can setup mysql database backups using crontab command
```
/usr/bin/mysqldump -u MYSQL_USER_HERE -pMYSQL_PASSWORD_HERE_WITHOUT_SPACE MYSQL_DATABASE_HERE | gzip > /root/Dropbox/mysql_backups/PROJECT_PREFIX/PROJECT_PREFIX_$(date +\%y_\%m_\%d_\%H).sql.gz
```

You will get all mysql backups in folder like /root/Dropbox/mysql_backups/MyProject/ with names like MyProject_15_12_20_13.sql.gz

In order to cleanup dropbox backups you will need to setup cleanup script

```
cd /root/Dropbox/mysql_backups/
wget https://raw.githubusercontent.com/zhil/clean-backups/master/cleanup_backups.php
```

and put it on crontab, like
```
php /root/Dropbox/mysql_backups/cleanup_backups.php  dir=/root/Dropbox/mysql_backups/zqteam prefix=zqteam_
```
