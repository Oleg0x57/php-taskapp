<?php
/**
 * Created by PhpStorm.
 * 'User' => Ks
 * 'Date' => 24.11.2018
 * 'Time' => '22' =>01
 */

const PACKAGE_TYPE_PLASTIC_BOTTLE = 'Пэт бут.';
const PACKAGE_TYPE_PLASTIC_CUP = 'Пэт стакан';
const PACKAGE_TYPE_PLASTIC_BAG = 'пакет п/э';
const PACKAGE_TYPE_FOOD_FILM = 'пленка пищевая';
const PACKAGE_TYPE_CASING = 'оболочка';
const MEASURE_TYPE_LITER = 'л';
const MEASURE_TYPE_GRAM = 'г';
const MEASURE_TYPE_KILO = 'кг';

return [
    [
        'id' => 1,
        'title' => 'Молоко',
        'package' => PACKAGE_TYPE_PLASTIC_BOTTLE,
        'bestBefore' => 3,
        'measure' => MEASURE_TYPE_LITER,
        'volume' => 1,
        'cost' => 58
    ],
    [
        'id' => 2,
        'title' => 'Сливки',
        'package' => PACKAGE_TYPE_PLASTIC_BOTTLE,
        'bestBefore' => 5,
        'measure' => MEASURE_TYPE_GRAM,
        'volume' => 250,
        'cost' => 60
    ],
    [
        'id' => 3,
        'title' => 'Сыр "Сулугуни"',
        'package' => PACKAGE_TYPE_FOOD_FILM,
        'bestBefore' => 15,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 420
    ],
    [
        'id' => 4,
        'title' => 'Сыр "Сулугуни" копченый',
        'package' => PACKAGE_TYPE_FOOD_FILM,
        'bestBefore' => 15,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 475
    ],
    [
        'id' => 5,
        'title' => 'Сыр "Адыгейский"',
        'package' => PACKAGE_TYPE_FOOD_FILM,
        'bestBefore' => 6,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 310
    ],
    [
        'id' => 6,
        'title' => 'Сыр "Адыгейский" копченый',
        'package' => PACKAGE_TYPE_FOOD_FILM,
        'bestBefore' => 6,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 355
    ],
    [
        'id' => 7,
        'title' => 'Сыр колбасный',
        'package' => PACKAGE_TYPE_CASING,
        'bestBefore' => 15,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 335
    ],
    [
        'id' => 8,
        'title' => 'Сыр колбасный копченый',
        'package' => PACKAGE_TYPE_CASING,
        'bestBefore' => 15,
        'measure' => MEASURE_TYPE_KILO,
        'volume' => 1,
        'cost' => 362
    ],
    [
        'id' => 9,
        'title' => 'Сыр "Косичка"',
        'package' => PACKAGE_TYPE_PLASTIC_BAG,
        'bestBefore' => 7,
        'measure' => MEASURE_TYPE_GRAM,
        'volume' => 100,
        'cost' => 58
    ]
];