<?php

// What about only running this file for a specific test

use Mockery as mockery;

$habits = [ mockery::mock ( habit::class ), mockery::mock ( habit::class ) ];

$user = mockery::mock ( user::class );

$manager = mockery::mock ( habit\manager::class );
$manager
    ->shouldReceive ( 'allFor' )
    ->with ( $user )
    ->andReturn ( $habits );


$userManager = mockery::mock ( user\manager::class );
$userManager
    ->shouldReceive ( 'registered' )
    ->with ( $user )
    ->andReturn ( true );


$map = [
    'habits' => $habits,
    habit\manager::class => $manager,
    user::class => $user,
    user\manager::class => $userManager
];

foreach ( $map as $abstract => $concrete )
    app::instance ( $abstract, $concrete );