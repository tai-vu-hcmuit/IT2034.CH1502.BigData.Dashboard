<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class Dashboard extends AbstractController
{
    /**
     * @Route("dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('base.html.twig');
    }
}