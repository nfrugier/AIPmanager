<html>
<head>
    <meta charset="UTF-8">
    <title>Actions de <?php echo $_POST['name'];?></title>
</head>
<body>
<h1>Actions de <?php echo $_POST['name'];?></h1>
<table>
    <tr><th>Action</th><th>Compétence</th><th>Résultat</th></tr>

    <?php
$name = $_POST['name'];

$actions = [
    $_POST['action1'],
    $_POST['action2'],
    $_POST['action3'],
    $_POST['action4'],
    $_POST['action5'],
    $_POST['action6'],
    $_POST['action7'],
];

$givenSkills = [
    strtolower($_POST['skill1']),
    strtolower($_POST['skill2']),
    strtolower($_POST['skill3']),
    strtolower($_POST['skill4']),
    strtolower($_POST['skill5']),
    strtolower($_POST['skill6']),
    strtolower($_POST['skill7']),
];

$characters = json_decode(file_get_contents("../data/characters.json"),true);
if (!in_array($name, $characters['characters'])) {
    echo "Nom inconnu </br>Veuillez recommencer <a href='../../index.html' >Retour</a>";
    return;
}
$characterSkills = json_decode(file_get_contents("../data/".strtolower($name).".json"), true);

foreach ($actions as $key=>$action) {
    if (empty($givenSkills[$key])) {
        echo "Champ compétence vide </br>Veuillez recommencer <a href='../../index.html' >Retour</a></br>";
        continue;
    }
    if(!array_key_exists($givenSkills[$key], $characterSkills['competences'])) {
        echo "Mauvaise compétence </br>Veuillez recommencer <a href='../../index.html' >Retour</a></br>";
        continue;
    }
    $d20s[] = random_int(1,20);
    $skillBonus = $characterSkills['competences'][$givenSkills[$key]];
    $result[] = $d20s[$key] + $skillBonus;

    echo "<tr><td>$action</td><td>".ucfirst($givenSkills[$key])."</td><td>$d20s[$key] + $skillBonus = <b>$result[$key]</b></td></tr>";

}

?>
</table>
<footer>Jets de dés effectués avec la méthode PHP <a href="https://www.php.net/manual/fr/function.random-int.php">random_int()</a>.
    </br>Code par <a href="https://github.com/nfrugier/AIPmanager">Thrandal</a></footer>
</body>
</html>
