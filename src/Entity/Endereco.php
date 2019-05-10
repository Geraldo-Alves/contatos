<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnderecoRepository")
 */
class Endereco implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quadra;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observacao;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contato", inversedBy="endereco", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_contato;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuadra(): ?string
    {
        return $this->quadra;
    }

    public function setQuadra(string $quadra): self
    {
        $this->quadra = $quadra;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'quadra' => $this->quadra,
            'numero'=> $this->nunmero,
            'observacao'=> $this->observacao,
        );
    }

    public function getIdContato(): ?Contato
    {
        return $this->id_contato;
    }

    public function setIdContato(Contato $id_contato): self
    {
        $this->id_contato = $id_contato;

        return $this;
    }
}
