<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyPollRepository")
 */
class SurveyPoll
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $question;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limitUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Poll", mappedBy="surveyPoll")
     */
    private $poll;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SurveyAnswer", mappedBy="surveyPollId")
     */
    private $surveyAnswers;

    public function __construct()
    {
        $this->poll = new ArrayCollection();
        $this->surveyAnswers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->dateBegin;
    }

    public function setDateBegin(?\DateTimeInterface $dateBegin): self
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getLimitUser(): ?int
    {
        return $this->limitUser;
    }

    public function setLimitUser(?int $limitUser): self
    {
        $this->limitUser = $limitUser;

        return $this;
    }

    /**
     * @return Collection|Poll[]
     */
    public function getPoll(): Collection
    {
        return $this->poll;
    }

    public function addPoll(Poll $poll): self
    {
        if (!$this->poll->contains($poll)) {
            $this->poll[] = $poll;
            $poll->setSurveyPoll($this);
        }

        return $this;
    }

    public function removePoll(Poll $poll): self
    {
        if ($this->poll->contains($poll)) {
            $this->poll->removeElement($poll);
            // set the owning side to null (unless already changed)
            if ($poll->getSurveyPoll() === $this) {
                $poll->setSurveyPoll(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SurveyAnswer[]
     */
    public function getSurveyAnswers(): Collection
    {
        return $this->surveyAnswers;
    }

    public function addSurveyAnswer(SurveyAnswer $surveyAnswer): self
    {
        if (!$this->surveyAnswers->contains($surveyAnswer)) {
            $this->surveyAnswers[] = $surveyAnswer;
            $surveyAnswer->setSurveyPollId($this);
        }

        return $this;
    }

    public function removeSurveyAnswer(SurveyAnswer $surveyAnswer): self
    {
        if ($this->surveyAnswers->contains($surveyAnswer)) {
            $this->surveyAnswers->removeElement($surveyAnswer);
            // set the owning side to null (unless already changed)
            if ($surveyAnswer->getSurveyPollId() === $this) {
                $surveyAnswer->setSurveyPollId(null);
            }
        }

        return $this;
    }
}
