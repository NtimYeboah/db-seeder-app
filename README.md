## DB Seeder App

A PHP console application to seed database with data.

## Installation and Setup

Clone this repository by running
```bash
$ git clone https://github.com/NtimYeboah/db-seeder-app.git
```
Install the packages by running the composer install command
```bash
$ composer install
```

Set your database connection values in the `.env` file

Seed the database
```base
$ php application db:seed
```

Inspect that the `users` table of the database has 20 rows.