<?php
session_start();
require_once('database.inc.php');


function login ($user, $pass) {

    global $db;

    $d = $db->prepare("SELECT pass, id, email, level FROM accounts WHERE email = (:email)");
    $d->bindParam(':email', $user);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if(password_verify($pass, substr($result['pass'], 0, 60 ))){
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['level'] = $result['level'];
        header('Location: '.MOE_URL.'dashboard/index.php');
    } else {
        header('Location: '.MOE_URL.'index.html#fail-cred');
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

function countFiles () {

    global $db;
    $d = $db->prepare("SELECT count(*) FROM files");
    $d->execute();

    return $d->fetchColumn();
}

function countSize () {

    global $db;
    $d = $db->prepare("SELECT sum(size) FROM files");
    $d->execute();

    return $d->fetchColumn() / 1000000;

}

function fetchData ($keyWord) {

    global $db;
    $key = ''.$keyWord.'';
    $d = $db->prepare("SELECT * FROM files WHERE filename like :word OR hash like :word OR ip like :word OR originalname like :word LIMIT 50");
    $d->bindParam(':word', $key);
    $d->execute();
    $json = json_encode($d->fetchAll(PDO::FETCH_ASSOC), JSON_FORCE_OBJECT);

    print $json;
    
}