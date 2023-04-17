<?php

declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/../vendor/autoload.php';

$twig = new Environment(new FilesystemLoader(__DIR__.'/templates'), [
    'cache' => false,
    'autoescape' => false,
]);

\file_put_contents(__DIR__.'/../src/Emoji.php', $twig->load('Enum.twig')->render([
    'groups' => collect(\json_decode(\file_get_contents(__DIR__.'/resources/emojis.json'), true, \JSON_THROW_ON_ERROR))
        ->map(fn (array $emoji): array => [
            'group' => $emoji['group'],
            'name' => \mb_strtoupper($emoji['identifier']),
            'code' => collect(\explode(' ', $emoji['unicode']['code_points']))->map(fn (string $code): string => '\u{'.$code.'}')->implode(''),
        ])
        ->groupBy('group')
        ->toArray(),
]));
