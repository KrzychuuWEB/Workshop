<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2018-06-13
 * Time: 19:22
 */

namespace App\Controller;

use App\Entity\Position;
use App\Form\Type\AddPositionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PositionController extends Controller
{
    /**
     * @Route("/position/create", name="create_position")
     */
    public function create(Request $request)
    {
        $form = $this->createForm(AddPositionType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $position = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($position);
            $entityManager->flush();

            return $this->redirectToRoute('read_position');
        }

        return $this->render("position/create.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/position", name="read_position")
     */
    public function read()
    {
        $em = $this->getDoctrine()->getManager();

        $position = $em
            ->getRepository(Position::class)
            ->findAll();

        return $this->render("position/read.html.twig", [
            'position' => $position,
        ]);
    }

    /**
     * @Route("/position/{slug}/delete", name="delete_position")
     */
    public function delete($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $position = $em
            ->getRepository(Position::class)
            ->find($slug);

        if(!$position) {
            return $this->redirectToRoute("read_position");
        }

        $em->remove($position);
        $em->flush();

        return $this->render("position/delete.html.twig", [
            'positionDelete' => $position,
        ]);
    }
}