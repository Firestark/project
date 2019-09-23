<?php

use Mockery as mockery,
    org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory;


describe ( 'flatfileHabitManager', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->users = [ ];
        $this->users [ 'user1' ] = mockery::mock ( user::class, [ 'user1', '' ] );
        $this->users [ 'user2' ] = mockery::mock ( user::class, [ 'user2', '' ] );

        $this->root = vfsStream::setup ( 'home' );
        vfsStream::newFile ( 'users.data' )->at ( $this->root );
        $this->file = 'vfs://home/users.data';

        $this->userManager = new flatfileUserManager ( $this->users, $this->file );
    } );

    describe ( 'add', function ( ) 
    {
        it ( 'should add new users', function ( ) 
        {
            $user = mockery::mock ( user::class );
            $this->userManager->add ( $user );
            assertThat ( $this->userManager->users, is ( array_merge ( $this->users, [ '' => $user ] ) ) );
        } );

        it ( 'should store new users in a file', function ( ) 
        {
            $user = mockery::mock ( user::class );
            $this->userManager->add ( $user );

            assertThat ( file_get_contents ( $this->file ), is ( serialize ( array_merge ( $this->users, [ '' => $user ] ) ) ) );
        } );

        it ( 'should not add users with the same username', function ( ) 
        {
            try {
                $this->userManager->add ( $this->users [ 'user1' ] );
            } catch ( exception $e ) {
                return;
            }

            throw new exception ( 'User with same username was added' );
        } );
    } );

    describe ( 'remove', function ( ) 
    {
        it ( 'should remove users', function ( ) 
        {
            $this->userManager->remove ( $this->users [ 'user1' ] );
            assertThat ( $this->userManager->users, is ( arrayContainingInAnyOrder ( $this->users [ 'user2' ] ) ) );
        } );

        it ( 'should remove a users from a file', function ( ) 
        {
            $this->userManager->remove ( $this->users [ 'user1' ] );
            unset ( $this->users [ 'user1' ] );

            assertThat ( file_get_contents ( $this->file ), is ( serialize ( $this->users ) ) );
        } );
    } );

    describe ( 'has', function ( ) 
    {
        it ( 'should return true for an existing user', function ( ) 
        {
            $has = $this->userManager->has ( $this->users [ 'user1' ] );
            assertThat ( $has, is ( true ) );
        } );

        it ( 'should return false for a non existing user', function ( ) 
        {
            $user = mockery::mock ( user::class );
            $has = $this->userManager->has ( $user );
            assertThat ( $has, is ( false ) );
        } );
    } );
    

    afterEach ( function ( ) 
    {
        mockery::close ( );
    } );
} );