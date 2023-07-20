# garageparrot

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP (version 7.4 ou supérieure)
- Composer (gestionnaire de dépendances PHP)
- Symfony CLI (interface de ligne de commande Symfony)
- Un serveur de base de données (par exemple, MySQL, PostgreSQL)

Étapes pour lancer le projet Symfony en local:

- Cloner le projet : Tout d'abord, clonez le dépôt du projet Symfony dans le répertoire de votre choix:
    git clone <lien_du_depot_git> mon_projet_symfony
    cd mon_projet_symfony

- Installer les dépendances : Utilisez Composer pour installer les dépendances du projet:
    composer install

- Configurer la base de données : Modifiez le fichier .env pour configurer les paramètres de votre base de données.
  Assurez-vous que la base de données existe et que les informations de connexion sont correctes.
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/garage_parrot?serverVersion=8.0.33&charset=utf8mb4"

-Créer la base de données : 
Exécutez la commande suivante pour créer la base de données en fonction de la configuration définie dans le fichier .env.
    synfony console doctrine:database:create

Exécuter les migrations : Utilisez les migrations pour créer la structure de base de données.
    symfony console doctrine:migrations:migrate

Lancer le serveur local : Utilisez la commande Symfony CLI pour lancer le serveur local.
    symfony server:start
    
Accéder au projet : 
Ouvrez votre navigateur web et accédez à l'URL fournie par Symfony CLI pour voir votre projet Symfony en action.
Voilà ! Vous avez maintenant lancé avec succès votre projet Symfony en local sur votre machine. 
Vous pouvez commencer à développer votre application en utilisant le framework Symfony.

Arrêter le serveur: 
    symfony server:stop

