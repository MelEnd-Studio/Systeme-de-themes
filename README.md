# Systeme-de-themes

## Qu'est ce que c'est ?
C'est un script de template complète rapide et efficace en Php ! Capable de gérer plusieurs pages simultanément. Il contient un système permettant de gérer les includes (header/footer) pour vos sites web.

## Les fonctions:

```php
require("system_template.php"); //Import du system

$syst = new template("dossier thème (ne pas oublier le '/' de fin)", "nom du template"); //Utilisation de la classe plus configuration de base

$syst->set_var('nom', "valeur"); //Ajouter une variables

$syst->set_template("nom du template"); //Modifier le nom du template défini préalablement

$syst->set_directory("dossier thème (ne pas oublier le '/' de fin)"); //Modifier le dossier thème défini préalablement

$syst->clear_var(); //Supprimer toutes les variable défini préalablement

$syst->load_page("nom de la page à afficher", false); //Affiche la page demandé, le paramètre boolean est le prise en compte ou pas des includes (header/footer)
```

## Exemple de dossier thème:
```
|--(nom thème)
|		|--(css)
|		|    |-style.css
|		|
|		|--(js)
|		|    |-script.js
|		|
|		|--(pages)
|		     |-accueil.tpl
|            |-contact.tpl
|            |
|		     |--(includes)
|		            |-header.tpl
|		            |-footer.tpl
|-require.json
```
Pour plus d'informations voir les exemples disponibles dans (exemples/templates).