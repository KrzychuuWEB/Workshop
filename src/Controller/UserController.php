<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-06
 * Time: 20:04
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserAddType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/user/create", name="create_user")
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(UserAddType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $loginForm = $form['username']->getData();
            $user = $form->getData();
            $password = $encoder->encodePassword($user, $form['password']->getData());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('read_user', ['slug' => $loginForm]);
        }

        return $this->render("user/create.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{slug}", name="read_user")
     * @IsGranted("ROLE_USER")
     */
    public function read($slug)
    {
        $loadUser = $this->getDoctrine()
            ->getRepository(User::class)
            ->loadUserByUsername($slug);

        if(!$loadUser) {
            return $this->redirectToRoute("read_user", array('slug' => $this->getUser()->getUsername()));
        }

        return $this->render("user/read.html.twig", [
            'user' => $loadUser,
        ]);
    }

    /**
     * @Route("/user/{slug}/edit", name="update_user")
     * @IsGranted("ROLE_USER")
     */
    public function update($slug)
    {
        if($this->getUser()->getUsername() == $slug OR !$this->denyAccessUnlessGranted('ROLE_ADMIN')) {
            $entityManager = $this->getDoctrine()->getManager();

            $loadUser = $entityManager->getRepository(User::class)
                ->loadUserByUsername($slug);

            if(!$loadUser) {
                return $this->redirectToRoute("read_user", array('slug' => $this->getUser()->getUsername()));
            }

            return $this->render("user/update.html.twig", [
                'user' => $loadUser,
            ]);
        }

        return $this->render('index/index.html.twig');
    }

    /**
     * @Route("/user/{slug}/delete", name="delete_user")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em
            ->getRepository(User::class)
            ->loadUserByUsername($slug);

        if(!$user) {
            return $this->redirectToRoute("read_user", array('slug' => $this->getUser()->getUsername()));
        }

        $em->remove($user);
        $em->flush();

        return $this->render("user/delete.html.twig", [
            'username' => $slug,
        ]);
    }
}