## Sommaire
* [Info Générale](#Info Générale)
* [Configuration Laravel](#Configuration Laravel)
* [Back-End](#Back-End)
* [Front-End](#Front-End)

## Info Generale
SDC-DATA / Covid Timelapse / Code Camp par Lucie, Anais, Lucas, Kevin.   

## Configuration Laravel
Commandes a réaliser pour mettre en place Laravel :

* Pour lancer le projet Laravel apres l'avoir git utiliser cette commande : ```php artisan serve``` pour pouvoir lancé le projet.
* Pour Extract la Database nous vous proposons deux commandes : 
``sed -i '' 's/utf8mb4_0900_ai_ci/utf8mb4_unicode_ci/g' dbexport_2.sql``
``/Applications/MAMP/Library/bin/mysql  -uroot -p covid_timelapse < dbexport_2.sql``
ainsi que ``mysql -u username -p dbname < dbexport.sql``
* Si vous avez une erreur  Mysql verifier le port nous avons utilisé personnellement le port 8889 et 3306.


	
## Back-End
Principaux traveaux effectués dans cette partit :

* Réalisation de la base de donnée 
* Réalisation des Controllers 
* Utilisation de la Data du gouvernement voir ci-joint : ```https://www.data.gouv.fr/fr/datasets/chiffres-cles-concernant-lepidemie-de-covid19-en-france/```


## Front-End
Principaux traveaux effectués dans cette partit :

* Réalisation de la page principale ("prévention et explication du groupe et du projet")
* Réalisation de la page Carte régions ou nous retrouvons chaques régions de France.
* Réalisation de la page Carte Départements ou nous retrouvons chaques départements de France.
* Ajout du boutton Timelapse et d'un choix de dates sur les deux pages qui disposent de carte.
* Liaison Base de donnée au Timelapse, Dates, Cartes.
