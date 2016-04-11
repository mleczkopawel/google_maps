<?php
/**
 * Created by PhpStorm.
 * User: Paweł
 * Date: 11.04.2016
 * Time: 22:26
 */

namespace Map\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapPolska
 *
 * @package Map\Bundle\Entity
 * @ORM\Table(name="map_polska")
 * @ORM\Entity(repositoryClass="Map\Bundle\Repository\MapRepository")
 */

class MapPolska
{
    /**
     * @var int
     *
     * @ORM\Column(name="idmap", type="integer")
     */
    private $idmap;

    /**
     * @var int
     *
     * @ORM\Column(name="idpolska", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpolska;

    /**
     * @var string
     *
     * @ORM\Column(name="dane", type="string", length=50)
     */
    private $data;

    /**
     * @return int
     */
    public function getIdmap()
    {
        return $this->idmap;
    }

    /**
     * @param int $idmap
     * @return MapPolska
     */
    public function setIdmap($idmap)
    {
        $this->idmap = $idmap;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdpolska()
    {
        return $this->idpolska;
    }

    /**
     * @param int $idpolska
     * @return MapPolska
     */
    public function setIdpolska($idpolska)
    {
        $this->idpolska = $idpolska;
        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return MapPolska
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }



}