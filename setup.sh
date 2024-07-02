#!/bin/bash

# Demander les informations de connexion à la base de données
read -p "Enter the MySQL server host (e.g., localhost): " db_host
read -p "Enter the MySQL root username: " db_root_user
read -sp "Enter the MySQL root password: " db_root_password
echo ""
read -p "Enter the name of the new database to create: " db_name
read -p "Enter the new database username: " db_user
read -sp "Enter the new database password: " db_password
echo ""

# Vérifier la connexion à la base de données
mysql -h "$db_host" -u "$db_root_user" -p"$db_root_password" -e "QUIT"
if [ $? -ne 0 ]; then
    echo "Failed to connect to the MySQL server with the provided credentials."
    exit 1
fi

# Créer la nouvelle base de données
mysql -h "$db_host" -u "$db_root_user" -p"$db_root_password" -e "CREATE DATABASE $db_name;"
if [ $? -ne 0 ]; then
    echo "Failed to create the database $db_name."
    exit 1
fi

# Créer le nouvel utilisateur et lui donner les privilèges sur la nouvelle base de données
mysql -h "$db_host" -u "$db_root_user" -p"$db_root_password" -e "CREATE USER '$db_user'@'%' IDENTIFIED BY '$db_password';"
mysql -h "$db_host" -u "$db_root_user" -p"$db_root_password" -e "GRANT ALL PRIVILEGES ON $db_name.* TO '$db_user'@'%';"
mysql -h "$db_host" -u "$db_root_user" -p"$db_root_password" -e "FLUSH PRIVILEGES;"
if [ $? -ne 0 ]; then
    echo "Failed to create the user $db_user or grant privileges."
    exit 1
fi

# Importer le fichier SQL dans la nouvelle base de données
mysql -h "$db_host" -u "$db_user" -p"$db_password" "$db_name" < database.sql
if [ $? -ne 0 ]; then
    echo "Failed to import database.sql into the database $db_name."
    exit 1
fi

# Mettre à jour le fichier JSON avec les nouvelles informations de connexion
config_file="config/config.json"
cat > $config_file <<EOL
{
    "servername": "$db_host",
    "username": "$db_user",
    "password": "$db_password",
    "dbname": "$db_name"
}
EOL

echo "Setup complete. Database and user have been created, database.sql has been imported, and db_config.json has been updated."

exit 0
