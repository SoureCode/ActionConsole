<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Console\Action\Configuration;

use Symfony\Component\Config\FileLocator;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class ConfigurationFileLocator extends FileLocator
{
    public function __construct(array $paths = [])
    {
        parent::__construct(
            array_merge([
                $this->homeDirectory(),
                getcwd(),
            ], $paths)
        );
    }

    private function homeDirectory(): ?string
    {
        $home = getenv('HOME');

        return false === $home ? null : $home;
    }
}
