<?php

namespace App\ValueObjects;

use InvalidArgumentException;

/**
 * Value Object representing a telephone number (Telefone).
 *
 * Encapsulates validation and formatting for Portuguese phone numbers,
 * following Object Calisthenics principles (wrap all primitives).
 */
readonly class Telefone
{
    /**
     * Portuguese mobile phone prefix.
     */
    public const PREFIX_MOBILE = '9';

    /**
     * Portuguese landline prefixes.
     */
    public const PREFIX_LANDLINE = ['2', '3'];

    /**
     * Allowed initial digits for Portuguese numbers.
     */
    private const VALID_INITIALS = ['2', '3', '9'];

    /**
     * Total length of Portuguese phone numbers.
     */
    public const LENGTH = 9;

    /**
     * The raw phone number (digits only).
     */
    private string $digitsOnly;

    /**
     * Create a new Telefone instance.
     *
     * @param string $value The phone number
     * @throws InvalidArgumentException If the value is not valid
     */
    public function __construct(
        public string $value
    ) {
        $this->digitsOnly = $this->extractDigits($value);
        $this->validate($this->digitsOnly);
    }

    /**
     * Extract only digits from the phone number.
     *
     * @param string $value
     * @return string
     */
    private function extractDigits(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Validate the phone number.
     *
     * @param string $digits
     * @throws InvalidArgumentException
     */
    private function validate(string $digits): void
    {
        // Check length
        if (strlen($digits) !== self::LENGTH) {
            throw new InvalidArgumentException(
                sprintf(
                    'Número de telefone deve ter %d dígitos. Fornecido: %d',
                    self::LENGTH,
                    strlen($digits)
                )
            );
        }

        // Check if it starts with valid initial
        $initial = $digits[0];
        if (!in_array($initial, self::VALID_INITIALS, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Número de telefone deve começar com %s. Fornecido: %s',
                    implode(', ', self::VALID_INITIALS),
                    $initial
                )
            );
        }
    }

    /**
     * Create from string with automatic normalization.
     *
     * @param string $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        return new self(trim($value));
    }

    /**
     * Create from digits only (without formatting).
     *
     * @param string $digits
     * @return self
     */
    public static function fromDigits(string $digits): self
    {
        return new self($digits);
    }

    /**
     * Get the number type (mobile or landline).
     *
     * @return string
     */
    public function getTipo(): string
    {
        if ($this->digitsOnly[0] === self::PREFIX_MOBILE) {
            return 'móvel';
        }

        return 'fixo';
    }

    /**
     * Check if this is a mobile number.
     *
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->digitsOnly[0] === self::PREFIX_MOBILE;
    }

    /**
     * Check if this is a landline number.
     *
     * @return bool
     */
    public function isLandline(): bool
    {
        return in_array($this->digitsOnly[0], self::PREFIX_LANDLINE, true);
    }

    /**
     * Format as Portuguese format: XXX XXX XXX.
     *
     * @return string
     */
    public function format(): string
    {
        return sprintf(
            '%s %s %s',
            substr($this->digitsOnly, 0, 3),
            substr($this->digitsOnly, 3, 3),
            substr($this->digitsOnly, 6, 3)
        );
    }

    /**
     * Format with country code: +351 XXX XXX XXX.
     *
     * @return string
     */
    public function formatInternational(): string
    {
        return '+351 ' . $this->format();
    }

    /**
     * Get digits only (for storage in database).
     *
     * @return string
     */
    public function toDigits(): string
    {
        return $this->digitsOnly;
    }

    /**
     * Convert to string (formatted).
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->format();
    }

    /**
     * Check equality with another Telefone.
     *
     * @param self $other
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->digitsOnly === $other->digitsOnly;
    }
}

