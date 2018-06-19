<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserConrollerController extends Controller
{
    /**
     * @Route("/user/conroller", name="user_conroller")
     */
    public function index()
    {
        return $this->render('user_conroller/index.html.twig', [
            'controller_name' => 'UserConrollerController',
        ]);
    }
}
