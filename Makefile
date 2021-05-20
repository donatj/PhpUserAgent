SRC_FILES  = $(shell find src -type f -name '*.php')
TEST_FILES = $(shell find tests -type f -name '*.php')

README.md: .mddoc.xml.dist composer.json $(SRC_FILES) $(TEST_FILES)
	./vendor/bin/mddoc

.PHONY: test
test:
	./vendor/bin/phpunit --coverage-text

.PHONY: generate
generate:
	php bin/user_agent_sorter.php > tests/user_agents.tmp.json && mv tests/user_agents.tmp.json tests/user_agents.dist.json
	php bin/constant_generator.php
	$(MAKE) README.md

.PHONY: init
init:
	php bin/init_user_agent.php > tests/user_agents.tmp.json && mv tests/user_agents.tmp.json tests/user_agents.dist.json
	make generate
