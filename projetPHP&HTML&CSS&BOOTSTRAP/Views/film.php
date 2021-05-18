<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>
<div class="container-fluid">
<?php if($type=="default") { ?>
<h1>Ma médiathèque de films</h1>
<table class="table table-hover table-responsive-sm table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Film</th>
            <th>Acteurs</th>
            <th>Plus d'informations</th>
            <?php if(isset($_SESSION["id"])){ ?>
                <th>Plus d'actions</th>
            <?php } ?>
        </tr>
    </thead>
    <?php
    foreach($actorsInFilm as $aif){
        $film = $aif["film"];
        $acteurs = $aif["acteurs"];
        $id = $film->id();
        echo "<tr id='".$film->id()."'>";
        echo "<th>".$film->id()."</td>";
        echo "<td>".$film->nom()."</td>";
        echo "<td>";
        foreach($acteurs as $acteur){
            echo $acteur->prenom()." ".$acteur->nom()."</br>";
        }
        echo "</td>";
        ?>
        <td><a class="btn btn-dark" href="index.php?controller=filmController&action=detailFilm&id=<?= $id ?>&type=default">Détails</a></td>
        <?php if(isset($_SESSION["id"])){
            echo "<td>";
                if($_SESSION["id"]==12){
        ?>
        <a class="btn btn-success" href="index.php?controller=filmController&action=update&id=<?= $id ?>">Edit</a>
        <a class="btn btn-danger" href="index.php?controller=filmController&action=delete&id=<?= $id ?>">Delete</a>
        <?php 
                } else {
        ?>
        <a class="btn btn-primary" href="index.php?controller=voteController&action=update&film_id=<?= $id ?>&user_id=<?= $_SESSION["id"] ?>">Voter</a>
        <?php }} ?>
        </td>
        <?php
        echo "</tr>";
    }
    ?>
</table>
<?php if(isset($_SESSION["id"]) && $_SESSION["id"]==12){ ?>
<a class="btn btn-primary" href="index.php?controller=filmController&action=add">Ajouter</a>
<?php } ?>
<?php } else if ($type=="update" && $_SESSION["id"]==12) {
    echo "<h1>Modifier ".$film->nom()."</h1>";
    echo "<table class='table table-hover table-responsive-sm table-sm table-striped'>";
    echo "<thead class='thead-light'><tr><th>Id</th><th>Nom</th><th>Annee</th>
    <th>Score</th><th>Vote</th></tr></thead>";
    echo "<tr>";
    echo "<th>".$film->id()."</th>";
    echo "<td>".$film->nom()."</td>";
    echo "<td>".$film->annee()."</td>";
    echo "<td>".$film->score()."</td>";
    echo "<td>".$film->vote()."</td>";
    echo "</tr>";
    echo "</table>";
    echo "<form action='index.php?controller=filmController&action=update&id=".$film->id()."' method='post'>";
    ?>
        <label class="form-label">Nom du film</label></br>
        <input class="form-control form-control-sm" type="text" placeholder="Titre" name="nom"/>
        <hr style="visibility:hidden;">
        <label class="form-label">Année de sortie</label></br>
        <input class="form-control form-control-sm" type="number" placeholder="Année de sortie" name="annee"/>
        <hr style="visibility:hidden;">
        <label class="form-label">Score</label></br>
        <input class="form-control form-control-sm" type="number" placeholder="Score" name="score"/>
        <hr style="visibility:hidden;">
        <label class="form-label">Nombre de votants</label></br>
        <input class="form-control form-control-sm" type="number" placeholder="Nombre de votants" name="nbvotants"/>
        <hr style="visibility:hidden;">
        <input class="btn btn-dark" type="submit" value="Modifier" name="valid"/>
    </form>
<?php } else if ($type=="add" && $_SESSION["id"]==12) { ?>
    <h1>Ajouter un film</h1>
    <form action="index.php?controller=filmController&action=add" method="post">
    <label class="form-label">Nom du film</label></br>
    <input class="form-control form-control-sm" type="text" placeholder="Titre" name="nom"/>
    <hr style="visibility:hidden;">
    <label class="form-label">Année de sortie</label></br>
    <input class="form-control form-control-sm" type="number" placeholder="Année de sortie" name="annee"/>
    <hr style="visibility:hidden;">
    <label class="form-label">Score</label></br>
    <input class="form-control form-control-sm" type="number" placeholder="Score" name="score"/>
    <hr style="visibility:hidden;">
    <label class="form-label">Nombre de votants</label></br>
    <input class="form-control form-control-sm" type="number" placeholder="Nombre de votants" name="nbvotants"/>
    <hr style="visibility:hidden;">
    <input class="btn btn-dark" type="submit" value="Ajouter" name="valid"/>
    </form>
<?php } ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>
