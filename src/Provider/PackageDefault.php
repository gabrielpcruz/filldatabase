<?php

namespace App\Provider;

use App\App;
use Symfony\Component\Asset\PackageInterface;

class PackageDefault implements PackageInterface
{

    /**
     * @param string $path
     * @return string
     */
    public function getVersion(string $path): string
    {
        return '1';
    }

    /**
     * @param string $path
     * @return string
     */
    public function getUrl(string $path): string
    {
        return '/assets/' . $path;
    }
}