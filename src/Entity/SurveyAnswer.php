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
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PollAnswer", inversedBy="surveyAnswers")
     */
    private $pollAnswer;

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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

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
}
