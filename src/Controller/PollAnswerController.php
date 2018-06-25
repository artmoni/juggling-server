<?php

namespace App\Controller;

use App\Entity\Poll;
use App\Entity\PollAnswer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PollAnswerController extends Controller
{
    /**
     * @Route("/polls/{id}/answers", name="poll_answer_create")
     * @Method("POST")
     */
    public function create(Request $request, $id)
    {
        $content = $request->getContent();
        $json = json_decode($content);

        $entityManager = $this->getDoctrine()->getManager();
        $poll = $entityManager->getRepository(Poll::class)->find($id);
        if (!$poll instanceof Poll)
            return new JsonResponse(array("error" => "Poll not found"), JsonResponse::HTTP_NOT_FOUND);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer(
            array( $normalizer),
            array(new JsonEncoder())
        );
        $answer = $serializer->deserialize(json_encode($json), PollAnswer::class, "json");
        $answer->setPoll($poll);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($answer);
        $entityManager->flush();

        return new JsonResponse(json_decode($serializer->serialize($answer, "json",array("level"=>1))));
    }
}
