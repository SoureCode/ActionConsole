<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Console\Action;

class Kernel
{
    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }
}
