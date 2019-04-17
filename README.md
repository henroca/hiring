# FluxoTI: Teste HackerNews

Teste realizado por Jefferson Henrique Ramos

O teste consiste em consumir uma API fornecida pelo [HackerNews](https://github.com/HackerNews/API) e utilizando *VueJs* exibir os dados. Como a escolha do conteúdo é do usuário, foi selecionado as *news stores* para serem exibidas.

## Dependências

- git
- [Docker](https://docs.docker.com/install/) e [Docker Compose](https://docs.docker.com/compose/install/)

### Instalação

Passos para instalar a aplicação:

- Clonar o repositório git `git clone git@github.com:henroca/hiring.git`
- Entre no diretório `cd hiring`
- Levantar os contêineres `docker-compose up -d`
- Instalar as dependências do Node `docker-compose run node_app yarn install`
- Compilar os javascripts e sass `docker-compose run node_app yarn run dev`
- Criar o arquivo env `cp .env.example .env`
- Instalar as dependências do php `docker-compose exec app composer install`
- Gerar a KEY do laravel `docker-compose exec app php artisan key:generate`
- Rodar os testes `docker-compose exec app ./vendor/bin/phpunit`

Se tudo rodar sem problemas, você poderá acessar aplicação [clicando aqui](http://localhost) :heart_eyes:.
