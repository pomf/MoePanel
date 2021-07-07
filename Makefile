
MAKE="make"
INSTALL="install"
TAR="tar"
GREP="grep"
NODE="node"
NPM="npm"
DESTDIR="./dist"
TMPDIR := $(shell mktemp -d)

all: npm_dependencies min-css min-js copy-all


min-css:
	$(NODE) $(CURDIR)/node_modules/.bin/cleancss $(CURDIR)/static/css/moe.css --output $(DESTDIR)/css/moe.min.css
	$(NODE) $(CURDIR)/node_modules/.bin/cleancss $(CURDIR)/static/css/signin.css --output $(DESTDIR)/css/signin.min.css
	$(NODE) $(CURDIR)/node_modules/.bin/cleancss $(CURDIR)/static/css/bootstrap.css --output $(DESTDIR)/css/bootstrap.min.css

min-js:
	mkdir -p $(CURDIR)/js
	mkdir -p $(DESTDIR)/ $(DESTDIR)/js
	$(CURDIR)/node_modules/.bin/uglifyjs ./static/js/moe.js >> $(CURDIR)/js/moe.min.js 
	$(CURDIR)/node_modules/.bin/uglifyjs ./static/js/bootstrap.js >> $(CURDIR)/js/bootstrap.min.js 
	cp $(CURDIR)/js/moe.min.js $(DESTDIR)/js/
	cp $(CURDIR)/js/bootstrap.min.js $(DESTDIR)/js/

copy-all:

	mkdir -p $(DESTDIR)/ $(DESTDIR)/img
	mkdir -p $(DESTDIR)/ $(DESTDIR)/css
	mkdir -p $(DESTDIR)/ $(DESTDIR)/includes
	mkdir -p $(DESTDIR)/ $(DESTDIR)/dashboard
	mkdir -p $(DESTDIR)/ $(DESTDIR)/dashboard/skel

	cp $(CURDIR)/static/img/*.png $(DESTDIR)/img/

	cp $(CURDIR)/static/dashboard/skel/*.php $(DESTDIR)/dashboard/skel/

	cp $(CURDIR)/static/dashboard/index.php $(DESTDIR)/dashboard/

	cp $(CURDIR)/static/php/core.php $(DESTDIR)/includes/

	cp $(CURDIR)/static/php/database.inc.php $(DESTDIR)/includes/

	cp $(CURDIR)/static/php/settings.inc.php $(DESTDIR)/includes/

	cp $(CURDIR)/static/php/api.php $(DESTDIR)/

	cp $(CURDIR)/static/index.php $(DESTDIR)/

	cp $(CURDIR)/package.json $(DESTDIR)/

	rm -rvf $(CURDIR)/node_modules 
	rm -rvf $(CURDIR)/js
	
npm_dependencies:
	$(NPM) install
