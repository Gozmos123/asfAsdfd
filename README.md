# Barangay Health Information System

This project is created using PHP. This is a remake of the existing capstone Barangay Health Information System

## Downloading

Follow the instructions below on how to download the project and get started.

### Clone the repo.

Download the project by cloning the repo or download the zip file.

```bash
git clone https://github.com/Jovi9/rep-bhis.git
```

```bash
cd rep-bhis
```

After downloading, go inside the directory and run the following commands.

### Configure the database connection.

Copy the Database.env inside the model folder to Database.php and configure the connection.

```bash
cp model/Database.env model/Database.php
```

### Login to your mysql server and import the dump file inside the _includes/bhis_dump folder.

Choose which file you prefer to use. The bhis_mysqlDump_CreateDB.sql or bhis_mysqlDump_NoCreateDB.sql can be used if you are using MySQL Workbench, bhis_phpmyadmin_dump.sql can be used if you are using phpMyAdmin, or you can entirely create the database whether you are using MySQL Workbench or phpMyAdmin by running the bhis.sql

### Serve the project

Start apache web server and enter the url from the address bar and see the default_accounts.txt inside the _includes/bhis_dump folder for the default user accounts.

```bash
localhost/rep-bhis
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
