<?php

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object representing the tipo of an ItemEncomenda.
 *
 * Encapsulates the business rules for valid tipos,
 * following Object Calisthenics principles (wrap all primitives).
 */
readonly class TipoItemEncomenda
{
    /**
     * Valid types for an ItemEncomenda.
     */
    public const CAMISA = 'camisa';
    public const FATO = 'fato';
    public const CASACO = 'casaco';
    public const CALCA = 'calca';
    public const COLETE = 'colete';
    public const SAPATO = 'sapato';

    /**
     * List of all valid tipos.
     */
    private const VALID_TYPES = [
        self::CAMISA,
        self::FATO,
        self::CASACO,
        self::CALCA,
        self::COLETE,
        self::SAPATO,
    ];

    /**
     * Types that are considered "outerwear" (have sleeve measurements).
     */
    private const OUTERWEAR_TYPES = [
        self::CAMISA,
        self::CASACO,
        self::FATO,
    ];

    /**
     * Types that have pants-like measurements.
     */
    private const PANTS_TYPES = [
        self::CALCA,
        self::FATO,
    ];

    /**
     * Types that have vest-like measurements.
     */
    private const VEST_TYPES = [
        self::COLETE,
    ];

    /**
     * Create a new TipoItemEncomenda instance.
     *
     * @param string $value The tipo value
     * @throws InvalidArgumentException If the value is not valid
     */
    public function __construct(
        public string $value
    ) {
        $this->validate($value);
    }

    /**
     * Validate the tipo value.
     *
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function validate(string $value): void
    {
        if (!in_array($value, self::VALID_TYPES, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Tipo inválido: "%s". Tipos válidos: %s',
                    $value,
                    implode(', ', self::VALID_TYPES)
                )
            );
        }
    }

    /**
     * Create from string with automatic validation.
     *
     * @param string $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        return new self(mb_strtolower(trim($value)));
    }

    /**
     * Create a camisa tipo.
     *
     * @return self
     */
    public static function camisa(): self
    {
        return new self(self::CAMISA);
    }

    /**
     * Create a casaco tipo.
     *
     * @return self
     */
    public static function casaco(): self
    {
        return new self(self::CASACO);
    }

    /**
     * Create a calca tipo.
     *
     * @return self
     */
    public static function calca(): self
    {
        return new self(self::CALCA);
    }

    /**
     * Create a colete tipo.
     *
     * @return self
     */
    public static function colete(): self
    {
        return new self(self::COLETE);
    }

    /**
     * Create a fato tipo (suit - includes jacket and pants).
     *
     * @return self
     */
    public static function fato(): self
    {
        return new self(self::FATO);
    }

    /**
     * Check if the type is outerwear (has sleeve measurements).
     *
     * @return bool
     */
    public function isOuterwear(): bool
    {
        return in_array($this->value, self::OUTERWEAR_TYPES, true);
    }

    /**
     * Check if the type has pants measurements.
     *
     * @return bool
     */
    public function isPants(): bool
    {
        return in_array($this->value, self::PANTS_TYPES, true);
    }

    /**
     * Check if the type is a vest.
     *
     * @return bool
     */
    public function isVest(): bool
    {
        return in_array($this->value, self::VEST_TYPES, true);
    }

    /**
     * Check if the type is a single piece (not part of a suit).
     *
     * @return bool
     */
    public function isSinglePiece(): bool
    {
        return in_array($this->value, [
            self::CAMISA,
            self::CASACO,
            self::CALCA,
            self::COLETE,
            self::SAPATO,
        ], true);
    }

    /**
     * Get the related model class for this tipo.
     *
     * Returns the MorphModel class that stores measurements for this tipo.
     *
     * @return string
     */
    public function getMedidaModelClass(): string
    {
        return match ($this->value) {
            self::CAMISA => \App\Models\MedidaCamisa::class,
            self::CASACO => \App\Models\MedidaCasaco::class,
            self::COLETE => \App\Models\MedidaColete::class,
            self::CALCA => \App\Models\MedidaCalca::class,
            self::FATO => \App\Models\MedidaCasaco::class, // Fato uses casaco measurements
            default => throw new \RuntimeException("Tipo {$this->value} não suportado para medições"),
        };
    }

    /**
     * Get all valid types as array.
     *
     * @return array<string>
     */
    public static function getValidValues(): array
    {
        return self::VALID_TYPES;
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Check equality with another TipoItemEncomenda.
     *
     * @param self $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

