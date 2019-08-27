<?php

use Mockery as mockery;
use function compact as with;

require __DIR__ . '/start.php';

describe ( 'i want to see my habits', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->habitManager = mockery::mock ( habit\manager::class );
        $this->user = mockery::mock ( user::class );
        $this->userManager = mockery::mock ( user\manager::class );
        $this->habits = [ mockery::mock ( habit::class ), mockery::mock ( habit::class ) ];

        $this->userManager->shouldReceive ( 'registered' )
            ->with ( $this->user )
            ->andReturn ( true );

        $this->habitManager->shouldReceive ( 'allFor' )
            ->with ( $this->user )
            ->andReturn ( $this->habits );

        list ( $status, $payload ) = app::make ( 'i want to see my habits', [ 
                'manager' => $this->habitManager, 
                'user' => $this->user,
                'userManager' => $this->userManager
            ] );

        $this->status = $status;
        $this->payload = $payload;

    } );

    it ( 'should return status code 1000, given a valid user is supplied', function ( ) 
    {
        assert ( $this->status === 2000, 'Expected status: 1000' );
    } );

    it ( 'should return the expected payload', function ( ) 
    {
        assert ( $this->payload === [ 'habits' => $this->habits ], 'Expected payload differs' );
    } );
} );