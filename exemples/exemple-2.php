<?php
require("../system_template.php");

$syst = new template("systeme-de-themes/exemples/templates/", "melend42");
$syst->set_var('titre', "Site Web de MelEnd42");
$syst->set_var('presentation', "<u>(ici j'écrit ma présentation)</u>");
$syst->load_page("accueil", true);
?>