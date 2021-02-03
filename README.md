# Principe du jeu:

- Il s'agira d'un sudoku en ligne, à savoir une grille de 9x9, avec chaque lignes, colonnes ou carré qui doit être remplis de numéro de 1 à 9 sans répéter aucun nombre dans la ligne, colonne ou carré.
- Il y aura 3 niveaux de difficultés, chacun laissant au joueur le choix entre plsuieurs grilles: le premier niveau proposera de choisir entre 4 grilles différentes, le deuxième et troisième niveau entre 3 grilles, pour un total de 10 grilles différentes.
- Il y aura aussi un système de classement, un par niveau, qui sera basé sur le temps mis pour résoudre une grille. Il y aura aussi un classement final basé sur les 3 temps combiné.
- En plus de ça, il y aura un système de d'inscription et de connexion, nécessaire pour pouvoir jouer au jeu et pour le classement.

# Règles du jeu

La grille doit contenir des chiffres de 1 à 9. Un même chiffre ne se trouve qu'une seule fois par ligne, par colonne, et dans chaque bloc de 3 cases par 3. Vous pouvez remplir la case vierge et selectionné à l'aide  des chiffres proposés sur coté de la grille. 

# Techniques:

Les techniques utilisés pour la réalisation de ce jeu sont:
 Symfony 4, Bootstrap 4 , Git , Docker, Html 5, CSS 3, Php 7, javascript.
 
# Mise en place du projet: 

Tout d'abord il vous faudra cloner le projet depuis le repo github.
Ensuite, pour utiliser le Dockerfile il faudra vous rendre dans le dossier de ce projet à l'aide votre terminal et taper:

```bash
docker build --tag lamp/sudoku_kai_shi .
```
Une fois cette commande exécutée, rendez-vous dans votre application docker windows afin de créer un container, dans lequel vous renseignerez les ports ainsi que l'emplacement des fichiers de notre application au niveau des volumes.
Pour rappel, il faut rentrer dans le premier volume le chemin vers le dossier du projet, et dans le deuxième /var/www/html.

Après cela, il vous faudra créer un fichier nommé .env.local dans lequel vous collerez et modifierez les valeurs entre les étoiles: (vous trouverez ces valeurs dans les logs du container docker)
```bash
DB_PASSWORD=*password*
DATABASE_URL=mysql://*username_of_db*:${DB_PASSWORD}@127.0.0.1:3306/*db_name*?serverVersion=mariadb-10.3.25
```

Ensuite, avec l'aide du terminal du container Docker, il vous faudra faire un ``` composer install ``` suivi d'un ``` npm install ``` et d'un ``` yarn install ``` pour installer l'essemble des dépendances du projet.

Toujour dans le terminal du container rentrer la commande suivante:
```bash
php bin/console doctrine:schema:update --force
```

Votre base de données est créer, il ne vous reste plus qu'à charger les fixtures en executant:
```bash
php bin/console doctrine:fixture:load
```

Pour finir rouler la commande  ``` yarn build ``` afin de changer l'ensemble du style css 
