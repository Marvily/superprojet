<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user=$this->getUser();
         if ($user) {
             $roles= $user->getRoles();

             if( in_array( 'ROLE_SUPER_ADMIN',$roles )){
                 return $this->redirectToRoute('admin_home');
             }else if(in_array( 'ROLE_TEACHER',$roles )){
                 return $this->redirectToRoute('teacher_home');
             }else if(in_array( 'ROLE_USER',$roles )){
                 return $this->redirectToRoute('student_home');
             }

         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
