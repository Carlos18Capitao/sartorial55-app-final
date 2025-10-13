<?php

namespace App\Emun;
enum ModeloCasacoEnum: string
{
    case CASACO = 'casaco';
    case CASACO_MASCULINO = 'casaco_masculino';
    case CASACO_FEMININO = 'casaco_feminino';
    case CASACO_UNISSEX = 'casaco_unissex';

    public function getLabel(): string
    {
        return match ($this) {
            self::CASACO => 'Casaco',
            self::CASACO_MASCULINO => 'Casaco Masculino',
            self::CASACO_FEMININO => 'Casaco Feminino',
            self::CASACO_UNISSEX => 'Casaco Unissex',
        };
    }
}
