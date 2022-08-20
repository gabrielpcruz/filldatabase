<?php

namespace App\Provider;

use Symfony\Component\Asset\Packages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Asset extends AbstractExtension
{
    /**
     * @var Packages
     */
    protected Packages $packages;

    /**
     * @param Packages $packages
     */
    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
        $this->packages->setDefaultPackage(new PackageDefault());
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'asset';
    }

    /**
     * Returns the public url/path of an asset.
     *
     * If the package used to generate the path is an instance of
     * UrlPackage, you will always get a URL and not a path.
     *
     * @param string $path        A public path
     * @param string|null $packageName The name of the asset package to use
     *
     * @return string The public path of the asset
     */
    public function getAssetUrl(string $path, string $packageName = null): string
    {
        return $this->packages->getPackage()->getUrl($path) ;
    }

    /**
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new TwigFunction('asset', [$this, 'getAssetUrl']),
        ];
    }
}