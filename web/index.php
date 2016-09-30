<!DOCTYPE html>
<html>
    <head>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type='text/css'>
        <link href="/css/styles.css" rel="stylesheet" type='text/css'>

        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
        <title>Local Shoe Directory!</title>
    </head>
</html>

<?php
    date_default_timezone_set('America/Los_Angeles');
    $website = require_once __DIR__.'/../app/app.php';
    $website->run();
?>
