<?php

use Mockery as mockery,
    org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory;

describe ( 'flatfileHabitManager', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->userManager = mockery::mock ( user\manager::class );
        $this->user = mockery::mock ( user::class );
        $this->guard = new guard ( $this->userManager );
    } );

    describe ( 'authenticate', function ( ) 
    {
        it ( 'should return true if username exists and password matches', function ( ) 
        {
            $this->userManager
                ->shouldReceive ( 'has' )
                ->with ( $this->user )
                ->once ( )
                ->andReturn ( true );

            assertThat ( $this->guard->authenticate ( $this->user ), is ( true ) );
        } );

        it ( 'should return false if username does not exist or password does not match', function ( ) 
        {
            $this->userManager
                ->shouldReceive ( 'has' )
                ->with ( $this->user )
                ->once ( )
                ->andReturn ( false );

            assertThat ( $this->guard->authenticate ( $this->user ), is ( false ) );
        } );
    } );

    afterEach ( function ( ) 
    {
        mockery::close ( );
    } );
} );