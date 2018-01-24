<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Name must be at least {{ limit }} characters long",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 100,
     *      minMessage = "Name must be at least {{ limit }} characters long"
     * )
     */
    protected $description;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\GreaterThan(
     *     value = 0
     * )
     */
    protected $price;

    /**************************************************************************/

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
