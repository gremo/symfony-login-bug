# GitHub issue #54641

- Issue link: [#54641](https://github.com/symfony/symfony/issues/54641)
- Symfony: version 7, created following [Reproducing Complex Bugs](https://symfony.com/doc/current/contributing/code/reproducer.html#reproducing-complex-bugs)


How to start the project:

1. Start Visual Studio Code, press <kbd>F1</kbd> and choose "Dev Containers: Reopen in Container"
2. After the container is started, run `composer install`
3. Run `php bin/console doctrine:migrations:migrate -n`
3. Open the login page http://localhost/login (depends on the assigned port)
4. Click "login" button (username and password already set)
