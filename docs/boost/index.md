## Personnaliser Mcck API

Dans le cas ou vous souhaitez personnaliser le mock de API, vous pouvez à partir de la version v0.3.0.

- ajouter des tokens dans le ficher 'configData.json'
- sauvegarder la base de données en local (var/api/sqlite/app.db.sqlite)

Pour personnaliser le mock de l'API : 

Modifier le fichier `compose.yaml` et ajouter les volumes suivants :

```diff
services:
  mock-veliko-api:
    container_name: mock-veliko-api
    image: bfoujols/mock-veliko-api:latest
    ports:
      - "9042:80"
++  volumes:
++    - ./var/api:/var/www/mock-veliko-api/var   
```

Puis redémarrer le service `mock-veliko-api`

```bash
docker compose down && docker compose up -d
```

Puis vous aller devoir faire 2 appel API pour sauvegarder la base de données en local :

Création de la scruture de la base de données :
```bash
curl -X POST http://localhost:9042/api/init/schema
```

Création des données de la base de données :
```bash
curl -X POST http://localhost:9042/api/init/data
```

L'ensemble des fichiers de configuration sont dans le dossier `var/api` :

- `configData.json` : contient les tokens
- `sqlite/app.db.sqlite` : contient la base de données

