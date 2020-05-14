#4L

Projet destinés à aider les participants du 4L trophy à se créer un site internet dans le but de pouvoir démarcher plus facilement des sponsors pour les aider dans leur aventures.
Projet réalise avec Symfony

Installation
===========

__` git clone https://github.com/nozkrew/4L.git `__

__` cd 4L `__

__` composer install `__

__` php bin\console doctrine:database:create`__

__` php bin\console doctrine:schema:update --force `__


Pour importer les données nécéssaires au début : 
__` mysql -u root -p 4L < db\4l.sql `__

Vous pourrez ainsi accéder au site : 
https://127.0.0.1:8000/nom-du-site

Pour la partie admin 
-------------------
https://127.0.0.1:8000/login

Login : admin

Mot de passe : admin
