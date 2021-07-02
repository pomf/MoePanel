<?php
session_start();
require_once('database.inc.php');


function login ($user, $pass) {

    global $db;

    $d = $db->prepare("SELECT pass, id, email, level FROM accounts WHERE email = (:email)");
    $d->bindParam(':email', $email);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if(password_verify($pass, $result['pass'])){
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['level'] = $result['level'];
        header('Location: dashboard/index.html');
    } else {
        header('Location: index.html#fail');
        die(0);
    }
    
}

function manageFile ($filename, $delid, $blacklist) {

    global $db;

    if(empty($filename)){
        die('?????');
    }

    $d = $db->prepare("SELECT filename, id, hash, originalname FROM files WHERE filename = (:filename)");
    $d->bindParam(':filename', $filename);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if($blacklist){
        $d = $db->prepare("INSERT INTO blacklist (hash, originalname, time) VALUES (:hash, :orig, :time)");
        $d->bindParam(':hash', $result['hash']);
        $d->bindParam(':orig', $result['originalname']);
        $d->bindParam(':time', time());
        $d->execute();
    }

    $d = $db->prepare("DELETE FROM files WHERE id = (:id)");
    $d->bindParam(':id', $result['id']);
    $d->execute();
    unlink(FILES_ROOT.$filename);
    echo 'File deleted!';

}

function fetchData ($count, $keyWord) {

    

}