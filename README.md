# Installation back
- clone o repositório
- copie o .env.example para .env
- rode: composer install
- rode: php artisan serve
# Installation front
- cd frontend
- npm install
- npm run serve
# Documentation API
Rode: 
```php
php artisan serve
```
Acesse: 
```
http://127.0.0.1:8000/docs/api
```
# Auth JWT
Pacote utilizado: https://jwt-auth.readthedocs.io/en/develop/
## Generate secret key
I have included a helper command to generate a key for you:
```php
php artisan jwt:secret
```
This will update your ```.env``` file with something like ```JWT_SECRET=foobar```

It is the key that will be used to sign your tokens. How that happens exactly will depend on the algorithm that you choose to use.

## Authenticated requests
There are a number of ways to send the token via http:

### Authorization header

```Authorization: Bearer eyJhbGciOiJIUzI1NiI...```

### Query string parameter

```http://example.dev/me?token=eyJhbGciOiJIUzI1NiI...```

### Payload
Get the raw JWT payload
```php
$payload = auth()->payload();

// then you can access the claims directly e.g.
$payload->get('sub'); // = 123
$payload['jti']; // = 'asfe4fq434asdf'
$payload('exp') // = 123456
$payload->toArray(); // = ['sub' => 123, 'exp' => 123456, 'jti' => 'asfe4fq434asdf'] etc
```
# Ferramentas
- [Para testes de webhooks: pipedream](https://pipedream.com/)

# Pontos importantes no sistema
- Existe o middleware FormatResponse que formata as responstas da API

# Deploy Hostgator
1. Criar um link simbólico apontando para a pasta do projeto (repo-app)
```bash
ln -nfs repo-app/public public_html
```
2. Ajustar as permissões das pastas e arquivos
```bash
cd repo-app
```
```bash
find * -type d -exec chmod 755 {} \;
```
```bash
find * -type f -exec chmod 644 {} \;
```

3. Ajustar a permissão da pasta do projeto (repo-app)
```bash
cd
```
```bash
chmod 755 repo-app
```