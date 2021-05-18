<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>
<div class="container-fluid">
<?php if ($type=="default") { ?>
<h1>Détail du film</h1>
<table class="table table-hover table-responsive-sm table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Année de sortie</th>
            <th>Score</th>
            <th>Nombre de votes</th>
            <th>Acteurs</th>
        </tr>
    </thead>
    <?php
    //var_dump($castings, count($castings));
    $countActors = count($castings);
    echo "<tr>";
    echo "<th>".$film->id()."</th>";
    echo "<td>".$film->nom()."</td>";
    echo "<td>".$film->annee()."</td>";
    echo "<td>".$film->score()."</td>";
    echo "<td>".$film->vote()."</td>";
    echo "<td>";
    foreach($castings as $i => $casting){
        $acteur = $casting["acteur"];
        echo $acteur->id() . " - " . $acteur->prenom()." ".$acteur->nom() . "<br>";
    }
    echo "</td></tr>";
    ?>
</table>
<?php if(isset($_SESSION["id"])){ 
        if ($_SESSION["id"]==12) {
?>
    <a class="btn btn-success" href="index.php?controller=filmController&action=update&id=<?= $film->id() ?>">Edit</a>
    <a class="btn btn-danger" href="index.php?controller=filmController&action=delete&id=<?= $film->id() ?>">Delete</a>
<?php } else { ?>
    <a class="btn btn-primary" href="index.php?controller=voteController&action=update&film_id=<?= $film->id() ?>&user_id=<?= $_SESSION["id"] ?>">Voter</a>
<?php }} ?>
<?php } else if ($type=="update") { ?>
<?php
echo "<form action='index.php?controller=voteController&action=update&film_id=".$film->id()."&user_id=".$_SESSION["id"]."' method='post'>"
?>
<label class="form-label">Voter</label>
<div class="input-group mb-3">
    <input style="width: 100px;" type="number" max="10" placeholder="Note" name="note" class="form-control form-control-sm" aria-describedby="basic-addon2" id="note">
    <div>
        <span class="input-group-text" id="basic-addon2">/10</span>
    </div>
</div>
<input class="btn btn-dark" type="submit" value="Valider" name="valid"/>
</form>
</div>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>
