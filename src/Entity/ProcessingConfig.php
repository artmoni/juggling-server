<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProcessingConfigRepository")
 */
class ProcessingConfig
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $background;

    public function getId()
    {
        return $this->id;
    }

    public function getBackground(): ?int
    {
        return $this->background;
    }

    public function setBackground(int $background): self
    {
        $this->background = $background;

        return $this;
    }
}
