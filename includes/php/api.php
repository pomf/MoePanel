<?php
require_once('core.php');

if(!isset($_GET['d'])){
    reportError(false, '404', 'Please provide a valid parameter.');
}

switch($_GET['d']) {

    case 'login':
        login($_POST['email'], $_POST['pass']);
        break;

    case 'delete':
        checkSession(false);
        manageFile($_GET['fileid'], $_GET['blacklist']);
        break;

    case "fetchData":
        checkSession(false);
        fetchData($_GET['limit'], $_GET['keyword']);
        break;

    case 'logout':
        session_unset();
        session_destroy();
        session_write_close();
        header('Location: ../../index.php#logout');
        break;

    default:
    reportError('404', 'Please provide a valid parameter.');
}