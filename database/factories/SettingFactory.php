<?php

use Faker\Generator as Faker;

$factory -> define(\App\Models\Setting::class, function (Faker $faker) {
    return [
        "social_networks" => [
            "facebook"  => "https://www.facebook.com",
            "twitter"   => "https://www.twitter.com",
            "instagram" => "https://www.instagram.com"
        ],
        "phone_numbers" => [
            $faker -> e164PhoneNumber,
            $faker -> e164PhoneNumber,
            $faker -> e164PhoneNumber
        ],
        "websites" => [
            $faker -> url,
            $faker -> url
        ],
        "emails" => [
            $faker -> email,
        ],
        "addresses" => [
            $faker -> streetAddress
        ]
    ];
});
