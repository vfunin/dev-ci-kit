.PHONY: ci infection test deptrac test-coverage mutation rector cs psalm gst gcmsg
ci:
	docker compose run --rm application composer dck-ci

infection:
	docker compose run --rm application composer dck-infection

test:
	docker compose run --rm application composer dck-pest

test-coverage:
	docker compose run --rm application composer dck-pest-coverage

mutation:
	docker compose run --rm application composer dck-mutation-test

deptrac:
	docker compose run --rm application composer dck-deptrac

rector:
	docker compose run --rm application composer dck-rector

cs:
	docker compose run --rm application composer dck-phpcs

psalm:
	docker compose run --rm application composer dck-psalm

phpstan:
	docker compose run --rm application composer dck-phpstan

gst:
	docker compose run --rm application git status

gcmsg:
	docker compose run --rm application git commit -m "$(M)"
