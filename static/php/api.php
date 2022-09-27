<?php
require_once('includes/core.php');

if(!isset($_GET['d'])){
    reportError(false, '404', 'Please provide a valid parameter.');
}

switch($_GET['d']) {

    case 'login':
        login($_POST['email'], $_POST['pass']);
        break;

    case 'delete':
        checkSession(false);
        manageFile($_POST['fileid'], $_POST['blacklist']);
        break;

    case 'deleteBlacklist':
        checkSession(false);
        deleteBlacklist($_POST['fileid']);
        break;

    case "fetchData":
        checkSession(false);
        fetchData($_GET['limit'], $_GET['keyword']);
        break;

    case "fetchBlacklist":
        checkSession(false);
        fetchBlacklist($_GET['limit'], $_GET['keyword']);
        break;

    case "delAllIP":
        checkSession(false);
        delAllIP($_POST['fileid'], "false");
        break;

    case "blacklistAllIP":
        checkSession(false);
        delAllIP($_POST['fileid'], "true");
        break;

    case "changePassword":
        checkSession(false);
        changePassword($_POST['pass']);
        break;

    case 'logout':
        session_unset();
        session_destroy();
        session_write_close();
        header('Location: '.MOE_URL.'/index.php#logout');
        break;

    default:
    reportError(false,'404', 'Please provide a valid parameter.');
}
