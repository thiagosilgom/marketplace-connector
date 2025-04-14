# Marketplace Connector

Este projeto é responsável pela importação de ofertas de um marketplace. Ele envolve a importação de dados sobre ofertas, como detalhes, imagens e preço, de um servidor externo para o seu banco de dados. Além disso, oferece um sistema de filas para processamento assíncrono e utiliza logs para monitoramento.

## Funcionalidades

- Importação de ofertas de um marketplace usando a API.
- Armazenamento das ofertas no banco de dados.
- Processamento assíncrono usando jobs e filas.
- Logs detalhados para monitoramento de erros e ações.
- Rota para iniciar o processo de importação de ofertas.

## Como rodar o projeto

### 1. Clonando o repositório

Clone o repositório para sua máquina local:

```bash
git clone <URL_DO_REPOSITORIO>
cd <NOME_DO_REPOSITORIO>
```

### 2. Instalar as dependências

Se estiver usando o Laravel Sail (Docker), execute os seguintes comandos:

```bash
./vendor/bin/sail install
```

Ou, se não estiver utilizando Sail, instale as dependências normalmente com o Composer:

```bash
composer install
```

### 3. Configurar as variáveis de ambiente

Renomeie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 4. Executar as migrations

Crie o banco de dados e execute as migrations para criar as tabelas necessárias:

```bash
php artisan migrate
```

### 5. Rodar o servidor

Se estiver usando o Laravel Sail, rode o seguinte comando para iniciar os containers Docker:

```bash
./vendor/bin/sail up
```

Caso contrário, rode o servidor localmente:

```bash
php artisan serve
```

### 6. Testar a Rota de Importação

Com o servidor rodando, você pode testar a rota de importação de ofertas, que é uma rota `POST` na URL:

```
POST /api/import-offers
```

Para testar com `curl`, execute o seguinte comando:

```bash
curl -X POST http://localhost/api/import-offers
```

Isso acionará a importação das ofertas, que será processada em segundo plano via jobs.

## Jobs e Processamento Assíncrono

A importação de ofertas é feita de forma assíncrona usando jobs. A aplicação utiliza o Redis como driver de filas. Certifique-se de que o Redis esteja configurado corretamente em seu ambiente.

### Filas e Jobs

- **ImportOffersJob**: Job responsável por buscar as ofertas de uma página e despachar jobs individuais para cada oferta.
- **ImportOfferJob**: Job responsável por buscar os detalhes, imagens e preços de cada oferta e salvar no banco de dados.

## Logs

Os logs de execução e erros são registrados no arquivo `storage/logs/laravel.log`. Eles podem ser úteis para depurar problemas no processamento das ofertas.
