Mise en place de deux cartes de la France (régions / départements) interactives capables de montrer sur une interface l'historique de la crise de la COVID-19, au niveau global Français.

## Sommaire
* [Info Générale](#Info Générale)
* [Configuration Laravel](#Configuration Laravel)
* [Back-End](#Back-End)
* [Front-End](#Front-End)

## Info Generale
SDC-DATA / Covid Timelapse / Code Camp par Lucie, Anaïs, Lucas, Kevin.   

## Configuration Laravel
Commandes à réaliser pour mettre en place Laravel :

* Pour lancer le projet Laravel apres l'avoir git utiliser cette commande : ```php artisan serve``` pour pouvoir lancer le projet.
* Pour Extract la Database nous vous proposons deux commandes : 
``sed -i '' 's/utf8mb4_0900_ai_ci/utf8mb4_unicode_ci/g' dbexport_2.sql``
``/Applications/MAMP/Library/bin/mysql  -uroot -p covid_timelapse < dbexport_2.sql``
ainsi que ``mysql -u username -p dbname < dbexport.sql``
* Si vous avez une erreur  Mysql vérifier le port nous avons utilisé personnellement le port 8889 et 3306.


	
## Back-End
Principaux travaux effectués dans cette partie :

* Réalisation de la base de données 
* Création des Controllers 
* Utilisation de la Data du gouvernement voir ci-joint : ```https://www.data.gouv.fr/fr/datasets/chiffres-cles-concernant-lepidemie-de-covid19-en-france/```


## Front-End
Principaux travaux effectués dans cette partie :

* Réalisation de la page principale ("prévention et explication du groupe et du projet")
* Réalisation de la page Carte régions où nous retrouvons chaques régions de France.
* Réalisation de la page Carte Départements où nous retrouvons chaques départements de France.
* Ajout du boutton Timelapse et d'un choix de date sur les deux pages qui disposent de carte.
* Liaison Base de donnée au Timelapse, Dates, Cartes.
