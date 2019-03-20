<?php #By EndMove
require("../system_template.php"); //On inclut le script de gestion des themes/templates.

$syst = new template("systeme-de-themes/exemples/templates/", "endmove"); //On initialise le script (1: dossier template depuis la racine, 2: nom du template).
# Remarque:
# - la synthax du dossier source est très importante, ne pas oublier le "/" à la fin.
# - démarre a la racine du serveur (!)

$syst->set_var('name', "endmove"); //On ajoute une variable à afficher (1: le nom de la variable, 2: la valeur de la variable).
$syst->set_var('languages', "PHP, JSON, HTML");

$syst->load_page("accueil", false); //On affiche la page/charge le tempate (1: le nom de la page, 2: si on charge ou non les includes footer/header).
?>