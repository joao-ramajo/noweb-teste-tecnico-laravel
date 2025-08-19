# Vaga de Desenvolvedor (Back-End + API)

Este projeto tem como objetivo o desenvolvimento de uma API REST para gerenciamento de notícias e validação de usuário.

O projeto conta com um CRUD completo para notícias nomeadas `articles` e o cadastro e login de usuário.

## Tecnologias

- Laravel 12 
- Docker 
- Sanctum
- MySQL
- Pest


## Instalação 

Para rodar este projeto você precisa das seguintes dependências:

- PHP ^8.2
- Laravel Installer ^5.17.0
- Docker ^28.3.3
- Composer ^2.8.10
### Clone o repositório

```bash
git clone https://github.com/joao-ramajo/noweb-teste-tecnico
cd noweb-teste-tecnico
```

### Instale as dependências e gere a chave de acesso do Laravel

```bash
composer install 
cp .env.example .env # copie as variavéis de ambiente
php artisan key:generate 
```

### Configure o acesso ao banco de dados em .env

```txt
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api-noweb
DB_USERNAME=user
DB_PASSWORD=123456
```

### Suba o docker-compose 

```bash
docker compose up -d
```

### Rode as migrations
```
php artisan migrate
```

### Inicie o servidor do projeto

```
php artisan serve
```

Após isso a aplicação estará rodando em `http://localhost:8000/api`
## Fluxo do Usuário

### Cadastro

O usuário envia uma requisição `POST /users` para cadastrar suas informações e gerar um token de acesso. 

Payload de cadastro.

```json
{
	"name" : "seu nome",
	"email" : "email@exemplo.com",
	"password" : "sua senha forte",
	"password_confirmation" : "repita a senha"
}
```

Após isso a requisição passa por uma validação utilizando a classe `UserStoreRequest.php` para fazer a validação de entrada de dados e garantir que todas as informações sejam enviadas corretamente.

Após isso, será retornado o payload contendo as informações do usuário e o ID registrado.

```json
{
	"message": "Usuário criado com sucesso",
	"data": {
	"name": "joao",
	"email": "joao@gmail.comd",
	"updated_at": "2025-08-19T16:45:44.000000Z",
	"created_at": "2025-08-19T16:45:44.000000Z",
	"id": 2
	}
}
```


### Login

Para realizar o login é enviado o `email`  e `password` da conta, a requisição é validada por `LoginRequest` para validar a entrada de dados.

A requisição deve ser enviada para `POST /api/login` gerida pelo `AuthController` para realizar as operações necessárias.

Após isso, dentro do controller a senha é verificada com o registro relacionado ao email enviado, se as informações estiverem corretas é devolvido um token de acesso no seguinte payload.

```json
{
	"token": "<token>"
}
```

Este token deve ser usado para as demais requisições do sistema para acessar recursos como a criação de notícias.