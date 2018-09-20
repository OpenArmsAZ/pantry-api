#!/usr/bin/env bash

cd /app

## Drop the database scheme (drop all tables)
php doctrine orm:schema-tool:drop --force

## Create the database schema. (create all tables)
php doctrine orm:schema-tool:create

php doctrine orm:generate-proxies

cd /app/database

## Populate with Sandbox data
php seed.php