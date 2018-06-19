<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollRepository")
 */
class Poll
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
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PollAnswer", mappedBy="poll")
     */
    private $answers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SurveyPoll", inversedBy="poll")
     */
    private $surveyPoll;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|PollAnswer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(PollAnswer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setPoll($this);
        }

        return $this;
    }

    public function removeAnswer(PollAnswer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getPoll() === $this) {
                $answer->setPoll(null);
            }
        }

        return $this;
    }

    public function getSurveyPoll(): ?SurveyPoll
    {
        return $this->surveyPoll;
    }

    public function setSurveyPoll(?SurveyPoll $surveyPoll): self
    {
        $this->surveyPoll = $surveyPoll;

        return $this;
    }
}
