
DESCRIPTION
------------
### Test task for Yii developer. Simple review system with admin panel

STACK
------------
Backend: Yii2 REST API

Frontend: Vue 3 + Vite + TailwindCSS

Database: MySQL

Build and environment: Docker, Docker Compose

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 8.2.


INSTALLATION
------------

### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up --build
    
You can then access the application through the following URL:

    http://127.0.0.1:8080

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Environment

Edit the file `.env` with real data, for example:

```
    POSTGRES_DB=
    POSTGRES_USER=
    POSTGRES_PASSWORD=
    POSTGRES_HOST=
    POSTGRES_PORT=

    ADMIN_ACCESS_TOKEN=your_token_here # Token for access secure routes
    ADMIN_REFRESH_TOKEN=your_refresh_token_here # Token for login as admin
```