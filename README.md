# mig-platform

Migration For `platform` Database

# Installation

`composer install` and `cp .env.example .env`

# Usage

1. Create database `platform` on local first.
2. vendor/bin/phinx migrate` create empty table.
3. vendor/bin/phinx seed:run` insert default data.
4. vendor/bin/phinx rollback -t 0` rollback all migrate.
