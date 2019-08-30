<?php

class collector
{
    static $tests = [ ];

    static function add ( string $feature, string $description, closure $test )
    {
        static::$tests [ $feature ] [ $description ] = $test;
    }

    static function all ( ) : array
    {
        return static::$tests;
    }
}

class testing
{
    static $currentFeature = '';

    static function feature ( string $feature, closure $tests )
    {
        static::$currentFeature = $feature;
        $tests ( );
    }
}

class testcase
{
    static function add ( string $description, closure $test )
    {
        collector::add ( testing::$currentFeature, $description, $test );
    }
}