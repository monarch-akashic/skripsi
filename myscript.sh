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
