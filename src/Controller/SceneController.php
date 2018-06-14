<?php

namespace App\Controller;

use App\Entity\Scene;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/scene/create", name="sceneCreate")
     */
    public function createProperty(Request $request)
    {
        $background = $request->get('background');
        $name = $request->get('name');

        $scene = new Scene();
        $scene->setName($name);
        $scene->setPropreties(serialize(array('background' => $background)));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($scene);
        $entityManager->flush();

        return new JsonResponse();

    }

    /**
     * @Route("/scene/{id}", name="sceneActive")
     */
    public function show($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $scene = $entityManager->getRepository(Scene::class)->find($id);
        if (!$scene instanceof Scene) throw new Exception("Scene not found");
        $myJson = unserialize($scene->getPropreties());
        return new JsonResponse($myJson);

    }
}
