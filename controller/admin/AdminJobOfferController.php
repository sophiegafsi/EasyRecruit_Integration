<?php

class AdminJobOfferController
{

    public function list()
    {
        $job_offer = new JobOffer();
        $job_offers = $job_offer->getAll();
        require('../view/admin/job_offer/list.php');
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
        require('../view/admin/job_offer/add.php');
    }

    public function edit()
    {
        $recruiter = new Recruiter();
        $recruiters = $recruiter->getAll();
        $job_offer = new JobOffer();
        if (isset($_GET['id']) && (int)$_GET['id']) {
            $job_offer_values = $job_offer->getById((int)$_GET['id']);
            if (isset($_POST['submit']) && $_POST['submit'] == 1) {
                $errors = $this->validate();
                $job_offer->setTitle($_POST['title']);
                $job_offer->setDescription($_POST['description']);
                $job_offer->setExperience($_POST['experience']);
                $job_offer->setSalary($_POST['salary']);
                $job_offer->setContractType($_POST['contract_type']);
                $job_offer->setVacantJobs($_POST['vacant_jobs']);
                $job_offer->setExpirationDate($_POST['expiration_date']);
                $job_offer->setRecruiterId($_POST['recruiter_id']);
                $job_offer->setActive($_POST['active']);
                $job_offer->setDateUpd(date('Y-m-d H:i:s'));
                if ($job_offer->update($_GET['id'])) {
                    header("Location: index.php?controller=joboffer&action=list");
                } else {
                    $errors[] = 'Erreur dans la sauvegarde';
                }
            }
            require('../view/admin/job_offer/edit.php');
        } else {
            header("Location: index.php?controller=joboffer&action=list");
        }
    }

    public function delete()
    {
        $job_offer = new JobOffer();
        if (isset($_GET['id']) && (int)$_GET['id']) {
            $job_offer->delete((int)$_GET['id']);
        }

        header("Location: index.php?controller=joboffer&action=list");
    }

}