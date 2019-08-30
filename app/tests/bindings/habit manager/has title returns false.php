<?php    
    

app::assumption ( 'habit manager has title returns false', function ( $app )
{
    $app [ 'habit manager' ]
        ->shouldReceive ( 'hasTitle' )
        ->with ( $app [ 'habit' ]->title, $app [ 'user' ] )
        ->andReturn ( false );
} );  