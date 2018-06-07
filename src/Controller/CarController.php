<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-06
 * Time: 18:02
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends Controller
{
    /**
     * @Route("/car/create", name="create_car")
     * @IsGranted("ROLE_USER")
     */
    public function create()
    {
        return $this->render("car/create.html.twig");
    }
}