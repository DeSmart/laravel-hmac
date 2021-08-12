<?php

declare(strict_types=1);

namespace DeSmart\HMAC\Tests;

use DeSmart\HMAC\HMAC;
use PHPUnit\Framework\TestCase;

class HMACTest extends TestCase
{
    /** @test */
    public function it_creates_hmac_object(): void
    {
        $hmac = HMAC::create('hash-key', 'some dummy string to hash');

        $this->assertIsString((string) $hmac);
    }

    /** @test */
    public function it_compares_hmac_objects(): void
    {
        HMAC::$defaultHashingAlgo = 'sha256';

        $hmac = HMAC::create('hash-key', 'some dummy string to hash');
        $hmacFromHash = HMAC::createFromHash('hash-key', hash_hmac('sha256', 'some dummy string to hash', 'hash-key'));

        $this->assertTrue($hmac->isEqual($hmacFromHash));
    }

    /** @test */
    public function it_compares_hmac_objects_with_non_default_hashing_algo(): void
    {
        HMAC::$defaultHashingAlgo = 'sha256';

        $hmac = HMAC::create('hash-key', 'some dummy string to hash', 'sha512');
        $hmacFromHash = HMAC::createFromHash('hash-key', hash_hmac('sha512', 'some dummy string to hash', 'hash-key'));

        $this->assertTrue($hmac->isEqual($hmacFromHash));
    }

    /** @test */
    public function it_compares_hmac_objects_with_different_hashing_key(): void
    {
        HMAC::$defaultHashingAlgo = 'sha256';

        $hmac = HMAC::create('hash-key', 'some dummy string to hash');
        $hmacFromHash = HMAC::createFromHash('hash-key', hash_hmac('sha256', 'some dummy string to hash', 'different-hash-key'));

        $this->assertFalse($hmac->isEqual($hmacFromHash));
    }

    /** @test */
    public function it_compares_hmac_objects_with_different_hashing_algo(): void
    {
        HMAC::$defaultHashingAlgo = 'sha256';

        $hmac = HMAC::create('hash-key', 'some dummy string to hash');
        $hmacFromHash = HMAC::createFromHash('hash-key', hash_hmac('sha512', 'some dummy string to hash', 'hash-key'));

        $this->assertFalse($hmac->isEqual($hmacFromHash));
    }
}