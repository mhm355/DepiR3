# Task 7 Solution

*  

## 1. Common docker-compose file for development and production. 

`docker-compose.yml`

```
services:
  db:
    container_name: db
    networks:
      - app_network
    restart: always
  
  sp_app:
    build: .
    container_name: sp_app
    ports:
      - "8080:8080"
    depends_on:
      db:
        condition: service_healthy
    networks:
      - app_network
networks:
  app_network:
    name: app_network
    driver: bridge
```

## 2.  development docker-compose file `docker-compose-dev.yml`
```
services:
  db:
    image: mysql
    env_file: ./.env/db-dev.env
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost", "-u", "root", "-p$$MYSQL_ROOT_PASSWORD"]
      interval: 10s
      timeout: 5s
      retries: 5
    ports:
      - "3306:3306"
    volumes:
      - ./db_data_dev:/var/lib/mysql
  sp_app:
    env_file: ./.env/app-dev.env
```

### Run the application in development environment.

`docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d`

`docker-compose -f docker-compose.yml -f docker-compose-dev.yml ps`

![ps](./Screenshots/image.png)

![localhost](./Screenshots/localhost.png)

## 3. production docker-compose file. `docker-compose-prod.yml`
```
services:
  db:
    image: postgres
    container_name: db
    env_file: ./.env/db-prod.env
    ports:
      - "5432:5432"
    healthcheck: 
      test: ["CMD", "pg_isready", "-U", "postgres"]
      interval: 10s
      timeout: 5s
      retries: 5
    volumes:
      - ./db_data_prod:/var/lib/postgresql/data
  sp_app:
    env_file: ./.env/app-prod.env
```

### Run the application in production environment.

`docker-compose -f docker-compose.yml -f docker-compose-prod.yml up -d`

`docker-compose -f docker-compose.yml -f docker-compose-prod.yml ps`

![ps_prod](./Screenshots/image%20copy.png)
![localhost-prod](./Screenshots/localhost_prod.png)

## Configure Nexus

> Run nexus using docker run

`docker run -d -p 8081:8081 -p 8082:8082 -v nexus:/nexus-data --name nexus sonatype/nexus3`

* port `8081`: Nexus web UI (http://localhost:8081).

* port `8082`: Docker registry port. "Docker Registry API understands Docker client requests"

> __Get Admin Password__

`docker exec -it nexus cat /nexus-data/admin.password`

> __Create Repo in nexus using localhost:8081__

* http://localhost:8081 --> Sign in as admin --> Settings --> Repositories --> Create Repository --> docker (hosted) --> name the repo --> HTTP Port: 8082 --> save

> Configure Docker to Trust Nexus Registry

* vim /etc/docker/daemon.json

    __add this content__
```json
  {
  "insecure-registries": ["localhost:8082"]
  }
```

* restart docker : `sudo systemctl restart docker`

> Login to Nexus 

* `docker login localhost:8082`

> Tag and Push images

* `docker tag sp_image localhost:8082/sp_image`

* `docker push localhost:8082/sp_image`

![nexus](./Screenshots/image%20copy%202.png)






