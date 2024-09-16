# Mock API Server pour le projet Veliko

<figure markdown="span">
  ![Logo Veliko](assets/veliko.svg){ width="300" }
</figure>

## Introduction

Ce projet est un serveur API REST qui simule le comportement de l'API Velib.
Il est utilisé pour faire des projets pédagogiques (applicatif) qui utilisent l'API Velib sans avoir besoin de se connecter à l'API officielle.

Nous avons rajouté des nouvelles features : 

- Ajout de la liste des vélos dans la station
- Ajout de la liste des vélos dans le parc Velib

L'API Velib est une API REST qui permet de récupérer des informations sur les stations Velib de la ville de Paris.

!!! warning "Information importante"

    Voici le lien de l'API officielle : [https://www.velib-metropole.fr/donnees-open-data-gbfs-du-service-velib-metropole](https://www.velib-metropole.fr/donnees-open-data-gbfs-du-service-velib-metropole){:target="_blank"}

## stack technique

- Core code : [Edu framework](https://studoo-app.github.io/edu-framework/){:target="_blank"}
- Format Documentation API : [OpenAPI 3.0.0](https://www.openapis.org/){:target="_blank"}
- Build Documentation API : [Redocly](https://redocly.com/){:target="_blank"}
- Container : [Docker](https://www.docker.com/){:target="_blank"}
- Database : [SQLite](https://www.sqlite.org/index.html){:target="_blank"}
- Client API : [Bruno](https://www.usebruno.com/){:target="_blank"}
- Documentation : [Mkdocs](https://www.mkdocs.org/){:target="_blank"}
- Task runner : [Castor](https://castor.jolicode.com/){:target="_blank"}
- CI/CD : [Github Actions](https://github.com/features/actions){:target="_blank"}