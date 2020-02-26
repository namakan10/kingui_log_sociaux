<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccesController extends AbstractController
{
    /**
     * @Route("/acces", name="acces")
     */
    public function index()
    {
        $user = $this->getUser();
        if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())){
            return $this->redirectToRoute('admin_dashboard');
        }
        return $this->render('acces/index.html.twig', [
            'controller_name' => 'AccesController',
        ]);
    }
}
