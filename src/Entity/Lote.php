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
     * @ORM\Column(type="float", nullable=false)
     */
    private $incrementominimo;
  
  
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CabanaEntity",inversedBy="lotes", cascade={"persist"})     
     */ 
    private $cabanaentity;

    /**
    * @ORM\Column(type="boolean", nullable=false,options={"default": false})
    */
    protected $desactivado;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oferta" , mappedBy="lote", cascade={"persist"})
     */
    private $ofertas;


    public function __construct()
    {
        $this->toros = new ArrayCollection();
        $this->ofertas = new ArrayCollection();
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
        $ret = '';
        if($this->cabanaentity!=null)    
         $ret.='-Cabaña:'.$this->cabanaentity->getNombre();
        if($this->cabana!=null)
          $ret.='-Evento:'.$this->cabana->getNombre();    
        return $this->nombre.$ret;         
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

    /**
     * @return Collection|Oferta[]
     */
    public function getOfertas(): Collection
    {
        return $this->ofertas;
    }

    public function addOferta(Oferta $oferta): self
    {
        if (!$this->ofertas->contains($oferta)) {
            $this->ofertas[] = $oferta;
            $oferta->setLote($this);
        }

        return $this;
    }

    public function removeOferta(Oferta $oferta): self
    {
        if ($this->ofertas->removeElement($oferta)) {
            // set the owning side to null (unless already changed)
            if ($oferta->getLote() === $this) {
                $oferta->setLote(null);
            }
        }

        return $this;
    }

    
    public function OferTextInfo()
    {
        $info = '';
        foreach($this->toros as $toro)
        {
            $ofertaActual = $toro->getOfertaActual();
            if($ofertaActual>0)
            {
                $info.='<strong>'.$toro->getNombre().'</strong>:';
                $info.=$toro->getPreciobase().'/';
                $info.= $ofertaActual > 0 ? $ofertaActual:'-';
                $info.='<br>';
            }
           
        }
        return $info;
    }

    public function getCabanaentity(): ?CabanaEntity
    {
        return $this->cabanaentity;
    }

    public function setCabanaentity(?CabanaEntity $cabanaentity): self
    {
        $this->cabanaentity = $cabanaentity;

        return $this;
    }

}
