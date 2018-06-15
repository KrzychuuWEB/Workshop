<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_cars")
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $registration;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $engineNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bodyNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $enginePower;

    /**
     * @ORM\Column(type="date")
     */
    private $productionYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $fuelCondition;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAdd;

    /**
     * @ORM\Column(type="time")
     */
    private $timeAdd;

    /**
     * @ORM\Column(type="boolean")
     */
    private $testDrive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $insuranceOC;

    /**
     * @ORM\Column(type="boolean")
     */
    private $repairBook;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VehicleType", inversedBy="car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicleType;

    public function getId()
    {
        return $this->id;
    }

    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    public function setRegistration(string $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getEngineNumber(): ?string
    {
        return $this->engineNumber;
    }

    public function setEngineNumber(string $engineNumber): self
    {
        $this->engineNumber = $engineNumber;

        return $this;
    }

    public function getBodyNumber(): ?string
    {
        return $this->bodyNumber;
    }

    public function setBodyNumber(string $bodyNumber): self
    {
        $this->bodyNumber = $bodyNumber;

        return $this;
    }

    public function getCapacity(): ?float
    {
        return $this->capacity;
    }

    public function setCapacity(float $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getEnginePower(): ?int
    {
        return $this->enginePower;
    }

    public function setEnginePower(int $enginePower): self
    {
        $this->enginePower = $enginePower;

        return $this;
    }

    public function getProductionYear(): ?\DateTimeInterface
    {
        return $this->productionYear;
    }

    public function setProductionYear(\DateTimeInterface $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    public function getFuelCondition(): ?int
    {
        return $this->fuelCondition;
    }

    public function setFuelCondition(int $fuelCondition): self
    {
        $this->fuelCondition = $fuelCondition;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function getTimeAdd(): ?\DateTimeInterface
    {
        return $this->timeAdd;
    }

    public function setTimeAdd(\DateTimeInterface $timeAdd): self
    {
        $this->timeAdd = $timeAdd;

        return $this;
    }

    public function getTestDrive(): ?bool
    {
        return $this->testDrive;
    }

    public function setTestDrive(bool $testDrive): self
    {
        $this->testDrive = $testDrive;

        return $this;
    }

    public function getInsuranceOC(): ?bool
    {
        return $this->insuranceOC;
    }

    public function setInsuranceOC(bool $insuranceOC): self
    {
        $this->insuranceOC = $insuranceOC;

        return $this;
    }

    public function getRepairBook(): ?bool
    {
        return $this->repairBook;
    }

    public function setRepairBook(bool $repairBook): self
    {
        $this->repairBook = $repairBook;

        return $this;
    }

    public function getVehicleType(): ?VehicleType
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?VehicleType $vehicleType): self
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }
}
