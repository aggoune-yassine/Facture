When you are done with installation, copy the .env.example file to .env

$ cp .env.example .env

Generate the application key

$ php artisan key:generate

Add your database credentials to the necessary env fields

Migrate the application

$ php artisan migrate

EXECUTE  TRIGGER in SQL

$ CREATE TRIGGER gestion_Budget AFTER INSERT ON products
 FOR EACH ROW UPDATE budgets SET budgets.montant = budgets.montant - (new.unit_price * new.qty)WHERE budgets.id = new.budget_id and budgets.date=new.date_achat;


$ CREATE TRIGGER gestion_Budget_drop BEFORE DELETE ON products
 FOR EACH ROW UPDATE budgets SET budgets.montant = budgets.montant + (OLD.unit_price * OLD.qty)WHERE budgets.id = OLD.budget_id and budgets.date=old.date_achat;

Install node modules

$ npm install

Run the application

<<<<<<< HEAD
## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# faclast" 
=======
$ php artisan serve
>>>>>>> 17ca66ac9e500488e9c47e3ee9316d3b957cee63
