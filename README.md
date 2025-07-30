# michael-game-of-life
Michael Game of Life

## Requirements

- **PHP ^8.2**
- Composer

## 🔍 How it works
```bash
composer install
```

and navigate to the project folder in your terminal, then run:

```bash
php index.php
```

You can change the sleep time and generation count by modifiying the index.php file

---

To run the unit tests
```bash
./vendor/bin/phpunit
```

> [!NOTE]
> For the sake of simplicity and to avoid over-engineering, some possible features are ignored for now!

## TODO:

- [x] `Create the main skeleton` by adding composer (needed for autoloading, and phpunit), index.php, phpunit.xml, .gitignore, .github/workflows, and folder structure
- [x] `Write tests` and `start adding classes` (will be decided as I write the code)
- [x] `Implement index.php` so that the results will be `shown in the console`
- [ ] Add tests for the `edge cases`
- [x] `Check the document` for the **game of life** if anything is missing or can be improved
- [x] Add github actions for automated testing
- [ ] Add code coverage for tests
- [ ] Add static analysis tools (phpstan etc), add them to github actions so that will automatically modify/lint the code when necessary
- [x] `Update readme file` to show how to run the code, requirements such as php version etc. write a simple `usage section`.
- [ ] Maybe make it accept parameters from console for the sleep time, grid/cell size etc