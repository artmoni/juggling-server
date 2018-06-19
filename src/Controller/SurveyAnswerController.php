<?php

namespace App\Controller;

use App\Entity\PollAnswer;
use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveyAnswerController extends Controller
{
    /**
     * @Route("/surveys/answers", name="survey_answer")
     * @Method("GET")
     */
    public function index()
    {
        return $this->render('survey_answer/index.html.twig', [
            'controller_name' => 'SurveyAnswerController',
        ]);
    }


    /**
     * @Route("/surveys/answers", name="survey_answer")
     * @Method("POST")
     */
    public function create(Request $request)
    {
        $value = json_decode($request->getContent(), true);
        $pollAnswer = $this->get('jms_serializer')->deserialize(json_encode($value["answer"]), PollAnswer::class, 'json');

        if (!$pollAnswer instanceof PollAnswer)
            throw new Exception("You need to add an answer attribute of PollAnswer type");

        $answerSurvey = new SurveyAnswer();
        $answerSurvey->setAnswerId($pollAnswer->getId());
        $answerSurvey->setDateAnswer(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($answerSurvey);
        $entityManager->flush();
        return new JsonResponse($pollAnswer);
    }
}
