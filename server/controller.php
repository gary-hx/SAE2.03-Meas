<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");


function readMoviesController(){
    $movies = getAllMovies();
    return $movies;
}

function readMovieDetailsController(){
    if (!isset($_REQUEST['id'])){
        return false;
    }
    $id = $_REQUEST['id'];
    $movie = getMovieDetails($id);
    return $movie;
}

function updateMovieController(){

  $name = $_REQUEST['name'];
  $year = $_REQUEST['year'];
  $length = $_REQUEST['length'];
  $description = $_REQUEST['description'];
  $director = $_REQUEST['director'];
  $id_category = $_REQUEST['id_category'];
  $image = $_REQUEST['image'];
  $trailer = $_REQUEST['trailer'];
  $min_age = $_REQUEST['min_age'];
  $ok = updateMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);
  if ($ok!=0){
    return "Le film a été ajouté avec succès.";
  }
  else{
    return false;
  }
}

function addProfileController(){

  if (!isset($_POST['name'], $_POST['age'])) {
      throw new Exception("Paramètres manquants");
  }

  $name = $_POST['name'];
  $age = $_POST['age'];

  $image = $_POST['image'] ?? '';

  $ok = addProfile($name, $image, $age);

  if ($ok != 0){
    return "Le profil a été ajouté avec succès.";
  }
  else{
    return false;
  }
}

function readProfilesController(){
    $profiles = getProfiles();
    return $profiles;
}

