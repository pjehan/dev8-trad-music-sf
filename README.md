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

## Installation du projet

Faire un fork du projet puis le cloner (git clone URL).

```shell
composer install
```

OPTIONNEL : démarrer le serveur PHP (ou utiliser le serveur Apache de WAMP) :

```shell
php -S localhost:8000 -t public/
```
