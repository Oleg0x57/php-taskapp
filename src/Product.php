<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.11.2018
 * Time: 22:08
 */

namespace App;

class Product
{
    use ToArray;
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $package;
    /**
     * @var string
     */
    private $bestBefore;
    /**
     * @var string
     */
    private $measure;
    /**
     * @var float
     */
    private $volume;
    /**
     * @var float
     */
    private $cost;

    /**
     * Product constructor.
     * @param $id
     * @param $title
     * @param $package
     * @param $bestBefore
     * @param $measure
     * @param $volume
     * @param $cost
     */
    public function __construct($id, $title, $package, $bestBefore, $measure, $volume, $cost)
    {
        $this->id = $id;
        $this->title = $title;
        $this->package = $package;
        $this->bestBefore = $bestBefore;
        $this->measure = $measure;
        $this->volume = $volume;
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getBestBefore(): string
    {
        return $this->bestBefore;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMeasure(): string
    {
        return $this->measure;
    }

    /**
     * @return string
     */
    public function getPackage(): string
    {
        return $this->package;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @param string $bestBefore
     */
    public function setBestBefore(string $bestBefore): void
    {
        $this->bestBefore = $bestBefore;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $measure
     */
    public function setMeasure(string $measure): void
    {
        $this->measure = $measure;
    }

    /**
     * @param string $package
     */
    public function setPackage(string $package): void
    {
        $this->package = $package;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume): void
    {
        $this->volume = $volume;
    }
}