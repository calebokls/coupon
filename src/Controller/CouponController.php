<?php

namespace App\Controller;

use App\Entity\Coupon;
use App\Form\CouponType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CouponController extends AbstractController
{
    #[Route('/coupon', name: 'app_coupon')]
    public function index(): Response
    {
        return $this->render('coupon/index.html.twig');
    }

    #[Route('/coupon/create', name: 'app_coupon_ajouter')]
    public function ajouter(Request $req , EntityManagerInterface $em): Response
    {
        $coupon = new Coupon;
        $form = $this->createForm(CouponType::class,$coupon);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($coupon);
            $em->flush();
            $this->addFlash('success','Coupon ajouter avec success');
            return $this->redirectToRoute('app_coupon_ajouter');
        }
        return $this->render('coupon/ajouter.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    #[Route('/coupon/edit/{id<[0-9]+>}', name: 'app_coupon_edit')]
    public function edit(Coupon $coupon, Request $req , EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CouponType::class,$coupon);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
        }
        return $this->render('coupon/edit.html.twig',[
            'coupon'=>$coupon,
            'form'=>$form->createView()
        ]);
    }


}
