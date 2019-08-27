<?php

require __DIR__ . '/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest.php';

describe('ArrayObject', function() {
    beforeEach(function() {
        $this->arrayObject = new ArrayObject(['one', 'two', 'three']);
    });

    describe('->count()', function() {
        it('should return the number of items', function() {
            $count = $this->arrayObject->count();
            assertThat ( '1', is ( identicalTo ( 1 ) ) );
        });
    });
});