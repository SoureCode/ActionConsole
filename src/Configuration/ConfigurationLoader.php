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

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class ConfigurationLoader
{
    public function load(array $files): array
    {
        $configs = [];

        foreach ($files as $file) {
            $contents = file_get_contents($file);
            $json = json_decode($contents, true, 512, \JSON_THROW_ON_ERROR);

            $configs[] = $json;
        }

        return $configs;
    }
}
