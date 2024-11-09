# ISI1-WEB-Projet-Final

### A faire :


### Problèmes rencontrés :
* twig ne render pas les background-image de css donc j'ai du utiliser un chemin absolu lors que l'importation de la feuille de style pour que ça marche
* Pour la barre de navigation, j'ai du passer en parametre de twig->render() la page active et appliquer la class:"actif" sur le bon élément en utilisant ceci :  
```{{ page == 'accueil' ? 'actif' : '' }}```


### Organisation de l'archive
***
* [`config`]() : Contient les fichiers de configuration du site (connexion à la BDD, routage vers les pages et script de création de BDD)
  * [`database.php`]() : Connexion à la BDD
  * [`getstages.sql`]() : Script de création de la BDD
  * [`routes.php`]() : Routage vers les différentes pages
* [`public`]() : Contient les fichiers publiques du site
  * [`css`]() : Feuilles CSS
  * [`icons`]() : Icones utilisés
  * [`js`]() : Scripts JavaScript
  * [`index.php`]() : Point d'entrée du site
* [`src`]() : Contient les sources du site web, suivant le modèle MVC
  * [`Controller`]() : Intéraction avec le _**Model**_ et choisit la _**View**_ à afficher
  * [`Model`]() : Gestion des données et intéraction avec la BDD 
  * [`View`]() : Interface graphique du site 
* [`vendor`]() : Contient tous les fichiers de symfony/twig

### Membres
***
AILLAUD Romain
BEN MAAOUIA Ahdi