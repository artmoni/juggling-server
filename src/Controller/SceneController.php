<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SceneController extends Controller
{
    /**
     * @Route("/scene", name="scene")
     */
    public function index()
    {
        return $this->render('scene/index.html.twig', [
            'controller_name' => 'SceneController',
        ]);
    }
}
