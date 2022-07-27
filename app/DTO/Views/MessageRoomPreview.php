<?php

namespace App\DTO\Views;

class MessageRoomPreview
{
    public function __construct(
        public int $id,
        public string $name,
        public string $textColor,
        public string $previewText,
        public string $lastMessage,
    ){

    }
}