# Application-Covoiturage
Ce projet a été proposé par la **base aérienne de Tours**. L'objectif de ce projet est de développer une PWA pour une application de covoiturage pour les trajets base-domicile des employés de la base. Il s'agit de la première version du projet, qui sera très poursuivi puis déployé.

Divers spécifications ont été réalisées au cours de ce projet que voici :
- Maquettes : https://www.figma.com/design/5bxxEzcQX61w47TbJjTQNU/Projet-Covoiturage?node-id=0-1&t=Bm7lg3tBlHzsbef3-1
- Cahier des charges : https://docs.google.com/document/d/1YKihpk38Q2iF9SrHuza7qxTZfvJx9xj1e1MXq_auaDg/edit
- Cahier des spécifications : https://docs.google.com/document/d/16mo-7q7OLivZuXtgn2H9OZAAmHR6SNggWoWZn8zIPzI/edit
- Diagramme de classes : https://lucid.app/lucidchart/f431214f-b9ae-4d07-9f59-7bb5505e7277/edit?invitationId=inv_d8c15314-95e6-48c6-933f-9d14d152dba1&page=0_0#
- Cahier des recettes : https://docs.google.com/spreadsheets/d/1UXz8mWlxt1LOfOx1eiYVd3jOx3J5HOcdFvd6yuAHuMQ/edit#gid=0
- Trello : https://trello.com/invite/b/hYGpoFQG/ATTIab71a4e6845c2b9e99e43672fa086e520B553879/covoiturage-pwa

# Pré-requis
Pour pour pouvoir lancer l'application, vous devez configurer sur votre machine les outils suivants :
- Pour le backend, **Php** (8.2.16) et **Composer** (2.7.2) : https://www.youtube.com/watch?v=pS0U-PsXUlg
- Pour la base de données, **PostgreSQL** (16.2) : https://www.postgresql.org/download/
- Pour le frontend, **Node** (21.6.0) (et **Vue.JS** (5.0.8)) : https://www.youtube.com/watch?v=tsDGFUiNZog

Une fois fait, vous devez saisir les commandes suivantes depuis une console ouverte dans le dossier _Application_ :
- ```composer install```
- ```npm install```
- ```php artisan key:generate```

Vous devez ensuite créer une base de données _covoiturage_ (depuis **pgAdmin** par exemple), ainsi qu'un schéma dans cette base de données nommé _covoiturage_ également.

Vous pouvez ensuite automatiser la création des tables de cette base de donnée, ainsi que la génération de données fictives en saisissant ces 2 commandes depuis la console précédemment ouverte :
- ```php artisan migrate```
- ```php artisan db:seed```

# Lancement de l'application
A partir de 2 consoles ouvertes dans le dossier _Application_, vous pouvez lancer l'application en saisissant les 2 commandes suivantes dans chacunes des 2 consoles :
- ```php artisan serve```
- ```npm run dev```

Vous accéder alors à l'interface de connexion, et pouvez vous créer un compte et naviguer dans l'application.

##

Cheffe de Projet, Caroline Petit

Arthur Crochemore, Cyril Jacques, Mohamed Sid Brahim, Jaafar Ghiffi et Adrien Amoroso