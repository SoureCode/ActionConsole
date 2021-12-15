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

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Constructor.
     */
    public function __construct(iterable $commands = [])
    {
        parent::__construct('Action', '0.1.0-DEV');

        foreach ($commands as $command) {
            $this->add($command);
        }

        $this->setDefaultCommand('action', true);
    }
}
