mysql \
  --user="root" \
  --password="$MYSQL_PASSWORD" \
  --execute="CREATE DATABASE ${MYSQL_DATABASE}_test;
             GRANT ALL PRIVILEGES ON ${MYSQL_DATABASE}_test.* TO $MYSQL_USER@'%';
             FLUSH PRIVILEGES;"
