<?php

namespace App\DataTransferObjects;

use JsonSerializable;

class OrderData implements JsonSerializable
{
    protected string $vendedor;
    protected string $repartidor;
    /** @var OrderDetailData[] */
    protected array $products;

    public function __construct(string $vendedor, string $repartidor, array $products)
    {
        $this->vendedor = $vendedor;
        $this->repartidor = $repartidor;
        $this->products = $products;
    }

    public function getVendedor(): string
    {
        return $this->vendedor;
    }

    public function setVendedor(string $vendedor)
    {
        $this->vendedor = $vendedor;
        return $this;
    }

    public function getRepartidor(): string
    {
        return $this->repartidor;
    }

    public function setRepartidor(string $repartidor)
    {
        $this->repartidor = $repartidor;
        return $this;
    }

    /**
     * @return OrderDetailData[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products)
    {
        $this->products = $products;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'vendedor' => $this->vendedor,
            'repartidor' => $this->repartidor,
            'products' => $this->products,
        ];
    }
}
