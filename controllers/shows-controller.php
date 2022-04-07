<?php
    require_once(dirname(__FILE__).'/../config/config.php');
    $error = '';

    // connect BDD
    try{
        $sth = new PDO(DSN, ACCOUNT, PASSWORD, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        $sth -> exec('SET NAMES utf8');
    } catch (PDOException $e){
        $error .= $e->getMessage();
    }
    
    try {
        // request
        $request = 'SELECT * FROM `colyseum`.`showtypes`';
        // prepare BDD
        $sth = $sth->prepare($request);
        // execute BDD
        $sth->execute();
        $showsType = $sth->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e){
        $error .= $e->getMessage();
    }
    
    // views
    include(dirname(__FILE__) .'/../views/templates/header.php');
    include(dirname(__FILE__) .'/../views/shows.php');
    include(dirname(__FILE__) .'/../views/templates/footer.php');