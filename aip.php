<?php
$name = $_POST['name'];
$action = $_POST['action'];
$skill = $_POST['skill'];
$days = $_POST['days'];

$characters = json_decode(file_get_contents("characters.json"),true);
if (!in_array($name, $characters['characters'])) {
    echo "Nom inconnu </br>Veuillez recommencer <a href='index.html' >Retour</a>";
    return;
}

if($days>0) {
    $d20 = random_int(1,20);
}



echo "<h1>Actions de $name</h1>";
echo "<table>";
echo "<tr><th>Action</th><th>Compétence</th><th>Résultat</th></tr>";
echo "<tr><td>$action</td><td>$skill</td><td>$d20</td></tr>";
echo "</table>";
