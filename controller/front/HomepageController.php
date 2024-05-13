<?php
    require_once '../model/JobOffer.php';

class HomepageController
{
    public function display()
    {
   

        $job_offer = new JobOffer();
        $job_offers = $job_offer->getLast();
    }

}