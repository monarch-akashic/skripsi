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

git init
git add .
git status
git remote add origin https://github.com/monarch-akashic/skripsi.git
git config --global user.email "nandovtw109@gmail.com"
git config --global user.name "Virnando Tan Wijaya"
git commit -m 'First Commit'
git status
git push -u origin master

php artisan make:model Applicant -m
php artisan make:model Portofolio -m


php artisan make:controller PagesController


php artisan make:model Company -m
php artisan make:controller CompanyController --resource

php artisan make:model Vacancy -m
php artisan make:controller VacancyController --resource


composer require laravel/socialite

php artisan make:controller PortofolioController --resource

php artisan serve --host 0.0.0.0 --port 80

php artisan make:seeder UserTableSeeder
php artisan make:seeder CategoryTableSeeder

composer require arielmejiadev/larapex-charts "^2.0"
php artisan vendor:publish --tag=larapex-charts-config
