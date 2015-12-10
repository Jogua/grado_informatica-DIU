<?php $seccion="inicio"; include './php/header.php';?>

<body>
<div class="container">
<p>Inicio</p>

<div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="images/carousel1.png" alt="">
        </div>
        <div class="item">
            <img src="images/carousel2.png" alt="">
        </div>
        <div class="item">
            <img src="images/carousel3.png" alt="">
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>
</body>

<!--<html>
    
    <body>
        <?php
        /*
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
</html> -->

<?php
*/
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

