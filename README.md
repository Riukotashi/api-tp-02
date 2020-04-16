# api-tp-02


## Qu'est-ce qu'un DTO et à quoi sert-il ?
Pour Data transfer Object, il permet de passé de note entité en base de donnée (avec un stockage optimsé) a une entité avec seulement les champs nécessaire et qui peuvent être calculé

## Quelle est la différence entre un listener et un subscriber dans Symfony ?
Le subscriber déclare l'event qu'il utilise alors que le listener doit etre configurer pour recevoir l'event

## Qu'est-ce qu'un JWT ? Pourquoi l'utilise-t-on plutôt que les sessions PHP ?
JWT = Json Web Token est un token utilisé pour l'authentification lorsqu'on utilise des apis, on l'utilise car dans le cadre d'une api le serveur ne stocke aucune session en local il fournit juste de la donnée

## Qu'est-ce que CORS ?
Cross-origin resource sharing, Permet le partage de donnée entre le client et le serveur. Par exemple il faut configurer lorsque veut faire un front une ip autorisé à accéder à la ressource partagée par le serveur 

## Quelle est la différence entre JSON et JSON-LD ?
Json-ld est un format enrichit de json il contient donc plus d'information comme par exemple l'url d'accè a la ressource mais aussi l'entité a laquelle elle est rélié, ça permet de mieux comprendre l'architecture de l'application