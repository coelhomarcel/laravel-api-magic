## Laravel RESTFul API

### Como iniciar o projeto:  

1. **Colocar os dados do banco de dados no arquivo .env, conforme abaixo:**  
    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1           
    DB_PORT=3306  
    DB_DATABASE=laravel-api   
    DB_USERNAME=root          
    DB_PASSWORD=      

2. **Instale o PHP e Composer, abra o terminal na pasta do projeto e execute os seguintes comandos:**  
    >composer install  

    >php artisan migrate:refresh --seeds (Obs: Usando o migrate:refresh todos os dados existentes do banco serão apagados)  

3. **Para criar dados aleatórios e iniciar um servidor de teste execute:**  
    >php artisan db:seed --class=TestSeeder  

    >php artisan serve  