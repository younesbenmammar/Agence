<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class BienRecherche{

    /**
     * @var int | null
     */
    private $PrixMax;

    /**
     * @var int | null
     * @Assert\Range(min="10", max="400")
     */
    private $SurfaceMin;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getPrixMax(): ?int
    {
        return $this->PrixMax;
    }

    /**
     * @param int|null $PrixMax
     * @return BienRecherche
     */
    public function setPrixMax(?int $PrixMax): BienRecherche
    {
        $this->PrixMax = $PrixMax;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfaceMin(): ?int
    {
        return $this->SurfaceMin;
    }

    /**
     * @param int|null $SurfaceMin
     * @return BienRecherche
     */
    public function setSurfaceMin(?int $SurfaceMin): BienRecherche
    {
        $this->SurfaceMin = $SurfaceMin;
        return $this;

    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }




}