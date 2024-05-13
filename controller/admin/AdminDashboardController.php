<?php

class AdminDashboardController
{
    public function display()
    {
        $pageTitle = "Accueil";
        require('../view/admin/dashboard/display.php');
    }
}