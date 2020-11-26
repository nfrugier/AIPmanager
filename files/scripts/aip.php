<?php
    $name = $_POST['name'];

    $actions = [
        $_POST['action0'],
        $_POST['action1'],
        $_POST['action2'],
        $_POST['action3'],
        $_POST['action4'],
        $_POST['action5'],
        $_POST['action6'],
    ];

    $givenSkills = [
        strtolower($_POST['skill0']),
        strtolower($_POST['skill1']),
        strtolower($_POST['skill2']),
        strtolower($_POST['skill3']),
        strtolower($_POST['skill4']),
        strtolower($_POST['skill5']),
        strtolower($_POST['skill6']),
    ];

    if (empty($name)) {
        $name = '...';
    }

    $to = 'nicolas.frugier2+test@gmail.com';
    $subject = 'AIP de '.$name;
    $headers = 'MIME-Version: 1.0'. "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'.'\r\n';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actions de <?php echo $name; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" >
<h1>Actions de <?php echo $name; ?></h1>
<table class="table table-hover table-responsive">
    <thead class="thead-dark">
    <tr>
        <th>Action</th>
        <th>Compétence</th>
        <th>Résultat</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $characters = json_decode(file_get_contents("../data/characters.json"), true);
    if (!in_array($name, $characters['characters'])) {
        echo '<p class="alert alert-danger">Nom inconnu </br>Veuillez recommencer <a href="../../index.php" >Retour</a></p>';
        return;
    }
    $characterSkills = json_decode(file_get_contents('../data/' . strtolower($name) . '.json'), true);

    foreach ($actions as $key => $action) {
        if (empty($givenSkills[$key])) {
            echo '<p class="alert alert-danger">Champ compétence vide </br>Veuillez recommencer <a href="../../index.php" >Retour</a></br></p>';
            return;
        }
        $d20s[] = random_int(1, 20);
        $skillBonus = $characterSkills['competences'][$givenSkills[$key]];
        $result[] = $d20s[$key] + $skillBonus;
        $operator = ($skillBonus < 0) ? ' ' : ' + ';
        switch ($d20s[$key]) {
            case 20:
                $style = "table-success";
                break;
            case 1:
                $style = "table-danger";
                break;
            default:
                $style = "";
                break;
        }
        $message[] = '<tr class="'.$style.'">
                <td>' . $action . '</td>
                <td>' . ucfirst($givenSkills[$key]) . '</td>
                <td>' . $d20s[$key] . $operator . $skillBonus . ' = <b>' . $result[$key] . '</b></td>
              </tr>';

        echo $message[$key];

    }

    //EMAIL

    $body = '
    <html>
    <head>
        <title>'.$subject.'</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <table class="table table-hover table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Action</th>
                    <th>Compétence</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>'
                .$message[0].$message[1].$message[2].$message[3].$message[4].$message[5].$message[6].
            '</tbody>
        </table>
    </body>
    </html>
    ';

    $resultMail = mail($to, $subject, $body, $headers);
    ?>
    </tbody>
</table>
</div>
<footer>Jets de dés effectués avec la méthode PHP <a href="https://www.php.net/manual/fr/function.random-int.php">random_int()</a>.
    </br>Code par <a href="https://github.com/nfrugier/AIPmanager">Thrandal</a>
    </br><?php if($resultMail) {echo 'Un email avec le résultat a été envoyé à votre MJ.';} else {echo 'Une erreur s\'est produite durant l\'envoie de l\'email au MJ';}  ?></footer>
</body>
</html>
