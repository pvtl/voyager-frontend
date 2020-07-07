# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2020-07-07
### Added support for caching routes
You can now use `php artisan route:cache` on your project with voyager-frontend. 

For upgrading, you should revise calls to the following named routes, which have been updated and can be viewed using `php artisan route:list` :

- voyager-frontend.account
    - This has become both voyager-frontend.account & voyager-frontend.account.update
- voyager-frontend.impersonate
    - This has become both voyager-frontend.impersonate & voyager-frontend.account.impersonate.admin