
<?php
interface Builder
{
    public function Makanan(): void;

    public function Minuman(): void;
}



class ConcreteBuilder1 implements Builder
{
    private $product;
    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Makanan;
    }


    public function Makanan(): void
    {
        $this->product->parts[] = "Nasi Goreng, Mie Goreng, Mie Ayam, Ayam Bakar<br>";
    }

    public function Minuman(): void
    {
        $this->product->parts[] = "Jus Mangga, Jus Jeruk, Es Teh manis";
    }



    public function getProduct(): Makanan
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }
}


class Makanan
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Menu: " . implode(', ', $this->parts) . "\n\n";
    }
}


class Director
{

    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->Makanan();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->Minuman();

    }
}


function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1;
    $director->setBuilder($builder);

    Print "Makanan:\n<br>";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();
	
    Print "Minuman:\n<br>";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

}

$director = new Director;
clientCode($director);

