cd
cd ..
cd xampp/htdocs
composer create laravel/laravel skripsi 7
composer require laravel/ui:^2.4
php artisan ui bootstrap --auth
npm install
npm audit fix
npm run dev
php artisan migrate:fresh
php artisan storage:link
