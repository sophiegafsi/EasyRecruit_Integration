<?php

class AdminRecruiterController
{

    public function list()
    {
        $recruiter = new Recruiter();
        $recruiters = $recruiter->getAll();
        require('../view/admin/recruiter/list.php');
    }

    public function add()
    {
        if(isset($_POST['submit']) && $_POST['submit'] == 1){
            $recruiter = new Recruiter();
            $recruiter->setName($_POST['name']);
            $recruiter->setEmail($_POST['email']);
            $recruiter->setPassword($_POST['password']);
            $recruiter->setCompanyName($_POST['companyName']);
            $recruiter->setWebsite($_POST['website']);
            $recruiter->setPhone($_POST['phone']);
            $recruiter->setAddress($_POST['address']);
            $recruiter->setDescription($_POST['description']);
            $recruiter->setActivitySector($_POST['activitySector']);
            if($recruiter->add()){
                header("Location: index.php?controller=recruiter&action=list");
            }
        }
        require('../view/admin/recruiter/add.php');
    }

    public function edit()
    {
        $recruiter = new Recruiter();
        if(isset($_GET['id']) && (int)$_GET['id']){
            $recruiter_values = $recruiter->getById((int)$_GET['id']);
            if(isset($_POST['submit']) && $_POST['submit'] == 1){
                $recruiter = new Recruiter();
                $recruiter->setName($_POST['name']);
                $recruiter->setEmail($_POST['email']);
                $recruiter->setCompanyName($_POST['companyName']);
                $recruiter->setWebsite($_POST['website']);
                $recruiter->setPhone($_POST['phone']);
                $recruiter->setAddress($_POST['address']);
                $recruiter->setDescription($_POST['description']);
                $recruiter->setActivitySector($_POST['activitySector']);
                if($recruiter->update((int)$_GET['id'])){
                    header("Location: index.php?controller=recruiter&action=list");
                }
            }
            require('../view/admin/recruiter/edit.php');
        }else{
            header("Location: index.php?controller=recruiter&action=list");
        }
    }

    public function delete()
    {
        $recruiter = new Recruiter();
        if(isset($_GET['id']) && (int)$_GET['id']){
            $recruiter->delete((int)$_GET['id']);
        }

        header("Location: index.php?controller=recruiter&action=list");
    }

}