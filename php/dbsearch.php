<?php

require('response.php');
require('dbconnect.php');

if(!isset($_GET['mode'])){
    $response->JSONError("Parameter 'mode' is missing!");
}
if(!isset($_GET['term'])){
    $response->JSONError("Parameter 'term' is missing!");
}
$mode = $_GET['mode'];
$term = $_GET['term'];

if($mode==0){
    // Pass all data to front-end and filter there
    $sql = "SELECT movie_id, title FROM movies";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }
    $movies;
    while ($row = pg_fetch_row($result)) {
        $movies[$row[0]] = $row[1];
        $response->addElement('movies',$movies);
    }

    $sql = "SELECT actor_id, name FROM actors";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }

    $actors;
    while ($row = pg_fetch_row($result)) {
        $actors[$row[0]] = $row[1];
        $response->addElement('actors',$actors);
    }
    
    $response->JSONSuccess("ok");
}
else if($mode==1){
    // Fuzzy Search Actors and Movies
    $sql = "SELECT movie_id, title FROM movies WHERE levenshtein(title,'".$term."') <= 3";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }
    $movies;
    while ($row = pg_fetch_row($result)) {
        $movies[$row[0]] = $row[1];
        $response->addElement('movies',$movies);
    }

    $sql = "SELECT actor_id, name FROM actors WHERE levenshtein(name,'".$term."') <= 3";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }

    $actors;
    while ($row = pg_fetch_row($result)) {
        $actors[$row[0]] = $row[1];
        $response->addElement('actors',$actors);
    }

    $response->JSONSuccess("ok");
}else if($mode==2){
    // Monophone Search
    $sql = "SELECT movie_id, title FROM movies WHERE metaphone(title,6) = metaphone('".$term."',6)";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }
    $movies;
    while ($row = pg_fetch_row($result)) {
        $movies[$row[0]] = $row[1];
        $response->addElement('movies',$movies);
    }

    $sql = "SELECT actor_id, name FROM actors WHERE metaphone(name,6) = metaphone('".$term."',6)";
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }

    $actors;
    while ($row = pg_fetch_row($result)) {
        $actors[$row[0]] = $row[1];
        $response->addElement('actors',$actors);
    }

    $response->JSONSuccess("ok");
}else if($mode==3){
    // Movies of Actor
    //$sql = "SELECT a.movie_id, a.title FROM movies_actors AS c INNER JOIN movies AS a ON a.movie_id = c.movie_id INNER JOIN actors AS b ON b.actor_id = c.actor_id WHERE b.name = '".$term."'";
    $sql = "SELECT a.movie_id, a.title FROM movies_actors AS c NATURAL JOIN movies AS a NATURAL JOIN actors AS b WHERE b.name = '".$term."'";
    
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }

    $movies;
    while ($row = pg_fetch_row($result)) {
        $movies[$row[0]] = $row[1];
        $response->addElement('movies',$movies);
    }
    $response->JSONSuccess("ok");

}else if($mode==4){
    // Actors of Movie
    $sql = "SELECT b.actor_id, b.name FROM movies_actors AS c INNER JOIN actors AS b ON b.actor_id = c.actor_id INNER JOIN movies AS a ON a.movie_id = c.movie_id WHERE a.title = '".$term."'";
    
    $result = pg_query($db, $sql);
    if(!$result){
        $response->JSONError("PQSQL Query Failure!");
    }

    $actors;
    while ($row = pg_fetch_row($result)) {
        $actors[$row[0]] = $row[1];
        $response->addElement('actors',$actors);
    }
    $response->JSONSuccess("ok");
}

?>