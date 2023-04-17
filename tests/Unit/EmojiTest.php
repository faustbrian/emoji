<?php

declare(strict_types=1);

namespace Tests\Unit;

use PreemStudio\Emoji\Emoji;

it('should get all cases', function (): void {
    expect(Emoji::all())->toHaveLength(3655);
});

it('should get all keys', function (): void {
    expect(Emoji::keys())->toHaveLength(3655);
});

it('should get all values', function (): void {
    expect(Emoji::values())->toHaveLength(3655);
});

it('should get all identifiers', function (): void {
    expect(Emoji::identifiers())->toHaveLength(3655);
});

it('should get an emoji', function (string $characterName, Emoji $emoji): void {
    expect(Emoji::fromString($characterName))->toBe($emoji);
})->with(Emoji::dataset());

it('should get an emoji from various character name formats', function (): void {
    expect(Emoji::fromString('grinning face'))->toBe(Emoji::CHARACTER_GRINNING_FACE);
    expect(Emoji::fromString('grinning-face'))->toBe(Emoji::CHARACTER_GRINNING_FACE);
    expect(Emoji::fromString('grinning_face'))->toBe(Emoji::CHARACTER_GRINNING_FACE);
});

it('should get a country flag', function (): void {
    expect(Emoji::countryFlag('FI'))->toBe(Emoji::CHARACTER_FLAG_FINLAND->value);
    expect(Emoji::countryFlag('fi'))->toBe(Emoji::CHARACTER_FLAG_FINLAND->value);
});
