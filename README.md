![image](https://user-images.githubusercontent.com/104210204/224580293-3913ec80-9ea0-48a0-9bcf-c054f468e539.png)


# APIREST-gestion-article-de-blog

---

Concevoir une application REST pour la gestion d'articles de blog en PHP

* Il existe 3 moyens d'accéder à l'application :
    * Etre un visiteur sans être authentifié
    * Etre authentifié avec un rôle moderateur
    * Etre authentifié avec un rôle publisher 

****
## Les fonctionnalités de l'application
* En tant que publisher, on peut:
    *  Publier des articles
    *  Modifier ses propres articles
    *  Supprimer ses propres articles
    * Voir les commentaires des autres utilisateurs
    * Liker/disliker les articles des autres utilisateurs
    * Commenter les articles des autres utilisateurs

----
* En tant que moderateur, on peut:
    * Voir le nom, la date et le contenu d'un article
    * Voir le nombre de like/dislike d'un article
    * Voir les commentaires d'un article
    * L'application doit permettre de lister les articles publiés
    * L'application doit permettre de lister les articles publiés par un utilisateur

----
* En tant que visiteur, on peut:
    * Voir le nom, la date et le contenu d'un article
