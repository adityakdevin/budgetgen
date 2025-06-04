<?php

declare(strict_types=1);

use Tests\TestCase;

pest()->extend(TestCase::class)
    // ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

expect()->extend('toBeOne', fn () => $this->toBe(1));
