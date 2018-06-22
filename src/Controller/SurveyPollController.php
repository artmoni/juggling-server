<?php

namespace App\Controller;

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
     * @Route("/surveys/polls/{id}", name="survey_polls_id")
     * @Method("GET")
     */
    public function show($id)
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
    public function create(Request $request)
    {
        return new JsonResponse();
    }
}
