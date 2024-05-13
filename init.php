<?php
// Parcourir le répertoire des modèles
foreach (glob( dirname(__FILE__)."/model/". '*.php') as $modelFile) {
    // Récupérer le nom de classe à partir du nom de fichier
    $className = basename($modelFile, '.php');

    // Inclure le fichier de modèle en utilisant son espace de noms
    if($className != 'index'){
        require_once dirname(__FILE__)."/model/" . $className . '.php';
    }
}