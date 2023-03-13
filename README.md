![image](https://user-images.githubusercontent.com/104210204/224580293-3913ec80-9ea0-48a0-9bcf-c054f468e539.png)


# APIREST-gestion-article-de-blog

---

Concevoir une application REST pour la gestion d'article de blog en PHP

* Pour cela, on a 3 moyens pour accéder à l'app
    * Etre un visiteurs sans être authentifié
    * Soit une authentification avec un rôle de mederator ...
    * Soit une authentification avec le rôle de publisher pour pouvoir publier ces articles 

****
## Les fonctionnalités de l'application
* Tant qu'ont est publisher on peut:
    *  Créer ses propre article
    *  Publier ses propre article
    *  Modifier ses propre article
    *  Supprimer ses propre article
    * Voir les commentaires des autres utilisateurs
    * Liker/disliker les articles des autres utilisateurs
    * Commenter les articles des autres utilisateurs

----
* Tant qu'on est moderator on peut:
    * Voir le nom, date, contenu d'un article
    * Voir le nombre de like/dislike d'un article
    * Voir les commentaires d'un article
    * L'application doit permettre de lister les articles publiés
    * L'application doit permettre de lister les articles publiés par un utilisateur

----
* Tant qu'on est visiteur on peut:
    * Voir le nom, date, contenu d'un article
    * Aller chao ;) !
