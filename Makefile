.PHONY: install-git-hooks

install-git-hooks:
	wget --output-document=.git/hooks/pre-commit https://gist.githubusercontent.com/tristanbes/bed2e3364852ea9a7f9eadf3ef317a57/raw/53852b1e2fd3b62a36234b8fdd174fb5a5dab317/pre-commit
	chmod +x .git/hooks/pre-commit
