<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/enter')]
    public function index(
        Request $request
    ): Response {
        $error = null;

        $session = $request->getSession();
        if (!$session->has('step') && 4 === $session->get('step')) {
            $session->set('step', 0);
        }

        if (0 === $session->get('step')) {

            if ('POST' === $request->getMethod()) {
                $password = $request->request->get('password');
                if ('password' === $password) {
                    $session->set('step', 1);
                    $error = 'Password is incorrect';
                } else {
                    $error = 'Enter password';
                }
            }
        }

        return $this->render('enter.html.twig', [
            'label' => 'Enter Password',
            'error' => $error,
        ]);
    }
}
