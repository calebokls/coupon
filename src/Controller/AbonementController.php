<?php

namespace App\Controller;

use App\Entity\Abonement;
use App\Entity\User;
use App\Repository\AbonementRepository;
use App\Repository\BookMakerRepository;
use App\Repository\CouponRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AbonementController extends AbstractController
{
    #[Route('/abonement', name: 'app_abonement')]
    public function index(Request $req,EntityManagerInterface $em):Response
    {
        $user = new User();
        if($this->isCsrfTokenValid('user_abonement'.$this->getUser(), $req->request->get('csrf_token')))
        {
            $abonement = new Abonement();
        $datedebut = date('d-m-Y');
        $annee = date('Y');
        $mois = date('m')+1;
        if(strlen($mois) == 1){
            $mois = '0'.$mois;
         } 
         if(date('m') == '12' && date('d') == '31')
         {
            $mois = '01';
            $annee = date('Y') + 1;
         }
         $dateFin = date('d').'-'.$mois.'-'.$annee;
         $abonement->setDateDebut($datedebut);
         $abonement->setDateFin($dateFin);
         $abonement->setStatus(true);
         $abonement->setUser($this->getUser());
         $em->persist($abonement);
         $em->flush();
         return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/abonement/Mail', name: 'app_abonement_mail')]
    public function EnvoieMail(UserRepository $ab,MailerInterface $mailer,CouponRepository $CoupRepo):Response
     {
        $users = $ab->FindByUser();
        $coupons = $CoupRepo->findAll();

        // dd($coupons);
        foreach($users as $u )
        {
           $email = (new TemplatedEmail())
                    ->from('ecoupon@gmail.com')
                    ->to( $u['email'])
                    ->subject('Envoyer depuis le site E-coupon')
                    ->htmlTemplate('emails/contact.html.twig')
                    ->context([
                        'coupons'=>$coupons
                    ])
                  ;
                  $mailer->send($email);
        }
        return $this->redirectToRoute('app_home');
     }
     
    
}
