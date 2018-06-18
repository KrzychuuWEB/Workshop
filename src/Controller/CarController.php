<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-06
 * Time: 18:02
 */

namespace App\Controller;

use App\Entity\Car;
use App\Form\Type\CarAddType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends Controller
{
    /**
     * @Route("/car/create/{customer}",defaults={"customer" = 1} , name="create_car")
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, $customer)
    {
        $form = $this->createForm(CarAddType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $carData = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carData);
            $entityManager->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("car/create.html.twig", [
            'form' => $form->createView(),
            'customerID' => $customer,
        ]);
    }

    /**
     * @Route("/car/find", name="find_car")
     */
    public function findCar(Request $request)
    {
        if($request->isMethod("POST")) {
            $registration = $request->request->get("searchRegistration");

            return $this->redirectToRoute("read_car", ['slug' => $registration]);
        }

        return $this->redirectToRoute("index");
    }

    /**
     * @Route("/car/{slug}", name="read_car")
     */
    public function read($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em
            ->getRepository(Car::class)
            ->findByRegistration($slug);

        return $this->render("car/read.html.twig", [
            'car' => $car,
        ]);
    }
}