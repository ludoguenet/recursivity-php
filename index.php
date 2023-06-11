<?php

require './vendor/autoload.php';

$nestedArray = [
    null,
    123,
    'test1' => [
        'test2'
    ],
    [],
    [
        [
            'test3',
            [],
        ]
    ],
    [
        [
            [
                'test4',
                [],
            ]
        ]
    ],
    [],
];

$nested = [
    'test1' => [
        'test2'
    ],
    [
        [
            'test3'
        ]
    ],
    [
        [
            [
                'test4',
            ]
        ]
    ]
];

function flatten(array $array): array
{
    $flattenArray = [];

    foreach($array as $value) {
        if (is_array($value)) {
            $flattenArray = [...$flattenArray, ...flatten($value)];
        } else {
            $flattenArray[] = $value;
        }
    }

    return $flattenArray;
}

flatten($nested);

function remove_empty_arrays(array $array): array
{
    foreach($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = remove_empty_arrays($value);
        }

        if (empty($array[$key])) {
            unset($array[$key]);
        }
    }
    
    return $array;
}

dump($nestedArray);
dump(remove_empty_arrays($nestedArray));