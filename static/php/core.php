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

    $a = array('success' => $success, 'code' => $code, 'description' => $desc);
    http_response_code($code);
    header('Content-Type: application/json');
    return json_encode($a, JSON_FORCE_OBJECT);

}

function login ($user, $pass) {

    if(empty($user)) {
        die(reportError(false, '400', 'Please provide a username.'));
    }

    if(empty($pass)) {
        die(reportError(false, '400', 'Please provide a password.'));
    }

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
        die(reportError(false, '400', 'Please provide a file ID.'));
    }

    if(empty($blopt)) {
        die(reportError(false, '400', 'Please provide a value for blacklisting.'));
    }

    global $db;

    $d = $db->prepare("SELECT filename, id, hash, originalname FROM files WHERE id = (:id)");
    $d->bindParam(':id', $id);
    $d->execute();
    $result = $d->fetch(PDO::FETCH_ASSOC);

    if($blopt === "true") {
        $d = $db->prepare("INSERT INTO blacklist (hash, originalname) VALUES (:hash, :orig)");
        $d->bindParam(':hash', $result['hash']);
        $d->bindParam(':orig', $result['originalname']);
        $d->execute();

        $d = $db->prepare("DELETE FROM files WHERE id = (:id)");
        $d->bindParam(':id', $result['id']);
        $d->execute();

        if(file_exists(FILES_ROOT.$result['filename'])){
            unlink(FILES_ROOT.$result['filename']);
            die(reportError(true, '200', 'File successfully deleted and blacklisted.'));
        }else{
            die(reportError(false, '200', 'File successfully blacklisted.'));
        }

    } else {

        $d = $db->prepare("DELETE FROM files WHERE id = (:id)");
        $d->bindParam(':id', $result['id']);
        $d->execute();

        if(file_exists(FILES_ROOT.$result['filename'])){
            unlink(FILES_ROOT.$result['filename']);
            die(reportError(true, '200', 'File successfully deleted.'));
        }else{
            die(reportError(false, '400', 'File not found.'));
        }
    }


}

function deleteBlacklist ($id) {

    if(empty($id)) {
        die(reportError(false, '400', 'Please provide a file ID.'));
    }

    global $db;

    $d = $db->prepare("DELETE FROM blacklist WHERE id = (:id)");
    $d->bindParam(':id', $id);
    $d->execute();

    die(reportError(true, '200', 'Blacklist successfully deleted.'));
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

    return number_format($d->fetchColumn() / 1000000, 2);

}

function showVersion () {
    $a = json_decode(file_get_contents(MOE_ROOT.'package.json'));
    print $a->{'name'}.' Version: '.$a->{'version'};
}

function fetchData ($limit, $keyWord,) {

    if(empty($limit)) {
        die(reportError(false, '400', 'Please provide a limit.'));
    }

    if(empty($keyWord)) {
        die(reportError(false, '400', 'Please provide a keyword.'));
    }

    global $db;
    $key = ''.$keyWord.'';
    $d = $db->prepare("SELECT * FROM files WHERE filename like (:word) OR hash = (:word) OR ip like (:word) OR originalname like (:word) LIMIT (:limit)");
    $d->bindParam(':word', $key);
    $d->bindParam(':limit', $limit);
    $d->execute();

    header('Content-Type: application/json');
    echo json_encode($d->fetchAll(PDO::FETCH_ASSOC), JSON_FORCE_OBJECT);

}

function fetchBlacklist ($limit, $keyWord,) {

    if(empty($limit)) {
        die(reportError(false, '400', 'Please provide a limit.'));
    }

    if(empty($keyWord)) {
        die(reportError(false, '400', 'Please provide a keyword.'));
    }


    global $db;
    $key = ''.$keyWord.'';
    $d = $db->prepare("SELECT * FROM blacklist WHERE originalname like (:word) OR hash = (:word) LIMIT (:limit)");
    $d->bindParam(':word', $key);
    $d->bindParam(':limit', $limit);
    $d->execute();
    
    header('Content-Type: application/json');
    echo json_encode($d->fetchAll(PDO::FETCH_ASSOC), JSON_FORCE_OBJECT);

}

function changePassword ($pass) {

    if(empty($pass)){
        die(reportError(false, '400', 'Password cant be empty.'));
    }

    $nPass = password_hash($pass, PASSWORD_BCRYPT);

    global $db;
    $d = $db->prepare("UPDATE accounts SET pass = (:pass) WHERE id = (:id)");
    $d->bindParam(':pass', $nPass);
    $d->bindParam(':id', $_SESSION['id']);
    $d->execute();

    die(reportError(true, '200', 'Password changed!'));

}