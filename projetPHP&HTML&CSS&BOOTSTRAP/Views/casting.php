<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>
<div class="container-fluid">
<?php if($type==("default")) { ?>
<h1>Mes castings</h1>
<table class="table table-hover table-responsive-sm table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Film</th>
            <th>Id</th>
            <th>Acteur</th>
            <?php if(isset($_SESSION["id"]) && $_SESSION["id"]==12) { ?>
                <th>Plus d'actions</th>
            <?php } ?>
        </tr>
    </thead>
    <?php
    foreach($castings as $casting){
        $acteur = $casting["acteur"];
        $film = $casting["film"];
        echo "<tr>";
        echo "<th>".$film->id()."</th>";
        echo "<td>".$film->nom()."</td>";
        echo "<td>".$acteur->id()."</td>";
        echo "<td>".$acteur->prenom()." ".$acteur->nom()."</td>";
        if(isset($_SESSION["id"]) && $_SESSION["id"]==12) { ?>
        <td><a class="btn btn-danger" href="index.php?controller=castingController&action=delete&id_film=<?= $film->id() ?>&id_acteur=<?= $acteur->id() ?>">Delete</a>
        <?php } 
        echo "</tr>";
    }
    ?>
</table>
<?php if(isset($_SESSION["id"]) && $_SESSION["id"]==12) { ?> 
    <a class="btn btn-primary" href="index.php?controller=castingController&action=add">Ajouter</a>
<?php } 
    } else if ($type=="add" && $_SESSION["id"]==12) {
?>
    <h1>Ajouter un Casting</h1>
    <form action="index.php?controller=castingController&action=add" method="post">
        <label class="form-label">Numéro d'identifiant du film</label></br>
        <input class="form-control form-control-sm" type="number" placeholder="Id du film" name="film_id"/>
        <hr style="visibility:hidden;">
        <label class="form-label">Numéro d'identifiant de l'acteur</label></br>
        <input class="form-control form-control-sm" type="number" placeholder="Id de l'acteur" name="acteur_id"/>
        <hr style="visibility:hidden;">
        <input class="btn btn-dark" type="submit" value="Ajouter" nam="valid"/>
    </form>
<?php
    }
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>
