#!/bin/bash
if [[ -f panel.sql ]]; then
  rm panel.sql
fi

if [[ -f .env.example ]]; then
  rm .env.example
fi
DB_NAME="panel"
TEMP_DB_NAME="panel_temp"
mysql -u root -e "CREATE DATABASE $TEMP_DB_NAME;"
TABLES="$(mysql -u root -N -B -e "SHOW TABLES IN $TEMP_DB_NAME")"
for TABLE in $TABLES; do
  mysql -u root -e "DELETE FROM $TEMP_DB_NAME.$TABLE;"
done
mysqldump -u root --no-data "$DB_NAME" | mysql -u root "$TEMP_DB_NAME"
mysqldump -u root "$TEMP_DB_NAME" | sed '/^--/d; /^\/\*![0-9]\{5\}.*\*\//d; /^SET/d' > panel.sql
mysql -u root -e "DROP DATABASE $TEMP_DB_NAME;"
touch .env.example
while IFS= read -r line; do
  if [[ $line == *"="* ]]; then
    var_name="${line%=*}"
    var_value="${line#*=}"
    line="${var_name}=\"\""
    if [[ $var_value == \"*\" ]]; then
      line="${var_name}=${var_value}"
    fi
  fi
  echo "$line" >> .env.example
done < .env