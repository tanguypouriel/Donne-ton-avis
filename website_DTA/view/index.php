<?php 
define('__ROOT__', dirname(__DIR__));

require_once __ROOT__.'/model/SurveyManager.php';
require_once __ROOT__.'/model/WebsiteUserManager.php';


//Disons qu'on veuille afficher sur notre page d'index les dix premiers sondages donnés par la db : 

$surveys = $surveyManager->getSurveys(1,10); // C'est un tableau de sondages

//Il faut maintenant les afficher sur la page HTML

$surveysView = "";

foreach ($surveys as $survey){
    $surveysView .= "<div class=\"item\">\n";
    $surveysView .= "<div class=\"image\">\n";
    $surveysView .= "<img src=\"". $survey->getImagePath() ."\">";
    $surveysView .= "\n</div>\n<div class='content' >\n";
    $surveysView .= "<a class='header' href='pageSurvey.php'>". $survey->getTitle() ."</a>\n";
    $surveysView .= "<div class='meta'>\n";
    $surveysView .= "<span>Créé par ". $userManager->getUserById($survey->getIdAuthor())->getUserName()."</span>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "<div class='description'>\n";
    $surveysView .= "<p>". $survey->getDescription() ."</p>\n";
    $surveysView .= "</div>\n";
   // $surveysView .= "<div class='extra'> Date de fin du sondage : ". $survey->getDateFin() ." </div>\n";
    $surveysView .= "</div>\n</div>\n";
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bienvenue sur DTA</title>

        <link href="semantic.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
    </head>
    <body>
        
        <?php include ('header.html'); ?>


        <section class="sondages">

            <h1 class="ui block header">Envie de participer à un sondage ?</h1>

            <div class="ui items ">          
                <?php $surveysView?>
            </div>    

        </section>

        <section class="creation sondage">
            <h1 class="ui block header">Envie de proposer un autre sondage ?</h1>
            <div class="ui segment">
                <p>Vous avez parcouru tout les sondages du site mais toujours pas de traces de celui qui trottait dans votre tête ?
                    Vous pouvez toujours créer le vôtre dans cette section. C'est simple et rapide : en quelques clics vous pouvez parametrer la manière
                    dont les gens interagiront avec vôtre sondage.</p>
                <a href="addNewSurvey.php"><button class="ui button floated right" type="button" >Créer un sondage</button></a>
            </div>
        </section>


        <?php include ('footer.html'); ?>
    </body>
</html>
