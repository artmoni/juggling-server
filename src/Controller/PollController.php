<?php

namespace App\Controller;

use App\Entity\Poll;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
//use Symfony\Component\Serializer\Serializer;

class PollController extends Controller
{
    /**
     * @Route("/polls", name="poll")
     * @Method("GET")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Poll::class)->findAll();

//        $entityManager = $this->getDoctrine()->getManager();
//
//        $poll = new Poll();
//        $poll->setQuestion("quel age avez vous ?");
//        $entityManager->persist($poll);
//        $entityManager->flush();

        $json = $this->get('jms_serializer')->serialize($questions,'json');



//        $json = $serializerInterface->serialize(
//            $questions,
//            'json', array('questions' => array('question_array'))
//        );
//        $response = new JsonResponse($json);
//
//        $response->headers->set('Content-Type', 'application/json');
//        return new $response;
//        $serializer = new Serializer(new ObjectNormalizer(), new JsonEncoder());


        return new JsonResponse($json);

//        return $this->render('poll/index.html.twig', [
//            'controller_name' => 'PollController',
//            'poll' =>$questions
//        ]);
    }


    /**
     * @Route("/polls/{id}", name="poll_show")
     * @Method("GET")
     */
    public function show($id)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $poll = $entityManager->getRepository(Poll::class)->find($id);
        if (!$poll) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
//        $json = $this->get('jms_serializer')->serialize($poll,'json');
//        return new JsonResponse($json);

        return $this->render('poll/show.html.twig', [
            'controller_name' => 'PollController',
            'poll' => $poll
        ]);
    }

    /**
     * @Route("/polls", name="poll_create")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createQuestion(Request $request)
    {
        $value = json_decode($request->getContent());

        $question = $value->question;
        $poll = new Poll();
        $poll->setQuestion($question);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($poll);
        $entityManager->flush();

        return new JsonResponse();
    }
}
