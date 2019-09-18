<?php

use Mockery as mockery;

describe ( 'flatfileHabitManager', function ( ) 
{
    beforeEach ( function ( ) 
    {
        $this->habits = [ ];
        $this->habits [ 'Exercise' ] = mockery::mock ( habit::class, [ 'Exercise' ] );
        $this->habits [ 'Handstand' ] = mockery::mock ( habit::class, [ 'Handstand' ] );

        $this->habitManager = new flatfileHabitManager ( $this->habits );
    } );

    describe ( 'add', function ( ) 
    {
        it ( 'should add habits', function ( ) 
        {
            $habit = mockery::mock ( habit::class );
            $this->habitManager->add ( $habit );

            assertThat ( $this->habitManager->habits, hasItemInArray ( $habit ) );
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
    } );

    describe ( 'complete', function ( ) 
    {
        it ( 'should complete a habit', function ( ) 
        {
            $this->habitManager->complete ( $this->habits [ 'Exercise' ] );
            assertThat ( $this->habits [ 'Exercise' ]->completed, is ( true ) );
        } );
    } );
} );