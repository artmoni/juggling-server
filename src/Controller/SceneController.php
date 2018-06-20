<?php

namespace App\Controller;

use App\Entity\ProcessingConfig;
use App\Entity\Scene;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SceneController extends Controller
{
    /**
     * @Route("/scenes", name="scene")
     * @Method("GET")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $scenes = $entityManager->getRepository(Scene::class)->findAll();
        $scenes_json = $this->get('jms_serializer')->serialize($scenes, 'json');
        return new JsonResponse(json_decode($scenes_json));

    }

    /**
     * @Route("/scenes", name="sceneCreate")
     * @Method("POST")
     */
    public function createProperty(Request $request)
    {
//        $background = $request->get('background');
        $name = $request->get('name');

        $processingConfig = new ProcessingConfig();
        $processingConfig->setBackground($request->get('background'));

        $serialized_properties = serialize($processingConfig->getProperties());

        $scene = new Scene();
        $scene->setName($name);
        $scene->setPropreties($serialized_properties);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($scene);
        $entityManager->flush();

        return new JsonResponse();

    }



    /**
     * @Route("/scenes/{id}", name="sceneActiveById")
     * @Method("GET")
     */
    public function show($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $scene = $entityManager->getRepository(Scene::class)->find($id);
        if (!$scene instanceof Scene) throw new Exception("Scene not found");

        $proprities = unserialize($scene->getPropreties());
        $processingConfig = new ProcessingConfig();
        $processingConfig->setBackground($proprities['background']);
        $propritiesProcessing = serialize($processingConfig->getProperties());
        $json = unserialize($propritiesProcessing);

        return new JsonResponse($json);

    }

    /**
     * @Route("/scenes", name="lastScene")
     * @Method("GET")
     */
    public function showLast()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $scene = $entityManager->getRepository(Scene::class)->findOneBy(array(),array('id'=>'DESC'));
        if (!$scene instanceof Scene) throw new Exception("Scene not found");
        $myJson = unserialize($scene->getPropreties());
        return new JsonResponse($myJson);

    }
}
