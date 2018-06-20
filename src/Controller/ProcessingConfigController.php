<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProcessingConfigController extends Controller
{
    /**
     * @Route("/processing/config", name="processing_config")
     */
    public function index()
    {
        return $this->render('processing_config/index.html.twig', [
            'controller_name' => 'ProcessingConfigController',
        ]);
    }
}
