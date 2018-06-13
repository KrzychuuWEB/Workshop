<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-06
 * Time: 17:33
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render("security/login.html.twig", [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(UserPasswordEncoderInterface $encoder)
    {
        $user = new \App\Entity\User();
        $plainPassword = 'user';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        return new Response($encoded);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}