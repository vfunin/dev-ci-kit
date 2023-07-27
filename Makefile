.PHONY: ci infection test deptrac rector cs psalm gst gcmsg
ci:
	docker compose run --rm application vendor/bin/grumphp run

infection:
	docker compose run --rm application vendor/bin/infection --test-framework=pest

test:
	docker compose run --rm application vendor/bin/pest --coverage

deptrac:
	docker compose run --rm application vendor/bin/deptrac analyse --cache-file='var/.cache/deptrac/.deptrac.cache'

rector:
	docker compose run --rm application vendor/bin/rector process --dry-run

cs:
	docker compose run --rm application vendor/bin/phpcs

psalm:
	docker compose run --rm application vendor/bin/psalm

gst:
	docker compose run --rm application git status

gcmsg:
	docker compose run --rm application git commit -m "$(M)"
