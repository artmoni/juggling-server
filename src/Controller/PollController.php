<?php

namespace App\Controller;

use App\Entity\Poll;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PollController extends Controller
{
    /**
     * @Route("/poll", name="poll")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $poll = new Poll();
        $poll->setQuestion("quel age avez vous ?");
        $entityManager->persist($poll);
        $entityManager->flush();
        return $this->render('poll/index.html.twig', [
            'controller_name' => 'PollController',
        ]);
    }


    /**
     * @Route("/poll/{id}", name="poll_show")
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
        return $this->render('poll/show.html.twig', [
            'controller_name' => 'PollController',
            'poll' => $poll
        ]);
    }
}
