# mig-platform

Migration For `platform` Database

# Installation

`composer install` and `cp .env.example .env`

# Usage

1. Create database `platform` on local first.
1. `vendor/bin/phinx migrate` create empty table.
1. `vendor/bin/phinx seed:run` insert default data.
1. `vendor/bin/phinx rollback -t 0` rollback all migrate.
