<?php

namespace App\Controller;

use App\Entity\MacherCoupon;
use App\Form\MarcherType;
use App\Repository\MacherCouponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MacherCouponController extends AbstractController
{
    #[Route('/macher/coupon', name: 'app_macher_coupon')]
    public function index(): Response
    {
        return $this->render('macher_coupon/index.html.twig', [
            'controller_name' => 'MacherCouponController',
        ]);
    }

    #[Route('/macher/coupon/ajouter', name: 'app_macher_coupon_ajouter')]
    public function ajouter(Request $req,EntityManagerInterface $em): Response
    {
         $marcher = new MacherCoupon();
         $form = $this->createForm(MarcherType::class,$marcher);
         $form->handleRequest($req);
         if($form->isSubmitted() && $form->isValid())
         {
            $em->persist($marcher);
            $em->flush();
         }
        return $this->render('macher_coupon/ajouter.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/macher/coupon/edit/id<[0-9]+>', name: 'app_macher_coupon_edit')]
    public function edit(Request $req,EntityManagerInterface $em,MacherCoupon $marcher): Response
    {
         $form = $this->createForm(MarcherType::class,$marcher);
         $form->handleRequest($req);
         if($form->isSubmitted() && $form->isValid())
         {
            $em->flush();
         }
        return $this->render('macher_coupon/edit.html.twig',[
            'form'=>$form->createView(),
            'marcher'=>$marcher
        ]);
    }

    #[Route('/macher/coupon/achat', name: 'app_macher_coupon_edit')]
    public function AchatCoupon(MacherCouponRepository $marchRepo): Response
    {
       $marchs = $marchRepo->findAll();
        return $this->render('macher_coupon/edit.html.twig',[
            'marchs'=>$marchs
        ]);
    }
}
