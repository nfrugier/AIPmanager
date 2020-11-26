<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestionnaire d'AIP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<form action="files/scripts/aip.php" method="post">
    <p><input type="text" name="name" placeholder="Nom du personnage"/></p>

    <?php
    for ($i = 0 ; $i <= 6 ; $i++) {
        echo '<p>Jour '.$i.' <input type="text" name="action'.$i.'" placeholder="Action"/>
              <select name="skill'.$i.'">
            <option value="">--Choisir une compétence--</option>
            <option value="acrobatie">Acrobatie</option>
            <option value="arcanes">Arcanes</option>
            <option value="athletisme">Athletisme</option>
            <option value="discretion">Discrétion</option>
            <option value="dressage">Dressage</option>
            <option value="escamotage">Escamotage</option>
            <option value="histoire">Histoire</option>
            <option value="intimidation">Intimidation</option>
            <option value="investigation">Investigation</option>
            <option value="medecine">Médecine</option>
            <option value="nature">Nature</option>
            <option value="perception">Perception</option>
            <option value="perspicacite">Perspicacité</option>
            <option value="persuasion">Persuasion</option>
            <option value="religion">Religion</option>
            <option value="representation">Représentation</option>
            <option value="survie">Survie</option>
            <option value="tromperie">Tromperie</option>
        </select>
        </p>';
    }

    ?>
    <p><input type="submit" value="Envoyer" class="btn btn-primary"/></p>
</form>
</body>
</html>
