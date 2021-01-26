<?php

namespace App\Entity;

use App\Repository\ToroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="toro")
 * @ORM\Entity(repositoryClass=ToroRepository::class)
 * @ORM\Entity
 */
class Toro
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
     * @ORM\Column(type="string", length=500)
     */
    private $info;

    /**
     * @ORM\Column(type="text")
     */
    private $videos;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    protected $gallery;


     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lote",inversedBy="toros", cascade={"persist"})     
     */ 
     private $lote;

     /**
     * @ORM\Column(type="float", nullable=false)
     */
     private $preciobase;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
     private $ofertaActual;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oferta" , mappedBy="toro", cascade={"persist"})
     */
    private $ofertas;

    public function __construct()
    {
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

    public function setNombre(string $Nombre): self
    {
        $this->nombre = $Nombre;

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

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getUploadDir()
    {
        return 'Toro';
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

    public function getLote(): ?Lote
    {
        return $this->lote;
    }

    public function setLote(?Lote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    
    public function __toString()
    {
        return $this->nombre;
    }

    public function getPreciobase(): ?float
    {
        return $this->preciobase;
    }

    public function setPreciobase(float $preciobase): self
    {
        $this->preciobase = $preciobase;

        return $this;
    }

    public function getOfertaActual(): ?float
    {
        return $this->ofertaActual;
    }

    public function setOfertaActual(float $ofertaActual): self
    {
        $this->ofertaActual = $ofertaActual;

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
            $oferta->setToro($this);
        }

        return $this;
    }

    public function removeOferta(Oferta $oferta): self
    {
        if ($this->ofertas->removeElement($oferta)) {
            // set the owning side to null (unless already changed)
            if ($oferta->getToro() === $this) {
                $oferta->setToro(null);
            }
        }

        return $this;
    }
}
