<h1 align="center" id="title">💻 Teste prático Adoorei 💻 </h1>

<p id="description" align="center">Pessoa desenvolvedora Backend</p>

<h2>🛠️ Como instalar:</h2>

<p>1. Clone o projeto</p>

```
git clone https://github.com/devsergyo/api-adoorei.git
```

<p>2. Acesse a pasta do projeto</p>

```
cd api-adoorei
```

<p>3. Execute o build do projeto</p>

```
docker-compose build --no-cache
```

<p>4. Suba os containers</p>

```
docker-compose up
```

<p>5. Acesse o container da aplicação</p>

```
docker-compose exec -it adoorei-app bash
```

<p>6. Instale as dependências</p>

```
composer install
```

<p>7. Crie o .env</p>

```
cp .env.example .env
```

<p>8. Gere a key</p>

```
php artisan key:generate
```

<p>9. Rode as migrações</p>

```
php artisan migrate --seed
```

<h2>💻 Tecnologias utilizadas neste projeto: </h2>

Technologies used in the project:

*   PHP 8.3
*   Laravel
*   MySQL 8.0
*   Docker

<h2> Atenção!! </h2>
<p>
     Foi disponibilizado um arquivo com todas as rotas para teste com o nome: 'Insomnia_api_adoorei.json' para que seja mais fácil análise!
</p>
<p>
    O programa utilizado é o Insomnia. Link para <a href=https://insomnia.rest/download>download</a>: 
</p>



