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

$ php artisan serve
