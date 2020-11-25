<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="^[0-9]*[1-9][0-9]*$"}, methods={"GET"}, name="show")
     * @return Response
     */
    public function show(int $id): Response
    {
        return $this->render('/program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
