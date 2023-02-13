<?php

namespace App\Controller;

use App\Entity\BookMaker;
use App\Entity\User;
use App\Form\BookMakerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookMakerController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('book_maker/index.html.twig');
    }

    #[Route('/book/maker/create', name: 'app_book_maker_create')]
    public function create(Request $req, EntityManagerInterface $em): Response
    {
       $book = new BookMaker();
       $form = $this->createForm(BookMakerType::class,$book);
       $form->handleRequest($req);
       if($form->isSubmitted() && $form->isValid())
       {
        $em->persist($book);
        $em->flush();
       }
        return $this->render('book_maker/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/book/maker/edit/{id<[0-9]+>}', name: 'app_book_maker_edit')]
    public function edit(BookMaker $book ,Request $req, EntityManagerInterface $em): Response
    {
       $form = $this->createForm(BookMakerType::class,$book);
       $form->handleRequest($req);
       if($form->isSubmitted() && $form->isValid())
       {
        $em->flush();
        return $this->redirectToRoute('app_book_maker_create');
       }
        return $this->render('book_maker/edit.html.twig',[
            'book'=>$book,
            'form'=>$form->createView()
        ]);
    }
}
