<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-04
 * Time: 15:46
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }
}