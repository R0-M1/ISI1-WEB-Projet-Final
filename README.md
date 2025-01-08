# ISI1-WEB-Projet-Final

### Utilisation
***

1. Installez un serveur XAMPP
2. Placez le contenu de l'archive dans le dossier `C:\xampp\htdocs`
3. Exécutez le script SQL dans phpMyAdmin :
   - Ouvrez votre navigateur et accédez à [phpMyAdmin](http://localhost/phpmyadmin).
   - Connectez-vous avec vos identifiants (par défaut, le nom d'utilisateur est `root` et le mot de passe est vide).
   - Executez le script `geststages.sql`.
4. Une fois le serveur XAMPP démarré, ouvrez votre navigateur et allez sur l'URL suivante :  
   [https://localhost/ISI1-WEB-Projet-Final/public/index.php](https://localhost/ISI1-WEB-Projet-Final/public/index.php)  
   Votre serveur est maintenant opérationnel et vous pouvez accéder à l'application web.

### Problèmes rencontrés
***
* Twig n'arrive pas à importer des feuilles de style css en utilisant un chemin relatif. Il a donc fallu utiliser un chemin absolu.
* Pour la barre de navigation, On a du passer le nom de la page active en parametre de la fonction twig->render() afin d'appliquer la class: "actif" sur le bon élément.

### Organisation du binôme
***
Le projet a été séparé en 2 parties bien qu'on ait quand meme suivi la partie de l'autre.
* **Romain** -> Controller, View, js et css
* **Ahdi** -> Model et plusieurs View

### A faire
***
`Entreprise`
* Rechercher entreprise ✅
* Ajouter entreprise ✅
* Afficher/enlever information ✅
* Voir entreprise ✅
* Supprimer entreprise ✅
* Modifier entreprise ✅
* Inscrire un étudiant à l'entreprise sélectionnée ✅

`Stagiaire`
* Rechercher un stagiaire ✅
* Ajouter un étudiant ✅
* Voir les infos d'un stagiaire ✅
* Supprimer un stagiaire ✅
* Modifier un stagiaire ✅

`Inscription`
* Inscrire un étudiant à un stage ✅

`Autres`
* Système de connexion ✅
* Faire la page d'aide ✅

### Organisation de l'archive
***
* [`config`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/tree/main/config) : Contient les fichiers de configuration du site
  * [`database.php`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/config/database.php) : Connexion à la BDD
  * [`geststages.sql`](https://github.com/R0-M1/ISI1-WEB-Projet-Final/blob/main/config/geststages.sql) : Script de création de la BDD
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