<?php

namespace App\Controller;

use App\Entity\Contato;
use App\Entity\Endereco;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnderecoController extends AbstractController
{
    /**
     * @Route("/endereco", name="endereco")
     */
    public function new(Request $request)
    {
        $id_contato = $request->get('id_contato');
        $contato = $this->getDoctrine()
            ->getRepository(Contato::class)
            ->find($id_contato);

        $endereco = $contato->getEndereco();

        return $this->render('endereco/new.html.twig', [
            'controller_name' => 'EnderecoController',
            'contato' => $contato,
            'endereco' => $endereco,
        ]);
    }

    /**
     * @Route("/endereco/save", name="save_endereco", methods="POST")
     */
    public function save(Request $request){
        $id_contato = $request->get('id_contato');
        $quadra = $request->get('quadra');
        $numero = $request->get('numero');
        $observacao = $request->get('observacao');

        $contato = $this->getDoctrine()
            ->getRepository(Contato::class)
            ->find($id_contato);


        $endereco = $contato->getEndereco();
        if(empty($endereco)){
            $endereco = new Endereco();
        }

        $endereco->setIdContato($contato);
        $endereco->setQuadra($quadra);
        $endereco->setNumero($numero);
        $endereco->setObservacao($observacao);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($endereco);
        $entityManager->flush();

        return $this->redirectToRoute('endereco', ['id_contato' => $id_contato]);
    }
}
