<?php

namespace App\Entity;


class ProcessingConfig
{

    private $id;

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

    public function getProperties(): ?array
    {
        $properties = array("background" => $this->background);
        return $properties;
    }

//    public function getPropertiesToString(): ?string
//    {
//        $properties = array("background" => $this->background);
//        $propertiesString = serialize($properties);
//        return $propertiesString;
//    }

}
