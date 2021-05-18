<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>
<div class="container-fluid">
<?php if ($type=="default") { ?>
<h1>Ma médiathèque d'acteurs</h1>
<table class="table table-hover table-responsive-sm table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Acteur</th>
            <th>Films</th>
            <?php if(isset($_SESSION["id"]) && $_SESSION["id"]==12){ ?>
                <th>Plus d'actions</th>
            <?php } ?>
        </tr>
    </thead>
    <?php
    foreach($filmsWithActors as $fwa){
        $acteur = $fwa["acteur"];
        $films = $fwa["films"];
        echo "<tr>";
        echo "<th>".$acteur->id()."</th>";
        echo "<td>".$acteur->prenom()." ".$acteur->nom()."</td>";
        echo "<td>";
        foreach($films as $film){
            echo $film->nom()."</br>";
        }
        echo "</td>";
        if(isset($_SESSION["id"]) && $_SESSION["id"]==12){
        ?>
        <td><a class="btn btn-success" href="index.php?controller=acteurController&action=update&id=<?= $acteur->id() ?>">Edit</a>
        <a class="btn btn-danger" href="index.php?controller=acteurController&action=delete&id=<?= $acteur->id() ?>">Delete</a><td>
        <?php
        }
        echo "</tr>";
    }
    ?>
</table>
<?php if(isset($_SESSION["id"]) && $_SESSION["id"]==12){ ?>
    <a class="btn btn-primary" href="index.php?controller=acteurController&action=add&id=<?= $acteur->id() ?>">Ajouter</a>
<?php } ?>
<?php } else if($type=="update" && $_SESSION["id"]==12) { 
    echo "<h1>Modifier</h1>";
    echo "<table class='table table-hover table-responsive-sm table-sm table-striped'>";
    echo "<thead class='thead-light'><tr><th>Id</th><th>Prenom</th><th>Nom</th></tr></thead>";
    echo "<tr>";
    echo "<th>".$acteur->id()."</th>";
    echo "<td>".$acteur->prenom()."</td>";
    echo "<td>".$acteur->nom()."</td>";
    echo "</tr>";
    echo "</table>";
    echo "<form action='index.php?controller=acteurController&action=update&id=".$acteur->id()."' method='post'>";
?> 
    <hr style="visibility:hidden;">
    <label class="form-label">Prenom</label></br>
    <input class="form-control form-control-sm" type="text" placeholder="Prenom" name="prenom"/>
    <hr style="visibility:hidden;">
    <label class="form-label">Nom</label></br>
    <input class="form-control form-control-sm" type="text" placeholder="Nom" name="nom"/>
    <hr style="visibility:hidden;">
    <input class="btn btn-dark" type="submit" value="Modifier" nam="valid"/>
    </form>
<?php } else if($type=="add" && $_SESSION["id"]==12) { ?>
    <h1>Ajouter un acteur</h1>
    <form action="index.php?controller=acteurController&action=add" method="post">
    <label class="form-label">Prenom</label></br>
    <input class="form-control form-control-sm" type="text" placeholder="Prenom" name="prenom"/>
    <hr style="visibility:hidden;">
    <label class="form-label">Nom</label></br>
    <input class="form-control form-control-sm" type="text" placeholder="Nom" name="nom"/>
    <hr style="visibility:hidden;">
    <input class="btn btn-dark" type="submit" value="Ajouter" nam="valid"/>
    </form>
<?php } ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>

