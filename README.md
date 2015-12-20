# clean-backups

You can setup mysql database backups using crontab command
```
/usr/bin/mysqldump -u MYSQL_USER_HERE -pMYSQL_PASSWORD_HERE_WITHOUT_SPACE MYSQL_DATABASE_HERE | gzip > /root/Dropbox/mysql_backups/PROJECT_PREFIX/PROJECT_PREFIX_$(date +\%y_\%m_\%d_\%H).sql.gz
```

You will get all mysql backups in folder like /root/Dropbox/mysql_backups/MyProject/ with names like MyProject_15_12_20_13.sql.gz
