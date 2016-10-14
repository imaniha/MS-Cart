help:
	
	@echo "Commands:"
	@echo ""
	@echo "make deploy					load composer dependencies + warmup the sf cache"
	@echo "make app-reset				deploy, reset db and load fixture, user and sessions"
	@echo "make app-reset-db			reset db, load fixture, user and sessions"
	@echo "make create-session          create session table"
	@echo "make deploy-prod				load composer dependencies without require-dev + warmup the sf cache"
	@echo "make perm					fix permissions folders for app/{cache,logs}"
	@echo "make perm-stub				fix permissions folders for stub payline"
	@echo "make db-init					init the database and schema (drop & create)"
	@echo "make db-reset				rebuild the database and schema (drop & create)"
	@echo "make db-up					update the database schema"
	@echo "make fixture					load the init fixture"
	@echo "make fixture-app				append the init fixture"
	@echo "make fixture-demo			load the demo data fixture"
	@echo "make fixture-shop-dev		load the shop data fixture for dev env"
	@echo "make clear-cache				clear the cache"
	@echo "make clear-log				clear log"
	@echo "make sqlite-init				init sqlite folder database in /data"
	@echo "make user-demo				init users in demo fixtures: user/user & admin/admin"
	@echo "param-reset                  remove parameters.yml"

deploy:
	composer install
	rm -rf var/cache/*
	php bin/console cache:warmup --env dev
 
deploy-prod:
	composer install --no-progress --no-dev -o --quiet
	rm -rf var/cache/*
	php bin/console cache:warmup --env prod
 
perm:
	setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/logs var/sessions
	setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx var/cache var/logs var/sessions


perm-stub:
	chmod 777 src/Stub/Bundle/PaylineBundle/Resources/data

db-init:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create
 
db-up:
	php bin/console doctrine:schema:update --force
 
db-reset:
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create

create-session:
	php bin/console doctrine:query:sql "CREATE TABLE sessions(sess_id VARBINARY(128) NOT NULL, sess_data BLOB NOT NULL, sess_time INT(10) UNSIGNED NOT NULL, sess_lifetime MEDIUMINT(9) NOT NULL, PRIMARY KEY (sess_id)) COLLATE='utf8_bin' ENGINE=InnoDB"

app-reset: deploy perm db-reset fixture user-demo create-session

app-reset-db: db-reset fixture user-demo create-session

fixture:
	php bin/console doctrine:fixture:load --no-interaction

user-demo:
	php bin/console fos:user:create user user@free.fr user
	php bin/console fos:user:create admin admin@free.fr admin --super-admin

clear-cache:
	rm -rf var/cache/*

clear-log:
	rm -rf var/logs/*.log

sqlite-init:
	mkdir app/data
	chmod -R 777 var/data

tu:
	bin/phpunit -c app/phpunit.xml.dist --testsuite TUA	

tf:
	bin/phpunit -c app/phpunit.xml.dist --testsuite TFA

param-reset:
	rm -f app/config/parameters.yml
