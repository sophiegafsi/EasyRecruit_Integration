<?php

class JobOfferController
{

    public function list()
    {
        $job_offer = new JobOffer();
        $job_offers = $job_offer->getFrontAll();
        require(_PROJECT_DIR_.'/view/job_offer/list.php');
    }
    public function view()
    
    {
        $job_offer = new JobOffer();
        $job_offer = $job_offer->view($_GET['id']);
        if(empty($job_offer)){
            header("Location: index.php?controller=joboffer&action=list");
        }
        require(_PROJECT_DIR_.'/view/job_offer/view.php');
    }

    public function search()
    {
        $search = $_GET['search'];
        $secteur = $_GET['activitySector'];
        $job_offer = new JobOffer();
        $job_offers = $job_offer->search($search, $secteur);

        require(_PROJECT_DIR_.'/view/job_offer/search.php');
    }
    public function isDate($date)
    {
        if (!preg_match('/^([0-9]{4})-((?:0?[0-9])|(?:1[0-2]))-((?:0?[0-9])|(?:[1-2][0-9])|(?:3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $date, $matches)) {
            return false;
        }

        return checkdate((int)$matches[2], (int)$matches[3], (int)$matches[1]);
    }

    public function validate()
    {
        $errors = [];
        if (!(int)$_POST['vacant_jobs']) {
            $errors[] = 'Le Nombre de poste doit etre un entier ';
        } elseif ((int)$_POST['vacant_jobs'] < 1) {
            $errors[] = 'Le Nombre de poste doit etre superierieur à 0 ';
        }
        if (!$this->isDate($_POST['expiration_date'])) {
            $errors[] = 'Le Nombre date d\'expiration doit etre au format AAAA-MM-JJ';
        }
        return $errors;

    }
    public function add()
    {

        $recruiter = new Recruiter();
        $recruiters = $recruiter->getAll();
        if (isset($_POST['submit']) && $_POST['submit'] == 1) {
            $errors = $this->validate();
            if (empty($errors)) {
                $job_offer = new JobOffer();
                $job_offer->setTitle($_POST['title']);
                $job_offer->setDescription($_POST['description']);
                $job_offer->setExperience($_POST['experience']);
                $job_offer->setSalary($_POST['salary']);
                $job_offer->setContractType($_POST['contract_type']);
                $job_offer->setVacantJobs($_POST['vacant_jobs']);
                $job_offer->setExpirationDate($_POST['expiration_date']);
                $job_offer->setRecruiterId($_POST['recruiter_id']);
                $job_offer->setActive($_POST['active']);
                $job_offer->setDateAdd(date('Y-m-d H:i:s'));
                $job_offer->setDateUpd(date('Y-m-d H:i:s'));
                if ($job_offer->add()) {
                    header("Location: index.php?controller=joboffer&action=list");
                } else {
                    $errors[] = 'Erreur dans la sauvegarde';
                }
            }
        }
        require(_PROJECT_DIR_.'/view/job_offer/add.php');
    }
}