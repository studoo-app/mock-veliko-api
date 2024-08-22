# Démarrer en local

Télécharger l'image docker du mock API :

```bash
docker pull bfoujols/mock-veliko-api:latest
```

Lancer le mock API :

```bash
docker run -p 9042:80 bfoujols/mock-veliko-api:latest
```

Le mock API est accessible à l'adresse suivante : [http://localhost:9042/doc](http://localhost:9042/doc){:target="_blank"}

<figure markdown="span">
  ![API docs](../assets/api-doc.png)
</figure>

Bravo ! Vous avez démarré le mock API en local.