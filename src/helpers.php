<?php

use App\App;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Console\Application;

if (!function_exists('turnNameSpacePathIntoArray')) {
    function turnNameSpacePathIntoArray($nameSpacePath, $namespace, $excludeFiles = [], $excludePaths = []): array
    {
        $items = [];

        $pathsToExclude = ['.', '..'];

        foreach ($excludePaths as $path) {
            $pathsToExclude[] = $path;
        }

        foreach (scandir($nameSpacePath) as $class) {
            $isExcludePath = in_array($class, $pathsToExclude);
            $isExcludeFile = in_array($class, $excludeFiles);

            if (!$isExcludePath && !$isExcludeFile) {
                $items[] = $namespace . str_replace('.php', '', $class);
            }
        }

        return $items;
    }
}

if (!function_exists('getConsole')) {
    function getConsole($container): Application
    {
        $console = new Application();

        $commands = (require_once $container->get('settings')->get('file.commands'));

        if (!empty($commands)) {
            foreach ($commands as $commandClass) {
                $console->add($container->get($commandClass));
            }
        }

        return $console;
    }
}

if (!function_exists('string_similarity')) {
    function string_similarity($input, $word): float
    {
        $percentage = levenshtein( strtolower($input),strtolower($word));

        $percent = 1 - $percentage / max(strlen($input), strlen($word));

        return round($percent * 100, 2);
    }
}

