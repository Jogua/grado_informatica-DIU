<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CoWorking</title>

        <script src="js/npm.js"></script>
        <script src="js/bootstrap.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        if (empty($_GET['sec'])) {
            $seccion = "inicio";
        } else {
            $seccion = $_GET['sec'];
        }
        ?>
        <div class="container">
            <header>
                <?php
                include './php/header.php';
                ?>
            </header>
            <section>
                <?php
                include './php/content.php';
                ?>
            </section>
        </div>

    </body>
</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

