<?php
require_once('core.php');

if(!isset($_GET['d'])){
    die('What do you want?');
}

switch($_GET['d']) {

    case 'login':
        login($_POST['email'], $_POST['pass']);
        break;

    case 'delete':
        manageFile($_GET['filename'], $_GET['fileid'], $_GET['blacklist']);
        break;

    case "fetchData":
        fetchData($_GET['count'], $_GET['keyword']);
        break;

    case 'logout':
        session_unset();
        session_destroy();
        session_write_close();
        header('Location: ../../index.php#logout');
        break;

    default:
        die('???');
}