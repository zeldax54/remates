<?php

namespace App\Entity;

use App\Repository\CabanaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CabanaRepository::class)
 */
class Cabana
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
     * @ORM\Column(type="string", length=300,nullable=false)
     */
    private $urlsegment;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    
    /**
    * @ORM\Column(type="array", nullable=true)
    */
    protected $logos;

    
    /**
    * @ORM\Column(type="array", nullable=true)
    */
    protected $gallery;

     /**
    * @ORM\Column(type="text", nullable=true)
    */
    protected $videos;

        /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lote" , mappedBy="cabana", cascade={"persist"})
     */
    private $lotes;

     /**
    * @ORM\Column(type="boolean", nullable=false,options={"default": false})
    */
    protected $desactivado;

     /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $afiche;

     /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $condpreofertas;

     /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $catalogdescarga;

      /**
     * @ORM\Column(type="datetime")
     */
    private $fechainicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechacierre;

     /**
     * @ORM\Column(type="string", length=500)
     */
    private $info;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $condicionventa;


    public function __construct()
    {
        $this->lotes = new ArrayCollection();
    }



    public function getUploadDirLogo()
    {
        return 'Cabana/Logo';
    }

    public function getUploadDirGallery()
    {
        return 'Cabana/Gallery';
    }
    
    public function getWebPathLogo()
    {
        return 'remates/public/uploads/'.$this->getUploadDirLogo().'/'.$this->gallery;
    }

    public function getWebPathGallery()
    {
        return 'remates/public/uploads/'.$this->getUploadDirGallery().'/'.$this->gallery;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getLogos(): ?array
    {
        return $this->logos;
    }

    public function setLogos(?array $logos): self
    {
        $this->logos = $logos;

        return $this;
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

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(?string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * @return Collection|Lote[]
     */
    public function getLotes(): Collection
    {
        return $this->lotes;
    }

    public function addLote(Lote $lote): self
    {
        if (!$this->lotes->contains($lote)) {
            $this->lotes[] = $lote;
            $lote->setCabana($this);
        }

        return $this;
    }

    public function removeLote(Lote $lote): self
    {
        if ($this->lotes->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getCabana() === $this) {
                $lote->setCabana(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
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

    public function getAfiche(): ?string
    {
        return $this->afiche;
    }

    public function setAfiche(?string $afiche): self
    {
        $this->afiche = $afiche;

        return $this;
    }

    public function getCondpreofertas(): ?string
    {
        return $this->condpreofertas;
    }

    public function setCondpreofertas(?string $condpreofertas): self
    {
        $this->condpreofertas = $condpreofertas;

        return $this;
    }

    public function getCatalogdescarga(): ?string
    {
        return $this->catalogdescarga;
    }

    public function setCatalogdescarga(?string $catalogdescarga): self
    {
        $this->catalogdescarga = $catalogdescarga;

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

    public function getUrlsegment(): ?string
    {
        return $this->urlsegment;
    }

    public function setUrlsegment(string $urlsegment): self
    {
        $this->urlsegment = $urlsegment;

        return $this;
    }
}
