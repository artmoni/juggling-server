<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class UserConrollerController extends Controller
{
    /**
     * @Route("/users", name="user_conroller")
     * @Method("GET")
     *
     */
    public function index()
    {
        return new JsonResponse();
    }

//    /**
//     * @Route("/users/{name}", name = "user_connect")
//     * @Method("GET")
//     */
//    public function connexion($name){
//        $entityManager = $this->getDoctrine()->getManager();
//        $users = $entityManager->getRepository(User::class)->findBy(["name" => $name]);
//        $user = $this->get('jms_serializer')->serialize($users, 'json');
//        return new JsonResponse(json_decode($user));
//
//    }

    /**
     * @Route("/users/{id}", name = "user_id")
     * @Method("GET")
     */
    public function findUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->find($id);
        $user = $this->get('jms_serializer')->serialize($users, 'json');
        return new JsonResponse(json_decode($user));

    }

    /**
     * @Route("/users", name = "user_subscribe")
     * @Method("POST")
     */
    public function subscribe(Request $request)
    {

//        $user = json_decode($request->getContent(), true);
//
//        $name = $this->get('jms_serializer')->deserialize(json_encode($user["name"]), String::class, 'json');
//
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
//        $users = $entityManager->getRepository(User::class)->findOneBy($name);
//        if($users == null && $user instanceof User) {
        $entityManager->persist($user);
        $entityManager->flush();
//            return new JsonResponse();
//        }
        return new JsonResponse(json_decode($this->get('jms_serializer')->serialize($user, 'json')));
    }

    /**
     * @Route("/users/update", name = "user_update")
     * @Method("POST")
     */
    public function update(Request $request)
    {

        $userRequest = json_decode($request->getContent(), true);
        $user = new User();
        $user->setId($userRequest['id']);
        $user->setName($userRequest['name']);
        $user->setMail($userRequest['mail']);
        $user->setTel($userRequest['tel']);

        dump($user);

        if (!$user instanceof User) throw new Exception("Not a User");

        $entityManager = $this->getDoctrine()->getManager();
        $userToUpdate = $entityManager->getRepository(User::class)->find($user->getId());

        $userToUpdate->setName($user->getName());
        $userToUpdate->setMail($user->getMail());
        $userToUpdate->setTel($user->getTel());

        $entityManager->persist($userToUpdate);
        $entityManager->flush();
//            return new JsonResponse();
//        }
        return new JsonResponse(json_decode($this->get('jms_serializer')->serialize($userToUpdate, 'json')));
    }

}
