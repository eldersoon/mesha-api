# mesha-api

## Start
- open the project and run 'composer install'
- create a .env file based in .env.example OR run 'cp .env.example .env' 
- set your database credentials
- run 'php artisan jwt:secret'
- run 'php artisan migrate'

## Run seeders
- run 'php artisan db:seed --class=KnowledgeSeeder && php artisan db:seed --class=UserSeeder'
- this will allow you login with email 'admin@admin.com' and password 'admin'

## start server
- run 'php artisan serve'
- now you application is runnin in http://localhost:8000


## Endpoints

* POST /login | {email, password} | get jwt-auth
* POST /register' | { name: string, email:string, cpf:string, celphone:string, knowledges:array } 
* GET /registers' | {no body} | get all actived register
* GET /register/{id} | {no body} | get specifc register
* DELETE /register/{id} | {no body} | delete specific register
* POST /register/valid/{id}' | {no body} | change valid status to valid or not valid



