<?php

namespace App\Controller;

use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveyPollController extends Controller
{
    /**
     * @Route("/users/{id}/surveys", name="survey_polls")
     * @Method("GET")
     */
    public function index($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        if(!$user instanceof User)
            return new JsonResponse("User not found",JsonResponse::HTTP_NOT_FOUND);

        $surveys = $entityManager->getRepository(SurveyPoll::class)->findAllSurveys($user);
        $surveys_json = $this->get('jms_serializer')->serialize($surveys, 'json');
        return new JsonResponse(json_decode($surveys_json));

    }

    /**
     * @Route("/surveys/polls/users/{id}", name="survey_polls_user")
     * @Method("GET")
     * @param $id
     * @return JsonResponse
     */
    public function showForOneUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find($id);

        $surveyToSend = null;
        // dump($answers);
        $surveys = $entityManager->getRepository(SurveyPoll::class)->findAllSurveys($user);
        $surveyToSend = $surveys[0];
        $surveys_json = $this->get('jms_serializer')->serialize($surveyToSend, 'json');
        return new JsonResponse(json_decode($surveys_json));

    }

    /**
     * @Route("/surveys/polls/{id}", name="survey_polls_id")
     * @Method("GET")
     */
    public
    function show($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $surveys = $entityManager->getRepository(SurveyPoll::class)->find($id);
        $surveys_json = $this->get('jms_serializer')->serialize($surveys, 'json');
        return new JsonResponse(json_decode($surveys_json));

    }

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
