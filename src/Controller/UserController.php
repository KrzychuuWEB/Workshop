<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-06
 * Time: 20:04
 */

namespace App\Controller;

use \App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/{slug}", name="read_user")
     * @IsGranted("ROLE_USER")
     */
    public function read($slug)
    {
        $loadUser = $this->getDoctrine()
            ->getRepository(User::class)
            ->loadUserByUsername($slug);

        return $this->render("user/read.html.twig", array(
            'loadUser' => $loadUser,
        ));
    }
}