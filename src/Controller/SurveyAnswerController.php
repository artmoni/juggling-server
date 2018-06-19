<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveyAnswerController extends Controller
{
    /**
     * @Route("/survey/answer", name="survey_answer")
     */
    public function index()
    {
        return $this->render('survey_answer/index.html.twig', [
            'controller_name' => 'SurveyAnswerController',
        ]);
    }
}
