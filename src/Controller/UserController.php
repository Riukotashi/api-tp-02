<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractBaseController
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/api/register", name="api_register")
     */
    public function createUser(Request $request, EntityManagerInterface $em)
    {
        
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data);
        if ($form->isValid())
        {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $em->persist($user);
            $em->flush();
            return $this->json(
                ["user" => $user],
                Response::HTTP_CREATED,
                [],
                [ "groups" => "user_read"]
            );
        }

        $errors = $this->getFormErrors($form);

        return $this->json(
            $errors,
        );

    }
}
