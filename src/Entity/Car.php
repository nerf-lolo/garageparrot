<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $car_km = null;

    #[ORM\Column(length: 255)]
    private ?string $energy = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarImage::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $carImages;

    public function __construct()
    {
        $this->carImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getCarKm(): ?int
    {
        return $this->car_km;
    }

    public function setCarKm(int $car_km): static
    {
        $this->car_km = $car_km;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CarImage>
     */
    public function getCarImages(): Collection
    {
        return $this->carImages;
    }

    public function addCarImage(CarImage $carImage): static
    {
        if (!$this->carImages->contains($carImage)) {
            $this->carImages->add($carImage);
            $carImage->setCar($this);
        }

        return $this;
    }

    public function removeCarImage(CarImage $carImage): static
    {
        if ($this->carImages->removeElement($carImage)) {
            // set the owning side to null (unless already changed)
            if ($carImage->getCar() === $this) {
                $carImage->setCar(null);
            }
        }

        return $this;
    }
}
