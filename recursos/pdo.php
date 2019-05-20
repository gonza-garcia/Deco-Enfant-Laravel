<?php

    $dsn = 'mysql:host=localhost;dbname=deco_enfant;port=3306';
    $user = "root";
    $pass = "";

    try
    {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (\Exception $e)
    {
      echo $e->getMessage();
    }

?>
