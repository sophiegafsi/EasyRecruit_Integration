<?php
use Dompdf\Dompdf;
use Dompdf\Options;

// Inclure les classes et fichiers nécessaires
require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php'; 
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
require_once 'C:/xampp/htdocs/Nourprojet/views/dompdf/autoload.inc.php';

// Récupérer l'ID de l'examen spécifique depuis les paramètres GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo("ID de l'examen non reçu.");
    exit;
}

// Créer une instance de la classe Exam
$examManager = new Exam();

// Récupérer les détails de l'examen
$examen = $examManager->getExamenById($pdo, $id);

// Vérifier si l'examen existe
if (!$examen) {
    echo "L'examen avec l'ID $id n'existe pas.";
    exit;
}

// Récupérer l'ID de la formation associée à cet examen
$formationId = $examen->getFormationId();

// Créer une instance de la classe Form
$formManager = new Form();

// Récupérer les détails de la formation associée à cet examen
$formation = $formManager->getFormationById($pdo, $formationId);

// Vérifier si la formation existe
if (!$formation) {
    echo "La formation associée à l'examen avec l'ID $id n'existe pas.";
    exit;
}

// Instancier Dompdf avec l'option 'enable_remote' activée
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Charger le contenu HTML avec les détails de l'examen et de la formation
$html = '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formation et examen</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            h1 {
                font-size: 24px;
                color: #a8324e;
                margin-bottom: 20px;
            }
            h2 {
                font-size: 20px;
                margin-bottom: 10px;
            }
            p {
                font-size: 16px;
                margin-bottom: 5px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #3232a8;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>Foramtion et examen</h1>
            <div>
                <table>
                    <tr>
                        <th>ID de l\'examen</th>
                        <td>' . $examen->getId() . '</td>
                    </tr>
                    <tr>
                        <th>Nom de l\'examen</th>
                        <td>' . $examen->getNom() . '</td>
                    </tr>
                    <tr>
                        <th>Date de l\'examen</th>
                        <td>' . $examen->getDate() . '</td>
                    </tr>
                    <tr>
                        <th>ID de la formation associée</th>
                        <td>' . $examen->getFormationId() . '</td>
                    </tr>
                    <tr>
                        <th>Nom de la formation associée</th>
                        <td>' . $formation->getNom() . '</td>
                    </tr>
                    <tr>
                        <th>Description de la formation</th>
                        <td>' . $formation->getDescription() . '</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
    </html>';

// Charger le HTML dans Dompdf
$dompdf->loadHtml($html);

// Rendre le PDF
$dompdf->render();

// Ajouter l'image en bas du PDF
$image = "http://localhost/Nourprojet/views/EasyRecruit-logo.svg" ; // Remplacer par l'URL de votre image
$canvas = $dompdf->getCanvas();
$canvas->page_script('
    if ($PAGE_NUM == $PAGE_COUNT) {
        $img_w = 300;
        $img_h = 100;
        $y = ($pdf->get_height() - $img_h) / 2;
        $x = ($pdf->get_width() - $img_w) / 2;
        $pdf->image("' . $image . '", $x, $y, $img_w, $img_h);
    }
');

// Afficher le PDF dans le navigateur
$dompdf->stream("examen_$id.pdf");
?>
