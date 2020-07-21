.PHONY: format
format:
	composer exec php-cs-fixer -- fix . --rules=@PhpCsFixer
.PHONY: dev.serve
dev.serve:
	pgrep -x php > /dev/null && killall -e php || :
	php -S localhost:8080 -t public_html public_html/index.php
