# ISI1-WEB-Projet-Final

### A faire
***
`Entreprise`
* Rechercher entreprise (dans index(), si POST alors afficher seulement les entreprises correspondantes aux critères)
* Ajouter entreprise ✅ (ajouter les spécialités dans la table spec_entreprise)
* Afficher/enlever information ✅
* Voir entreprise ✅ (mettre à jour avec les stages)
* Supprimer entreprise ✅
* Modifier entreprise ✅ (ajouter les spécialités dans la table spec_entreprise)

`Stagiaire`
* Rechercher un stagiaire
* Inscrire un étudiant
* Voir les infos d'un stagiaire
* Supprimer un stagiaire
* Modifier un stagiaire

`Autres`
* Système de connexion
* Faire la page d'aide

### Problèmes rencontrés
***
* twig ne render pas les background-image de css donc j'ai du utiliser un chemin absolu lors que l'importation de la feuille de style pour que ça marche
* Pour la barre de navigation, j'ai du passer en parametre de twig->render() la page active et appliquer la class:"actif" sur le bon élément en utilisant ceci :  
```{{ page == 'accueil' ? 'actif' : '' }}```
* Demander s'il faut aller chercher dynamiquement les noms des spécialités ou bien écrire un nombre défini de spécialités dans la liste déroulantes de formulaireEntreprise.twig

### Organisation de l'archive
***
* [`config`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/config) : Contient les fichiers de configuration du site
  * [`database.php`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/config/database.php) : Connexion à la BDD
  * [`getstages.sql`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/config/geststages.sql) : Script de création de la BDD
  * [`routes.php`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/config/routes.php) : Routage vers les différentes pages
* [`public`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/public) : Contient les fichiers publiques du site
  * [`css`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/public/css) : Feuilles CSS
  * [`icons`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/public/icons) : Icones utilisés
  * [`js`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/public/js) : Scripts JavaScript
  * [`index.php`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/public/index.php) : Point d'entrée du site
* [`src`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/src) : Contient les sources du site web, suivant le modèle MVC
  * [`Controller`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/src/Controller) : Intéraction avec le _**Model**_ et choisit la _**View**_ à afficher
  * [`Model`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/src/Model) : Gestion des données et intéraction avec la BDD 
  * [`View`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/src/View) : Interface graphique du site 
* [`vendor`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/vendor) : Contient tous les fichiers de symfony/twig

### Membres
***
AILLAUD Romain  
BEN MAAOUIA Ahdi