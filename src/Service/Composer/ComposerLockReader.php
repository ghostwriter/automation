<?php

declare(strict_types=1);

namespace Ghostwriter\Compliance\Service\Composer;

use Ghostwriter\Json\Json;

final readonly class ComposerLockReader 
{
    public function read(
        string $composerJsonPath
    ): ComposerLock
    {
        if (!file_exists($composerJsonPath)) {
            throw new \InvalidArgumentException('Composer JSON file does not exist');
        }

        $composerJsonContents = file_get_contents($composerJsonPath);

        if ($composerJsonContents === false){
            throw new \InvalidArgumentException('Composer JSON file could not be read');
        }

        return new ComposerLock($composerJsonPath, Json::decode($composerJsonContents));
    }
}