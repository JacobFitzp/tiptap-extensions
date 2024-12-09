<?php

use App\Foundation\Github\Repository;

test('it can parse repository', function (
    string $repositoryString,
    string $expectedOwner,
    string $expectedName
) {
    $repository = Repository::parse($repositoryString);

    expect($repository->owner)->toBe($expectedOwner)
        ->and($repository->name)->toBe($expectedName);
})->with([
    ['fake/fake-extension', 'fake', 'fake-extension'],
    ['Fake/Fake-Extension', 'fake', 'fake-extension'],
]);

test('it can get slug', function () {
    $repository = Repository::parse('fake/fake-extension');
    expect($repository->getSlug())->toBe('fake/fake-extension');
});
