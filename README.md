<img  style="float: left; margin: 0 10px 0 0; " alt="" src="./ressources/logo_api.png">



# APIREST-gestion-article-de-blog

---

Concevoir une API REST pour la gestion d'articles de blog en PHP

* Il existe 3 moyens d'accéder à l'api:
    * Etre un visiteur sans être authentifié
    * Etre authentifié avec un rôle moderateur
    * Etre authentifié avec un rôle publisher 

****
## Les fonctionnalités de l'API
* En tant que publisher, on peut:
    *  Publier des articles
    *  Modifier/supprimer ses propres articles
    * Liker/disliker les articles des autres utilisateurs

----
* En tant que moderateur, on peut:
    * Voir le nom, la date et le contenu d'un article
    * Voir le nombre de like/dislike d'un article
    * L'API permet de lister les articles publiés
    * L'API permet de lister les articles publiés par un utilisateur

----
* En tant que visiteur, on peut:
    * Voir le nom, la date et le contenu d'un article
