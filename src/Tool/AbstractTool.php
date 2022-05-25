<?php

declare(strict_types=1);

namespace Ghostwriter\Compliance\Tool;

use Symfony\Component\Finder\Finder;
use function dirname;

abstract class AbstractTool
{
    /**
     * Configuration files.
     *
     * @var array<array-key,string>
     */
    public const PRESENCE_FILES = [];

    public function __construct(private Finder $finder)
    {
    }

    public function isPresent(): bool
    {
        $path = dirname(__DIR__, 2);

        $finder = clone $this->finder;

        return $finder
            ->in($path)
            ->sortByName()
            ->name(static::PRESENCE_FILES)->hasResults();
    }
}