<?php

namespace App\DTO\Views;

use JetBrains\PhpStorm\Pure;

class PhaseDTO
{
    public string $key;
    public string $svg;
    public string $user_orders;

    #[Pure] public static function factory() {
        return new self();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): PhaseDTO
    {
        $this->key = $key;
        return $this;
    }

    public function getSvg(): string
    {
        return $this->svg;
    }

    public function setSvg(string $svg): PhaseDTO
    {
        $this->svg = $svg;
        return $this;
    }

    public function getUserOrders(): string
    {
        return $this->user_orders;
    }

    public function setUserOrders(string $user_orders): PhaseDTO
    {
        $this->user_orders = $user_orders;
        return $this;
    }





}