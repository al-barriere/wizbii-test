# Petit test API




## I/ objectif

* Faire 2 routes GET et POST afin de pouvoir enregistrer les informations des page_view, screen_view ou event selon la documentation : https://analytics.wizbii.com/doc.html.
* Enregistrer les informations dans une base noSQL (Utilisation de mongoDB dans ce cas)

## II/ Installation

* clonage du projet
* `composer install` afin d'installer les bundles utilisés pour ce projet
* création d'un fichier .env pour mettre les informations de sa base de données

Exemple :

` curl -X GET 'http://127.0.0.1:8000/collect?t=pageview&dl=http://www.wizbii.com/bar&ec=ads&el=client&ea=Click_Masthead&ds=web&cn=bpce&cs=wizbii&cm=web&ck=erasmus&cc=foobar&v=1&tid=ER-4564-R&dr=http://www.azerty.com&wct=profile&wui=bariere-antoine&sn=screen_yo&an=application_name&av=2.4.17'`