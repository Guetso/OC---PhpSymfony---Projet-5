# Projet n°5 dans le cadre de la formation Php-Symfony - OpenClassroom
## Créez votre premier blog en PHP

### Contexte

Ça y est, vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main 
et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. 
Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs.

### Description du besoin

Le projet est donc de développer votre blog professionnel. Ce site web se décompose en deux grands groupes de pages :

* les pages utiles à tous les visiteurs
* les pages permettant d’administrer votre blog

Voici la liste des pages qui devront être accessibles depuis votre site web :

* la page d'accueil ;
* la page listant l’ensemble des blog posts ;
* la page affichant un blog post ;
* la page permettant d’ajouter un blog post ;
* la page permettant de modifier un blog post ;
* les pages permettant de modifier/supprimer un blog post ;
* les pages de connexion/enregistrement des utilisateurs ;

Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.

Les pages d’administration seront donc accessibles sur conditions
et vous veillerez à la sécurité de la partie administration.

### Commençons par les pages utiles à tous les internautes.

---

Sur la page d’accueil, il faudra présenter les informations suivantes :

* votre nom et votre prénom ;
* une photo et/ou un logo ;
* une phrase d’accroche qui vous ressemble (exemple : “Martin Durand, le développeur qu’il vous faut !”) ;
* un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;
* un formulaire de contact (à la soumission de ce formulaire, un e-mail avec toutes ces informations vous sera envoyé)
  avec les champs suivants :
  *  nom/prénom,
  *  e-mail de contact,
  *  message,
* un lien vers votre CV au format PDF ;
* l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (GitHub, LinkedIn, Twitter…).

---

Sur la page listant tous les blogs posts (du plus récent au plus ancien),
il faut afficher les informations suivantes pour chaque blog post :

* le titre ;
* la date de dernière modification ;
* le châpo ;
* et un lien vers le blog post ;

---

Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :

* le titre ;
* le chapô ;
* le contenu ;
* l’auteur ;
* la date de dernière mise à jour ;
* le formulaire permettant d’ajouter un commentaire (soumis pour validation) ;
* les listes des commentaires validés et publiés ;

---

Sur la page permettant de modifier un blog post,
l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu.

---

Dans le footer menu, il doit figurer un lien pour accéder à l’administration du blog.


### Contraintes

Cette fois-ci, nous n’utiliserons pas WordPress. Tout sera développé par vos soins.
Les seules lignes de code qui pourront provenir d’ailleurs seront celles du thème Bootstrap,
que vous prendrez grand soin de choisir. La présentation, ça compte !
Il est également autorisé d’utiliser une ou plusieurs librairies externes
à condition qu’elles soient intégrées grâce à Composer.

Attention, votre blog doit être navigable aisément sur un mobile (téléphone mobile, phablette, tablette…). 
C’est indispensable ! C’est indispensable :D

Nous vous conseillons vivement d’utiliser un moteur de templating tel que Twig, mais ce n’est pas obligatoire.

Sur la partie administration,
vous veillerez à ce que seules les personnes ayant le droit “administrateur” aient l’accès ;
les autres utilisateurs pourront uniquement commenter les articles (avec validation avant publication).

**Important** : Vous vous assurerez qu’il n’y a pas de failles de sécurité
(XSS, CSRF, SQL Injection, session hijacking, upload possible de script PHP…).

Votre projet doit être poussé et disponible sur GitHub. Je vous conseille de travailler avec des pull requests.
Dans la mesure où la majorité des communications concernant les projets sur GitHub se font en anglais,
il faut que vos commits soient en anglais.

Vous devrez créer l’ensemble des issues (tickets) correspondant aux tâches que vous aurez à effectuer
pour mener à bien le projet.

Veillez à bien valider vos tickets pour vous assurer que ceux-ci couvrent bien toutes les demandes du projet.
Donnez une estimation indicative en temps ou en points d’effort (si la méthodologie agile vous est familière)
et tentez de tenir cette estimation.

L’écriture de ces tickets vous permettra de vous accorder sur un vocabulaire commun.
Il est fortement apprécié qu’ils soient écrits en anglais !

#### Nota Bene

Votre projet devra être suivi via *SymfonyInsight* ou *Codacy* pour la qualité du code.
Vous veillerez à obtenir une médaille d'argent au minimum (pour SymfonyInsight).
En complément, le respect des *PSR* est recommandé afin de proposer un code compréhensible et facilement évolutif.

Si vous n’arrivez pas à vous décider sur le thème Bootstrap,
en voici un qui pourrait [vous convenir](http://bit.ly/2emOTxY) (source : startbootstrap.com).

Dans le cas où une fonctionnalité vous semblerait mal expliquée ou manquante,
parlez-en avec votre mentor afin de prendre une décision ensemble concernant les choix que vous souhaiteriez faire.
Ce qui doit prévaloir doit être les délais.
De l'aide pour aborder le projet étape par étape

Afin de fluidifier votre avancement voici une proposition de manière de travailler :

    Étape 1 - Prenez connaissance entièrement de l’énoncé et des spécifications détaillées.
    Étape 2 - Créez les diagrammes UML.
    Étape 3 - Créez le repository GitHub pour le projet.
    Étape 4 - Créez l’ensemble des issues sur le repository GitHub (https://github.com/username/nom_du_repo/issues/new).
    Étape 5 - Faites les estimations de l’ensemble de vos issues.
    Étape 6 - Entamez le développement de l’application et proposez des pull requests pour chacunedes fonctionnalités/issues.
        (L’estimation se fera au fur et à mesure de votre développement et sera discutée avec votre mentor.)
    Étape 7 - Faites relire votre code à votre mentor (code proposé dans la ou les pull requests),
        et une fois validée(s) mergez la ou les pull requests dans la branche principale. 
        (Cette relecture servira à valider votre implémentation des bonnes pratiques et la cohérence de votre code. 
        La validation se fera en continu durant les sessions.)
    Étape 8 - Validez la qualité du code via SymfonyInsight ou Codacy.
    Étape 9 - Effectuez une démonstration de l’ensemble de l’application.
    Étape 10 - Préparez l’ensemble de vos livrables et soumettez-les sur la plateforme.


Prenez le temps de valider chaque étape avec votre mentor afin de vous assurer que vous avancez dans la bonne direction ^^

### Livrables

* Un lien vers l’ensemble du projet (fichiers PHP/HTML/JS/CSS…) sur un repository GitHub
* Les instructions pour installer le projet (dans un fichier README à la racine du projet)
* Les schémas UML (au format PNG ou JPG dans un dossier nommé “diagrammes” à la racine du projet)
    * diagrammes de cas d’utilisation
    * diagramme de classes
    * diagrammes de séquence 
* Les issues sur le repository GitHub que vous aurez créé
* Un lien vers la dernière analyse SymfonyInsight ou Codacy (ou vers le projet public sur la plateforme)
