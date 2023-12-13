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
