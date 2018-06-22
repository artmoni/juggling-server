<?php

namespace App\Controller;

use App\Entity\PollAnswer;
use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use App\Entity\User;
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
     * @Route("/surveys/answers", name="survey_answer_create")
     * @Method("POST")
     */
    public function create(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $value = json_decode($request->getContent(), true);

        $pollAnswer = $this->get('jms_serializer')->deserialize(json_encode($value["answer"]), PollAnswer::class, 'json');
        $survey = $this->get('jms_serializer')->deserialize(json_encode($value["survey"]), SurveyPoll::class, 'json');
        $currentUser = $this->get('jms_serializer')->deserialize(json_encode($value["user"][0]), User::class, 'json');


        if (!$pollAnswer instanceof PollAnswer || !$survey instanceof SurveyPoll)
            throw new Exception("You need to add an answer attribute of PollAnswer type");

        if (!$currentUser instanceof User)
            throw new Exception("User does not exist");

        $survey = $entityManager->getRepository(SurveyPoll::class)->find($survey->getId());
        $answer = $entityManager->getRepository(PollAnswer::class)->find($pollAnswer->getId());
        $user = $entityManager->getRepository(User::class)->find($currentUser->getId());
        $answerSurvey = new SurveyAnswer();

        //$answerSurvey->setAnswerId($pollAnswer->getId());
        $answerSurvey->setPollAnswer($answer);
        $answerSurvey->setDateAnswer(new \DateTime());
        $answerSurvey->setSurveyPoll($survey);
        $survey->addSurveyAnswer($answerSurvey);
        $answerSurvey->setUser($user);


        $entityManager->persist($survey);
        $entityManager->persist($answerSurvey);
        $entityManager->flush();
        return new JsonResponse($pollAnswer);
    }
}
