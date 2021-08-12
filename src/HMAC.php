<?php

declare(strict_types=1);

namespace DeSmart\HMAC;

class HMAC
{
    public static string $defaultHashingAlgo = 'sha256';

    private string $key;

    private ?string $hashedData = null;

    private function __construct(string $key, ?string $hashedData = null)
    {
        $this->key = $key;
        $this->hashedData = $hashedData;
    }

    public static function create(string $key, string $stringToHash, ?string $algo = null, bool $binary = false): HMAC
    {
        return (new static($key))->hash($stringToHash, $algo, $binary);
    }

    public static function createFromHash(string $key, string $hashedData): HMAC
    {
        return new static($key, $hashedData);
    }

    public function isEqual(HMAC $hashToCompare): bool
    {
        return hash_equals($this->hashedData, $hashToCompare->hashedData);
    }

    public function __toString(): string
    {
        return $this->hashedData;
    }

    private function hash(string $stringToHash, ?string $algo = null, bool $binary = false): HMAC
    {
        $this->hashedData = hash_hmac($algo ?? self::$defaultHashingAlgo, $stringToHash, $this->key, $binary);

        return $this;
    }
}
