<?php

namespace App\Controller;

use App\Entity\PollAnswer;
use App\Entity\ProcessingConfig;
use App\Entity\Scene;
use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class SceneController extends Controller
{
    /**
     * @Route("/scenes", name="scene")
     * @Method("GET")gi
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

        $serializer = new Serializer(
            array(new GetSetMethodNormalizer(), new ArrayDenormalizer()),
            array(new JsonEncoder())
        );
        $processingConfig = $serializer->deserialize($request->getContent(), ProcessingConfig::class, "json");
//        $processingConfig->setBackground($processingConfig->getBackground());

        $serialized_properties = serialize($processingConfig->getProperties());

        $scene = new Scene();
        $scene->setName($name);
        $scene->setPropreties($serialized_properties);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($scene);
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($scene, "json")));

    }


    /**
     * @Route("/scenes/last", name="lastScene")
     * @Method("GET")
     */
    public function showLast()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $scene = $entityManager->getRepository(Scene::class)->findOneBy(array(), array('id' => 'DESC'));
        if (!$scene instanceof Scene)
            return new JsonResponse(array("error" => "No scene found"), JsonResponse::HTTP_NO_CONTENT);

        $properties = unserialize($scene->getPropreties());
        $processingConfig = new ProcessingConfig();
        $processingConfig->setBackground($properties['background']);
        $propritiesProcessing = serialize($processingConfig->getProperties());
        $json = unserialize($propritiesProcessing);

        return new JsonResponse($json);


    }

    /**
     * @Route("/scenes/current", name="sceneActiveByResponse")
     * @Method("GET")
     * @return JsonResponse
     */
    public function showCurrent()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $currentSurvey = $entityManager->getRepository(SurveyPoll::class)->findCurrentSurvey();
        if (!$currentSurvey instanceof SurveyPoll)
            return new JsonResponse("survey not found", JsonResponse::HTTP_NOT_FOUND);


        $best_array_with_count = $entityManager->getRepository(SurveyAnswer::class)->findMostAnswers($currentSurvey);
        if (sizeof($best_array_with_count))
            $best = $best_array_with_count[0];
        
        if (!$best instanceof SurveyAnswer)
            return new JsonResponse("Answer not found", JsonResponse::HTTP_NOT_FOUND);

//        $answers_counted = array();
//
//        foreach ($answers as $answer) {
//            if (!$answer instanceof PollAnswer)
//                continue;
//         $answers_counted[$answer->get]
//
//        }


//        $surveyAnswer = $entityManager->getRepository(SurveyAnswer::class)->findOneBy(array(), array('id' => 'DESC'));
//        if (!$surveyAnswer instanceof SurveyAnswer) {
//            $scene = $entityManager->getRepository(Scene::class)->findOneBy(array(), array('id' => 'DESC'));
//        } else {
//            if (!$surveyAnswer instanceof SurveyAnswer) throw new Exception("Survey Not found");
//
//            $answer = $entityManager->getRepository(PollAnswer::class)->find($surveyAnswer->getPollAnswer()->getId());
//
//            if (!$answer instanceof PollAnswer) throw new Exception("Answer Not found");
//
//            $scene = $entityManager->getRepository(Scene::class)->find($answer->getScene()->getId());
//        }
//        if (!$scene instanceof Scene) throw new Exception("Scene not found");
//
//        $proprities = unserialize($scene->getPropreties());
//        $processingConfig = new ProcessingConfig();
//        $processingConfig->setBackground($proprities['background']);
//        $propritiesProcessing = serialize($processingConfig->getProperties());
//        $json = unserialize($propritiesProcessing);

        $scene = $best->getPollAnswer()->getScene();
        return new JsonResponse(unserialize($scene->getPropreties()));

    }

    /**
     * @Route("/scenes/{id}", name="sceneActiveById")
     * @Method("GET")
     * @param $id
     * @return JsonResponse
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
}
