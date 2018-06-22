<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyAnswerRepository")
 */
class SurveyAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SurveyPoll", inversedBy="surveyAnswers")
     */
    private $surveyPoll;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAnswer;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PollAnswer", inversedBy="surveyAnswers")
     */
    private $pollAnswer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="surveyAnswers")
     */
    private $user;

    public function getId()
    {
        return $this->id;
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

    public function getDateAnswer(): ?\DateTimeInterface
    {
        return $this->dateAnswer;
    }

    public function setDateAnswer(\DateTimeInterface $dateAnswer): self
    {
        $this->dateAnswer = $dateAnswer;

        return $this;
    }
    

    public function getPollAnswer(): ?PollAnswer
    {
        return $this->pollAnswer;
    }

    public function setPollAnswer(?PollAnswer $pollAnswer): self
    {
        $this->pollAnswer = $pollAnswer;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
