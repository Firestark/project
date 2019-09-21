<?php

use Mockery as mockery;

describe ( 'flatfileHabitManager', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->users = [ ];
        $this->users [ 'user1' ] = mockery::mock ( user::class, [ 'user1', '' ] );
        $this->users [ 'user2' ] = mockery::mock ( user::class, [ 'user2', '' ] );
        $this->userManager = new flatfileUserManager ( $this->users );
    } );

    describe ( 'add', function ( ) 
    {
        it ( 'should add new users', function ( ) 
        {
            $user = mockery::mock ( user::class );
            $this->userManager->add ( $user );
            assertThat ( $this->userManager->users, is ( array_merge ( [ $user ], $this->users ) ) );
        } );

        it ( 'should not add users with the same username', function ( ) 
        {
            $this->userManager->add ( $this->users [ 'user1' ] );
            assertThat ( $this->userManager->users, is ( $this->users ) );
        } );
    } );

    describe ( 'remove', function ( ) 
    {
        it ( 'should remove users', function ( ) 
        {
            $this->userManager->remove ( $this->users [ 'user1' ] );
            assertThat ( $this->userManager->users, is ( arrayContainingInAnyOrder ( $this->users [ 'user2' ] ) ) );
        } );
    } );
    

    afterEach ( function ( ) 
    {
        mockery::close ( );
    } );
} );