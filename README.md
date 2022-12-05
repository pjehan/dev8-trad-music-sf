# Trad Music (Symfony)

## Étapes de création du projet

Générer le projet Symfony :

```shell
composer create-project symfony/skeleton:"6.1.*" trad-music-sf
```

OPTIONNEL : si on veut la totale (Doctrine, Twig, Security...) :

```shell
cd trad-music-sf
composer require webapp
```

Installation de Maker Bundle (pour générer du code PHP) :

```shell
composer require maker --dev
```

Installation du profiler (barre de debug de Symfony) :

```shell
composer require profiler debug --dev
```

Cela permet d'avoir le profiler (debug bar) de Symfony et de pouvoir
utiliser la fonction dump() dans les controlleurs ou les fichiers Twig.

### Mise en place de la base de données

Installation de Doctrine :

```shell
composer require orm
```

Création du fichier .env.local :

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/trad_music_sf?serverVersion=5.7&charset=utf8mb4"
```

Création de la base de données :

```shell
php bin/console doctrine:database:create
```

Création des entités :

```shell
php bin/console make:entity
```

La commande précédente permet de créer l'entité (classe PHP qui sera
liée à une table en base de données par exemple instrument). Elle permet
également de générer le repository (une classe qui va permettre de faire
des requêtes SQL sur la table instrument).

ATTENTION ! Pour l'entité User, utiliser la commande :

```shell
php bin/console make:user
```

Création des fichiers de migration :

```shell
php bin/console make:migration
```

Exécution des migrations :

```shell
php bin/console doctrine:migrations:migrate
```

Installer DoctrineFixturesBundle :

```shell
composer req --dev orm-fixtures
```

Créer les fixtures :

```shell
php bin/console make:fixture
```

Exécution des fixtures :

```shell
php bin/console doctrine:fixtures:load # php bin/console d:f:l
```

### Création d'une nouvelle page

OPTIONNEL : Installation de apache-pack (si on passe par WAMP) :

```shell
composer require symfony/apache-pack
```

Installation de Twig :

```shell
composer require twig
```

Création d'un controller :

```shell
php bin/console make:controller
```

TODO: Comment récupérer les données de la base de données dans un 
controlleur.

## Installation du projet

Faire un fork du projet puis le cloner (git clone URL).

```shell
composer install
```

Création du fichier .env.local :

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/trad_music_sf?serverVersion=5.7&charset=utf8mb4"
```

Création de la base de données :

```shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Générer les fichiers assets :

```shell
npm run watch
```

OPTIONNEL : démarrer le serveur PHP (ou utiliser le serveur Apache de WAMP) :

```shell
php -S localhost:8000 -t public/
```
