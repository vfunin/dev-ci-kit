.PHONY: ci infection test deptrac rector cs psalm gst gcmsg
ci:
	docker compose run --rm application vendor/bin/grumphp run

infection:
	docker compose run --rm application vendor/bin/infection --test-framework=pest

test:
	docker compose run --rm application vendor/bin/pest --coverage

test-cov:
	docker compose run --rm application vendor/bin/pest --coverage-xml=var/.report/coverage/xml --log-junit=var/.report/coverage/phpunit.junit.xml

mut:
	docker compose run --rm application vendor/bin/infection --threads=max \
              --skip-initial-tests \
              --min-msi=90 \
              --min-covered-msi=90 \
              --coverage=var/.report/coverage \
              --log-verbosity=none \
              --no-interaction \
              --no-progress

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
