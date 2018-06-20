<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SceneRepository")
 */
class Scene
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
    private $name;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $propreties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PollAnswer", mappedBy="scene")
     */
    private $pollAnswer;

    public function __construct()
    {
        $this->pollAnswer = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPropreties(): ?string
    {
        return $this->propreties;
    }

    public function setPropreties($propreties): self
    {
        $this->propreties = $propreties;

        return $this;
    }

    /**
     * @return Collection|PollAnswer[]
     */
    public function getPollAnswer(): Collection
    {
        return $this->pollAnswer;
    }

    public function addPollAnswer(PollAnswer $pollAnswer): self
    {
        if (!$this->pollAnswer->contains($pollAnswer)) {
            $this->pollAnswer[] = $pollAnswer;
            $pollAnswer->setScene($this);
        }

        return $this;
    }

    public function removePollAnswer(PollAnswer $pollAnswer): self
    {
        if ($this->pollAnswer->contains($pollAnswer)) {
            $this->pollAnswer->removeElement($pollAnswer);
            // set the owning side to null (unless already changed)
            if ($pollAnswer->getScene() === $this) {
                $pollAnswer->setScene(null);
            }
        }

        return $this;
    }
}
