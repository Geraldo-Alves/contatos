<?php

namespace App\Controller;

use App\Entity\Contato;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContatoController extends AbstractController
{
    /**
     * @Route("/contato", name="contato")
     */
    public function index()
    {
        return $this->render('contato/index.html.twig', [
            'controller_name' => 'ContatoController',
        ]);
    }

    /**
     * @Route("/contatos", name="contatos")
     */
    public function contatos(){
        $contatos = $this->getDoctrine()
            ->getRepository(Contato::class)
            ->findAll();

        return $this->render('contato/contatos.html.twig', [
            'contatos' => $contatos
            ]
        );
    }

    /**
     * @Route("/contato/new", name="contato")
     */
    public function new(Request $request)
    {

        $contato = new Contato();
        $form = $this->createFormBuilder($contato)
            ->add('nome', TextType::class)
            ->add('email', TextType::class)
            ->add('telefone', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Salvar Contato'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contato = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contato);
            $entityManager->flush();

            return $this->redirectToRoute('contatos');
        }

        return $this->render('contato/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contato/edit", name="contato_edit")
     */
    public function edit(Request $request){
        $id = $request->get('id_contato');
        return $this->render('contato/edit.html.twig', ['id' => $id]);
    }

    /**
     * @Route("/contato/delete/{id}", name="contato_delete", methods="DELETE")
     */
    public function delete($id){

      $contato = $this->getDoctrine()
          ->getRepository(Contato::class)
          ->find($id);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($contato);
      $entityManager->flush();
      return $this->redirectToRoute('contatos');
    }
}
