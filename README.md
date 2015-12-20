# clean-backups

You can setup mysql database backups using crontab command
```
/usr/bin/mysqldump -u MYSQL_USER_HERE -pMYSQL_PASSWORD_HERE_WITHOUT_SPACE MYSQL_DATABASE_HERE | gzip > /root/Dropbox/database_backups/PROJECT_PREFIX_$(date +\%y_\%m_\%d_\%H).sql.gz
```
