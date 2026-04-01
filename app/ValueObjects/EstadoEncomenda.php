<?php

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object representing the estado of an Encomenda.
 *
 * Encapsulates the business rules for valid estados,
 * following Object Calisthenics principles (wrap all primitives).
 */
readonly class EstadoEncomenda
{
    /**
     * Valid states for an Encomenda.
     */
    public const PENDENTE = 'PENDENTE';
    public const EM_PROCESSAMENTO = 'EM_PROCESSAMENTO';
    public const CONFIRMADA = 'CONFIRMADA';
    public const EM_PRODUCAO = 'EM_PRODUCAO';
    public const CONCLUIDA = 'CONCLUIDA';
    public const CANCELADA = 'CANCELADA';
    public const ENTREGUE = 'ENTREGUE';

    /**
     * List of all valid estados.
     */
    private const VALID_ESTADOS = [
        self::PENDENTE,
        self::EM_PROCESSAMENTO,
        self::CONFIRMADA,
        self::EM_PRODUCAO,
        self::CONCLUIDA,
        self::CANCELADA,
        self::ENTREGUE,
    ];

    /**
     * States that indicate the order is active (not finished).
     */
    private const ESTADOS_ATIVOS = [
        self::PENDENTE,
        self::EM_PROCESSAMENTO,
        self::CONFIRMADA,
        self::EM_PRODUCAO,
    ];

    /**
     * States that indicate the order is finished.
     */
    private const ESTADOS_FINALIZADOS = [
        self::CONCLUIDA,
        self::ENTREGUE,
    ];

    /**
     * Create a new EstadoEncomenda instance.
     *
     * @param string $value The estado value
     * @throws InvalidArgumentException If the value is not valid
     */
    public function __construct(
        public string $value
    ) {
        $this->validate($value);
    }

    /**
     * Validate the estado value.
     *
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function validate(string $value): void
    {
        if (!in_array($value, self::VALID_ESTADOS, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Estado inválido: "%s". Valores válidos: %s',
                    $value,
                    implode(', ', self::VALID_ESTADOS)
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
     * Create a default pendente estado.
     *
     * @return self
     */
    public static function pendente(): self
    {
        return new self(self::PENDENTE);
    }

    /**
     * Check if the estado is active (not finished).
     *
     * @return bool
     */
    public function isAtivo(): bool
    {
        return in_array($this->value, self::ESTADOS_ATIVOS, true);
    }

    /**
     * Check if the estado is finalized.
     *
     * @return bool
     */
    public function isFinalizado(): bool
    {
        return in_array($this->value, self::ESTADOS_FINALIZADOS, true);
    }

    /**
     * Check if the order was cancelled.
     *
     * @return bool
     */
    public function isCancelada(): bool
    {
        return $this->value === self::CANCELADA;
    }

    /**
     * Check if the order can be transitioned to a new state.
     *
     * Business rule: Cannot change from cancelled or delivered states.
     *
     * @param EstadoEncomenda $novoEstado
     * @return bool
     */
    public function podeTransicionar(EstadoEncomenda $novoEstado): bool
    {
        // Cannot change from cancelled state
        if ($this->isCancelada()) {
            return false;
        }

        // Cannot change from delivered state (except to re-delivery scenarios)
        if ($this->value === self::ENTREGUE && $novoEstado->value !== self::ENTREGUE) {
            return false;
        }

        return true;
    }

    /**
     * Get all valid states as array.
     *
     * @return array<string>
     */
    public static function getValidValues(): array
    {
        return self::VALID_ESTADOS;
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
     * Check equality with another EstadoEncomenda.
     *
     * @param self $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}

