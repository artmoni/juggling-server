<?php

namespace App\Controller;

use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveyPollController extends Controller
{
    /**
     * @Route("/surveys/polls", name="survey_polls")
     * @Method("GET")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $surveys = $entityManager->getRepository(SurveyPoll::class)->findAll();
        $surveys_json = $this->get('jms_serializer')->serialize($surveys, 'json');
        return new JsonResponse(json_decode($surveys_json));

    }

    /**
     * @Route("/surveys/polls/{id}", name="survey_polls_user")
     * @Method("GET")
     * @param $id
     * @return JsonResponse
     */
    public function showForOneUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $idSurveyToSend = 0;
        $surveys = $entityManager->getRepository(SurveyPoll::class)->findAll();
        $answers = $entityManager->getRepository(SurveyAnswer::class)->findBy(["id" => $id]);
        foreach ($surveys as $survey) {
            if ($survey instanceof SurveyPoll) {
                foreach ($answers as $answer) {
                    if ($answer instanceof SurveyAnswer) {
                        if ($survey->getId() == $answer->getId())
                            $idSurveyToSend++;
                        else
                            break;

                    }
                }
            } else
                echo " Not survey";
            break;

        }
        $surveys_json = $this->get('jms_serializer')->serialize($entityManager->getRepository(SurveyPoll::class)->find($idSurveyToSend), 'json');
        return new JsonResponse(json_decode($surveys_json));

    }

//    /**
//     * @Route("/surveys/polls/{id}", name="survey_polls_id")
//     * @Method("GET")
//     */
//    public
//    function show($id)
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $surveys = $entityManager->getRepository(SurveyPoll::class)->find($id);
//        $surveys_json = $this->get('jms_serializer')->serialize($surveys, 'json');
//        return new JsonResponse(json_decode($surveys_json));
//
//    }

    /**
     * @Route("/surveys/polls" , name="survey_poll_create")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public
    function create(Request $request)
    {
        return new JsonResponse();
    }
}
