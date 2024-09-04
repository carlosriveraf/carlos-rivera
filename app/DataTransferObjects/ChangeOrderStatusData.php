<?php

namespace App\DataTransferObjects;

class ChangeOrderStatusData
{
    protected string $nroPedido;
    protected string $estado;

    public function __construct(string $nroPedido, string $estado)
    {
        $this->nroPedido = $nroPedido;
        $this->estado = $estado;
    }

    public function getNroPedido(): string
    {
        return $this->nroPedido;
    }

    public function setNroPedido(string $nroPedido)
    {
        $this->nroPedido = $nroPedido;
        return $this;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado)
    {
        $this->estado = $estado;
        return $this;
    }
}
