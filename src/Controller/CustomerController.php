<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Type\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller
{
    /**
     * @Route("/customer/create", name="create_customer")
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request)
    {
        $form = $this->createForm(CustomerType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $name = $form['lastName']->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $id = $em
                ->getRepository(Customer::class)
                ->findCustomerByLastName($name);

            return $this->redirectToRoute('create_car', ['customer' => $id[0]->getId()]);
        }

        return $this->render("customer/create.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/customer/{slug}", name="read_customer")
     * @IsGranted("ROLE_USER")
     */
    public function read($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em
            ->getRepository(Customer::class)
            ->findCustomerByLastName($slug);

        if(!$customer) {
            $session = new Session();
            $session->set("lastNameError", true);
            $session->set("lastNameForm", $slug);
            return $this->redirectToRoute("find_customer");
        }

        return $this->render("customer/read.html.twig", [
            'customerData' => $customer,
        ]);
    }

    /**
     * @Route("/customer", name="find_customer")
     */
    public function find(Request $request)
    {
        $session = new Session();

        if($request->isMethod("POST")) {
            $customer = $request->request->get("find_customer");

            return $this->redirectToRoute("read_customer", ['slug' => $customer]);
        }

        return $this->render("customer/find.html.twig");
    }
}
