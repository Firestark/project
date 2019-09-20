<?php

use Mockery as mockery,
    org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory;

describe ( 'flatfileHabitManager', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->habits = [ ];
        $this->habits [ 'Exercise' ] = mockery::mock ( habit::class, [ 'Exercise' ] );
        $this->habits [ 'Handstand' ] = mockery::mock ( habit::class, [ 'Handstand' ] );

        $this->root = vfsStream::setup ( 'home' );
        vfsStream::newFile ( 'habits.data' )->at ( $this->root );
        $this->file = 'vfs://home/habits.data';

        $this->habitManager = new flatfileHabitManager ( $this->habits, $this->file );
    } );

    describe ( 'add', function ( ) 
    {
        it ( 'should add habits', function ( ) 
        {
            $habit = mockery::mock ( habit::class );
            $this->habitManager->add ( $habit );
            assertThat ( $this->habitManager->habits, hasItemInArray ( $habit ) );
        } );

        it ( 'should save habits to a file', function ( ) 
        {
            $this->habits [ 'Psychology' ] = mockery::mock ( habit::class, [ 'Psychology' ] );
            $this->habitManager->add ( $this->habits [ 'Psychology' ] );

            assertThat ( file_get_contents ( $this->file ), is ( identicalTo ( serialize ( $this->habits ) ) ) );
        } );
    } );

    describe ( 'has', function ( ) 
    {
        it ( 'should find out that the habit does not exist by title', function ( ) 
        {
            $habit = mockery::mock ( habit::class );
            assertThat ( $this->habitManager->has ( $habit ), is ( false ) );
        } );

        it ( 'should find out that the habit does exist by title', function ( ) 
        {
            assertThat ( $this->habitManager->has ( $this->habits [ 'Exercise' ] ), is ( true ) );
        } );
    } );

    describe ( 'all', function ( ) 
    {
        it ( 'should return all stored habits', function ( ) 
        {
            assertThat ( $this->habitManager->all ( ), is ( arrayContainingInAnyOrder ( $this->habits ) ) );
        } );
    } );

    describe ( 'remove', function ( ) 
    {
        it ( 'should remove a stored habit', function ( ) 
        {
            $this->habitManager->remove ( $this->habits [ 'Exercise' ] );
            assertThat ( $this->habitManager->all ( ), is ( arrayContainingInAnyOrder ( $this->habits [ 'Handstand' ] ) ) );
        } );

        it ( 'should save habits to a file', function ( ) 
        {
            $this->habitManager->remove ( $this->habits [ 'Exercise' ] );
            assertThat ( file_get_contents ( $this->file ), is ( identicalTo ( serialize ( [ 'Handstand' => $this->habits [ 'Handstand' ] ] ) ) ) );
        } );
    } );

    describe ( 'complete', function ( ) 
    {
        it ( 'should complete a habit', function ( ) 
        {
            $this->habitManager->complete ( $this->habits [ 'Exercise' ] );
            assertThat ( $this->habits [ 'Exercise' ]->completed, is ( true ) );
        } );

        it ( 'should save habits to a file', function ( ) 
        {
            $this->habitManager->complete ( $this->habits [ 'Exercise' ] );
            assertThat ( file_get_contents ( $this->file ), is ( identicalTo ( serialize ( $this->habits ) ) ) );
        } );
    } );

    afterEach ( function ( ) 
    {
        mockery::close ( );
    } );
} );