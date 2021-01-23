<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oferta")
 * @ORM\Entity(repositoryClass=OfertaRepository::class)
 * @ORM\Entity
 */
class Oferta
{
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $empresa;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $dnicuit;

       /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono;

     /**
     * @ORM\Column(type="float", length=255)
     */
    private $ofertado; 

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $status; //R rechazada,A aceptada,null
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lote",inversedBy="ofertas", cascade={"persist"})     
     */ 
    private $lote;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Toro",inversedBy="ofertas", cascade={"persist"})     
     */ 
    private $toro;

        /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

       /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;



    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(string $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getDnicuit(): ?string
    {
        return $this->dnicuit;
    }

    public function setDnicuit(string $dnicuit): self
    {
        $this->dnicuit = $dnicuit;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

 
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getLote(): ?Lote
    {
        return $this->lote;
    }

    public function setLote(?Lote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    public function getToro(): ?Toro
    {
        return $this->toro;
    }

    public function setToro(?Toro $toro): self
    {
        $this->toro = $toro;

        return $this;
    }

    public function getOfertado(): ?float
    {
        return $this->ofertado;
    }

    public function setOfertado(float $ofertado): self
    {
        $this->ofertado = $ofertado;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
    



}