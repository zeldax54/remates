<?php

namespace App\Entity;

use App\Repository\CabanaRepository;
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
}
