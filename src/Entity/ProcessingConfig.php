<?php

namespace App\Entity;


class ProcessingConfig
{

    private $id;

    private $background;

    private $velocity;

    private $form;


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

    public function getProperties(): ?array
    {
        $properties = array("background" => $this->background,"velocity" => $this->velocity,"form"=>$this->form);
        return $properties;
    }

    public function getVelocity()
    {
        return $this->velocity;
    }

    public function setVelocity($velocity)
    {
        $this->velocity = $velocity;
    }


    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

//    public function getPropertiesToString(): ?string
//    {
//        $properties = array("background" => $this->background);
//        $propertiesString = serialize($properties);
//        return $propertiesString;
//    }

}
