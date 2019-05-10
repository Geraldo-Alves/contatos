<?php
/**
 * Created by PhpStorm.
 * User: geraldo
 * Date: 10/05/19
 * Time: 09:40
 */

namespace App\Controller\API;

use App\Controller\API\BaseController;
use App\Entity\Contato;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ContatoController extends BaseController
{

    public function index($id){
        $contato = $this->getDoctrine()
            ->getRepository(Contato::class)
            ->find($id);

        return $this->sendResponse($contato);
    }

    public function save($id, Request $request){

        $manager = $this->getDoctrine()->getManager();
        $contato = $manager
            ->getRepository(Contato::class)
            ->find($id);


        $req = json_decode($request->getContent());
        $nome = $req->nome;
        $email = $req->email;
        $telefone = $req->telefone;

        $contato->setNome($nome);
        $contato->setEmail($email);
        $contato->setTelefone($telefone);

        $manager->flush();

        return $this->sendResponse("Contato Editado com sucesso: ". $id);
    }
}