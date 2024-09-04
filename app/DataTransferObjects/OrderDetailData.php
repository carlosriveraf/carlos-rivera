<?php

namespace App\DataTransferObjects;

use JsonSerializable;

class OrderDetailData implements JsonSerializable
{
    protected string $sku;
    protected string $nombre;
    protected float $precio;
    protected float $cantidad;
    protected string $unidadMedida;

    public function __construct(string $sku, string $nombre, float $precio, float $cantidad, string $unidadMedida)
    {
        $this->sku = $sku;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->unidadMedida = $unidadMedida;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku)
    {
        $this->sku = $sku;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio)
    {
        $this->precio = $precio;
        return $this;
    }

    public function getCantidad(): float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad)
    {
        $this->cantidad = $cantidad;
        return $this;
    }

    public function getUnidadMedida(): string
    {
        return $this->unidadMedida;
    }

    public function setUnidadMedida(string $unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'sku' => $this->sku,
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'unidadMedida' => $this->unidadMedida,
        ];
    }
}
