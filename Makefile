phinx := ./vendor/bin/phinx

.PHONY: rollback migrate seed reset

rollback:
	$(phinx) rollback -t 0

migrate:
	$(phinx) migrate

seed:
	$(phinx) seed:run

reset: rollback migrate seed
