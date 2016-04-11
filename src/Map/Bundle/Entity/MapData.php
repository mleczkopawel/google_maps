<?php

namespace Map\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapData
 *
 * @ORM\Table(name="map_data")
 * @ORM\Entity(repositoryClass="Map\Bundle\Repository\MapRepository")
 */
class MapData
{
    /**
     * @var int
     *
     * @ORM\Column(name="idmap", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idmap;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="string", length=255)
     */
    private $lon;

    /**
     * @var string
     *
     * @ORM\Column(name="ikona", type="string", length=100)
     */
    private $ikona;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=30)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="danesm", type="string", length=50)
     */
    private $danesm;

    /**
     * @var string
     *
     * @ORM\Column(name="danebg", type="string", length=255)
     */
    private $danebg;

    /**
     * @return int
     */
    public function getIdmap()
    {
        return $this->idmap;
    }

    /**
     * @param int $idmap
     * @return MapData
     */
    public function setId($idmap)
    {
        $this->id = $idmap;
        return $this;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return MapData
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param string $lon
     * @return MapData
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
        return $this;
    }

    /**
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @param string $nazwa
     * @return MapData
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        return $this;
    }

    /**
     * @return string
     */
    public function getIkona()
    {
        return $this->ikona;
    }

    /**
     * @param string $ikona
     * @return MapData
     */
    public function setIkona($ikona)
    {
        $this->ikona = $ikona;
        return $this;
    }

    /**
     * @return string
     */
    public function getDanesm()
    {
        return $this->danesm;
    }

    /**
     * @param string $danesm
     * @return MapData
     */
    public function setDanesm($danesm)
    {
        $this->danesm = $danesm;
        return $this;
    }

    /**
     * @return string
     */
    public function getDanebg()
    {
        return $this->danebg;
    }

    /**
     * @param string $danebg
     * @return MapData
     */
    public function setDanebg($danebg)
    {
        $this->danebg = $danebg;
        return $this;
    }
}

