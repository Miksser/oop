<?php

class ShopProduct
{
    const AVAILABLE = 1;
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount = 0;

    function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    public function getProducer()
    {
        return "{$this->producerFirstName} "
            . "{$this->producerMainName}";
    }

    public function getProducerMainName()
    {
        return $this->producerMainName;
    }

    public function getProducerFirstName()
    {
        return $this->producerFirstName;
    }

    public function setDiscount($num)
    {
        $this->discount = $num;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return ($this->price - $this->discount);
    }

    public function getSummaryLine()
    {
        $base = "{$this->title}( {$this->producerMainName}";
        $base .= "{$this->producerFirstName}";
        return $base;
    }

}

class CDProduct extends ShopProduct
{
    private $playLength;

    public function __construct($title, $firstName, $mainName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLength}";

        return $base;
    }

}

class BookProduct extends ShopProduct
{
    private $numPages;

    public function __construct($title, $firstName, $mainName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Количество страниц - {$this->numPages}";

        return $base;
    }

}

interface IndenityObject
{
    public function generateId();
}

trait IndenityTrait
{
    public function generateId()
    {
        return uniqid();
    }
}

trait PriceUtilites
{
    private $taxrate = 17;

    function calculateTax($price)
    {
        return (($this->taxrate / 100) * $price);
    }
}


$aa = new CDProduct("a", "a", "b", 1, 1);

print_r($aa->getSummaryLine());

$aa = new BookProduct("a", "a", "b", 1, 1);

print_r($aa->getSummaryLine());
