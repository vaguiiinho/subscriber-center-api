

APP_NAME="Subscreber-center"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=code_micro_videos
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
Suba os containers do projeto

docker-compose up -d
Acesse o container app

docker-compose exec app bash
Instalar as dependências do projeto

composer install
Gerar a key do projeto Laravel

php artisan key:generate
Acesse o projeto http://localhost:8000