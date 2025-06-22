
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
### Migration

If you start a project first time, you need create a new table in db using migration:

    php yii migrate

### Start with Docker

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
    
    ADMIN_PASSWORD=
```
