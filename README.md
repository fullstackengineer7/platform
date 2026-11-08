## Architecture
A blog platform built with clean Docker, PHP 8.1, MySQL 8, and Smarty. The project uses modular monolith with DDD and best principles oop. Core buildeng DI, router, midleware, http request. Business sleces article, categori, media. All media validtion slices.

### Install
1. Run Docker Compose:
   docker-compose up -d

2. composer install
   
3. Run database migrations:
   docker-compose exec web php bin/migrate.php  

4. Run seeders to fill the blog with data:
   docker-compose exec web php bin/seed.php
   
### Test
Run test: docker-compose exec web ./vendor/bin/phpunit
