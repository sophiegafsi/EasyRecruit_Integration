<?php

class JobseekerController
{
    function isPDF($file)
    {
        // Obtenez le type MIME du fichier
        $mime = mime_content_type($file['tmp_name']);

        // Vérifiez si le type MIME est celui d'un PDF
        return $mime === 'application/pdf';
    }
    public function postuler()
    {
        if (isset($_POST['submit']) && $_POST['submit'] == 1) {
            // Vérifier si un fichier a été téléchargé avec succès
            if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
                if ($this->isPDF($_FILES['fichier'])){
                    $file_name = $_FILES['fichier']['name'];
                    $file_name = $_POST['id_offer'] . rand(0, 99) . date('YmdHis') . '_' . $file_name;
                    $file_tmp_name = $_FILES['fichier']['tmp_name'];

                    // Définir le chemin du dossier de destination
                    $upload_dir = _PROJECT_DIR_ . '/upload/';

                    // Déplacer le fichier téléchargé vers le dossier de destination
                    if (move_uploaded_file($file_tmp_name, $upload_dir . $file_name)) {
                        // Le fichier a été téléchargé avec succès

                        // A FAIRE : recuperer l'id user depuis la session : PARTIE IHEB
                        // exemple j'ai mis id utilisateur = 9
                        $user_id = 9;

                        $job_seeker = new JobSeeker();
                        $job_seeker->setPhone($_POST['phone']);
                        $job_seeker->setEmail($_POST['email']);
                        $job_seeker->setFichier($file_name);

                        $job_seeker->setDateAdd(date('Y-m-d H:i:s'));

                        $job_seeker->setUserId($user_id);
                        $job_seeker->setJobOfferId($_POST['id_offer']);
                        if ($job_seeker->add()) {
                            $success[] = 'Votre demande a été enregistré';
                        } else {
                            $errors[] = 'Erreur dans la sauvegarde';
                        }


                    } else {
                        // Erreur lors du téléchargement du fichier
                        $errors[] = "Une erreur s'est produite lors du téléchargement du fichier.";
                    }
                }else{
                    $errors[] = "Le fichier n'est pas un PDF.";

                }

            } else {
                // Aucun fichier téléchargé ou une erreur est survenue
                $errors[] = "Veuillez sélectionner un fichier à télécharger.";

            }

        }
        $id_offer = $_GET['id'];

        $job_offer = new JobOffer();
        $job_offer = $job_offer->view($id_offer);
        if(empty($job_offer)){
            header("Location: index.php?controller=joboffer&action=list");
        }
        require(_PROJECT_DIR_ . '/view/job_seeker/postuler.php');
    }

    public function mes_condidatures()
    {
        $user_id = 9;

        $job_seeker = new JobSeeker();
        $mes_condidatures = $job_seeker->getUserCondidatures($user_id);
        require(_PROJECT_DIR_ . '/view/job_seeker/mes_condidatures.php');

    }
}