<?php

namespace App\Entity;

use App\Repository\LoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lote")
 * @ORM\Entity(repositoryClass=LoteRepository::class)
 * @ORM\Entity
 */
class Lote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="array", nullable=true)
    */
    protected $gallery;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $info;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $condicionventa;

      /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $incrementominimo;
 

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechainicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacierre;
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Toro" , mappedBy="lote", cascade={"persist"})
     */
    private $toros;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria",inversedBy="lotes", cascade={"persist"})     
     */ 
     private $categoria;

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Razas",inversedBy="lotes", cascade={"persist"})     
     */ 
    private $raza;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cabana",inversedBy="lotes", cascade={"persist"})     
     */ 
    private $cabana;

    /**
    * @ORM\Column(type="boolean", nullable=false,options={"default": false})
    */
    protected $desactivado;


    public function __construct()
    {
        $this->toros = new ArrayCollection();
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

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getCondicionventa(): ?string
    {
        return $this->condicionventa;
    }

    public function setCondicionventa(string $condicionventa): self
    {
        $this->condicionventa = $condicionventa;

        return $this;
    }

    public function getFechainicio(): ?\DateTimeInterface
    {
       
        return $this->fechainicio;
    }

    public function setFechainicio(\DateTimeInterface $fechainicio): self
    {
       
        $this->fechainicio = $fechainicio;
        return $this;
    }

    public function getFechacierre(): ?\DateTimeInterface
    {
       
        return $this->fechacierre;
    }

    public function setFechacierre(\DateTimeInterface $fechacierre): self
    {
       
        $this->fechacierre = $fechacierre;
        return $this;
    }

    public function getUploadDir()
    {
        return 'Lote';
    }
    
    public function getWebPath()
    {
        return 'remates/public/uploads/'.$this->getUploadDir().'/'.$this->gallery;
    }

    public function getGallery(): ?array
    {
        return $this->gallery;
    }

    public function setGallery(?array $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return Collection|Toro[]
     */
    public function getToros(): Collection
    {
        return $this->toros;
    }

    public function addToro(Toro $toro): self
    {
       
        if (!$this->toros->contains($toro)) {
            $this->toros[] = $toro;
            $toro->setLote($this);
        }

        return $this;
    }

    public function removeToro(Toro $toro): self
    {
        if ($this->toros->removeElement($toro)) {
            // set the owning side to null (unless already changed)
            if ($toro->getLote() === $this) {
                $toro->setLote(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    public function getIncrementominimo(): ?float
    {
        return $this->incrementominimo;
    }

    public function setIncrementominimo(float $incrementominimo): self
    {
        $this->incrementominimo = $incrementominimo;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getRaza(): ?Razas
    {
        return $this->raza;
    }

    public function setRaza(?Razas $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getCabana(): ?Cabana
    {
        return $this->cabana;
    }

    public function setCabana(?Cabana $cabana): self
    {
        $this->cabana = $cabana;

        return $this;
    }

    public function getDesactivado(): ?bool
    {
        return $this->desactivado;
    }

    public function setDesactivado(bool $desactivado): self
    {
        $this->desactivado = $desactivado;

        return $this;
    }

}
