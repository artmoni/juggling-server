<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveyPollController extends Controller
{
    /**
     * @Route("/survey/poll", name="survey_poll")
     */
    public function index()
    {
        return $this->render('survey_poll/index.html.twig', [
            'controller_name' => 'SurveyPollController',
        ]);
    }
}
