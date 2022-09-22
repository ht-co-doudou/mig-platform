phinx := ./vendor/bin/phinx
env := local

.PHONY: rollback migrate seed reset

rollback:
	$(phinx) rollback -t 0

migrate:
	$(phinx) migrate --environment=$(env)

seed:
	$(phinx) seed:run --environment=$(env)

reset: rollback migrate seed

createMigrate:
	$(phinx) create $(class)

createSeed:
	$(phinx) seed:create $(class)
