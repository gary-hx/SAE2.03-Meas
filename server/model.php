<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "meas5");
define("DBLOGIN", "meas5");
define("DBPWD", "meas5");


function getAllMovies($ageLimit = 0){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les films accessibles selon l'âge du profil
    $sql = "SELECT m.id, m.name, m.image, m.director, c.name AS category FROM Movie m LEFT JOIN Category c ON m.id_category = c.id WHERE m.min_age <= :ageLimit";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL avec le paramètre d'âge
    $stmt->execute(array(':ageLimit' => $ageLimit));
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function getMovieDetails($id){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer tous les détails d'un film par son ID avec le nom de la catégorie
    $sql = "SELECT m.id, m.name, m.year, m.length, m.description, m.director, m.id_category, c.name as category, m.image, m.trailer, m.min_age FROM Movie m LEFT JOIN Category c ON m.id_category = c.id WHERE m.id = :id";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête avec le paramètre lié
    $stmt->execute(array(':id' => $id));
    // Récupère le résultat
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les détails du film
}

function updateMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour un film
    $sql = "REPLACE INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age) VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête avec les paramètres liés
    $result = $stmt->execute(array(
        ':name' => $name,
        ':year' => $year,
        ':length' => $length,
        ':description' => $description,
        ':director' => $director,
        ':id_category' => $id_category,
        ':image' => $image,
        ':trailer' => $trailer,
        ':min_age' => $min_age
    ));
    // Retourne 1 si la mise à jour a réussi, 0 sinon
    return $result ? 1 : 0;
}


function updateProfile($id, $name, $image, $age){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "REPLACE INTO Profile (id, name, image, age) VALUES (:id, :name, :image, :age)";
    $stmt = $cnx->prepare($sql);
    $result = $stmt->execute(array(
        ':id'    => $id,
        ':name'  => $name,
        ':image' => $image,
        ':age'   => $age
    ));
    return $result ? 1 : 0;
}

function addProfile($name, $image, $age){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour un profil
    $sql = "INSERT INTO Profile (name, image, age) VALUES (:name, :image, :age)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête avec les paramètres liés
    $result = $stmt->execute(array(
        ':name' => $name,
        ':image' => $image,
        ':age' => $age
    ));
    // Retourne 1 si la mise à jour a réussi, 0 sinon
    return $result ? 1 : 0;
}

function getProfiles(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer tous les profils
    $sql = "SELECT id, name AS nom, image, age AS restriction_age FROM Profile";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

// public function __construct()
// {
//    try {
//        $this->cnx = new PDO("mysql:host=localhost;dbname=SAE203", "meas5", "996j91SLrMGZgxi");
//        $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//    } catch (Exception $e) {
//        echo $e->getMessage();
//    }
// }