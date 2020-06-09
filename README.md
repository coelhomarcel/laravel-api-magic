## Laravel RESTFul API

## Sobre o projeto:

Desenvolver uma API Rest utilizando Laravel que permita o cadastro de:  
- Filmes  
- Classificação do Filme  
- Atores  
- Diretor  

Sendo assim, levei em consideração que uma Pessoa pode ser Ator e Diretor ao mesmo tempo.

Neste projeto foi utilizado o Laravel 7 sem pacotes adicionais.  

## Projeto do Banco de dados:    

Tabela: Movies  
Descrição: Contém as informações a respeito dos Filmes  

Tabela: People  
Descrição: Contém as informações de todas as Pessoas mostradas na API  

Tabela: Roles  
Descrição: Contém os possíveis cargos das Pessoas cadastradas, neste caso Atores (Actors) e Diretores (Directors)

Tabela: PersonRoles  
Descrição: Faz o relacionamento entre as pessoas cadastradas e seu respectivo cargo

Tabela: MoviePeople  
Descrição: Faz o relacionamento entre os Filmes, as Pessoas cadastradas e o cargo ocupado no filme

### Como iniciar a API:    

1. **Instale o PHP e Composer, abra o terminal na pasta do projeto e execute os seguintes comandos:**  
    >composer install  

2. **Colocar os dados do banco de dados no arquivo .env.example e alterar o nome para .env, conforme abaixo:**  
    DB_CONNECTION=mysql  
    DB_HOST=IP.DO.SERVIDOR           
    DB_PORT=PORTA.DO.SERVIDOR  
    DB_DATABASE=NOME.DO.BANCO   
    DB_USERNAME=USUARIO.DO.BANCO          
    DB_PASSWORD=SENHA.DO.BANCO  

3. **Alimente o banco de dados, execute:**  
    >php artisan migrate:refresh --seed  (Obs: Usando o migrate:refresh todos os dados existentes do banco serão apagados) 

3. **Para criar dados aleatórios e iniciar um servidor de teste execute:**  
    >php artisan db:seed --class=TestSeeder  

    >php artisan serve  

##### Obs: Collection do Postman está no Repositório.  