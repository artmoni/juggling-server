<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PollAnswerController extends Controller
{
    /**
     * @Route("/poll/answer", name="poll_answer")
     */
    public function index()
    {
        return $this->render('poll_answer/index.html.twig', [
            'controller_name' => 'PollAnswerController',
        ]);
    }
}
