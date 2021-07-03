<?php
session_start();
require_once('database.inc.php');

function checkSession($redir) {

    if ($redir AND !isset($_SESSION['moe'])) {
        reportError(false, '403', 'Forbidden please log in!');
        die(header('Location: '.MOE_URL.'index.php'));
    }

    if (!$redir AND !isset($_SESSION['moe'])) {
        die(reportError(false, '403', 'Forbidden please log in!'));
    }

}

function reportError ($success, $code, $desc) {

    $a = array('success' => $success, 'errorcode' => $code, 'description' => $desc);
    print json_encode($a, JSON_FORCE_OBJECT);

}

function login ($user, $pass) {

    global $db;

    $d = $db->prepare("SELECT pass, id, email, level FROM accounts WHERE email = (:email)");
    $d->bindParam(':email', $user);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if(password_verify($pass, substr($result['pass'], 0, 60 ))){
        $_SESSION['moe'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['level'] = $result['level'];
        header('Location: '.MOE_URL.'dashboard/index.php');
    } else {
        header('Location: '.MOE_URL.'index.html#fail-cred');
        die(0);
    }
    
}

function manageFile ($id, $blopt) {

    if(empty($id)) {
        die(reportError(false, '200', 'Please provide a value for file ID.'));
    }

    if(empty($blopt)) {
        die(reportError(false, '200', 'Please provide a value for blacklisting.'));
    }

    global $db;

    $d = $db->prepare("SELECT filename, id, hash, originalname FROM files WHERE id = (:id)");
    $d->bindParam(':id', $id);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if($blopt == 'true') {
        $d = $db->prepare("INSERT INTO blacklist (hash, originalname, time) VALUES (:hash, :orig, :time)");
        $d->bindParam(':hash', $result['hash']);
        $d->bindParam(':orig', $result['originalname']);
        $d->bindParam(':time', time());
        $d->execute();
    }

    $d = $db->prepare("DELETE FROM files WHERE id = (:id)");
    $d->bindParam(':id', $result['id']);
    $d->execute();
    unlink(FILES_ROOT.$result['filename']);

    if($blopt == 'true') {
    die(reportError(true, '200', 'File deleted and blacklisted.'));
    } else {
    die(reportError(true, '200', 'File deleted.'));
    }
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

    return number_format($d->fetchColumn() / 1000000, 1);

}

function fetchData ($limit, $keyWord,) {

    global $db;
    $key = ''.$keyWord.'';
    $d = $db->prepare("SELECT * FROM files WHERE filename like :word OR hash like :word OR ip like :word OR originalname like :word LIMIT :limit");
    $d->bindParam(':word', $key);
    $d->bindParam(':limit', $limit);
    $d->execute();
    
    print json_encode($d->fetchAll(PDO::FETCH_ASSOC), JSON_FORCE_OBJECT);

}