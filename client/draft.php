<?php

route::get ( '/goals/{id}', function ( )
{
    list ( $goal, $tasks, $protein ) =
        app::pipe ( [ 
            'i want to see my goal',
            'i want to see my goals tasks', 
            'i want to see my consumed protein for today' 
        ] );
    
    return view::ok ( 'goals.edit', with ( 'goal', 'tasks', 'protein' ) );
} );


// statuses are going to return some kind of app responses
// with implicit instructions for the app to do something 

status::matching ( 1, function ( goal $goal )
{
    return response::ok ( $goal );
} );


// Some kind of not allowed for user api
// Let them make this themselves
status::matching ( 1000, function ( $id )
{
    return response::notFound ( $id )
        ->redirect ( '/' );
} );

class app
{
    private $data = [ 'goal' => 'Goal found from i want to see my goal procedure.' ];


    function pipe ( array $procedures )
    {
        foreach ( $procedures as $procedure )
        {
            $response = $this->fulfill ( $procedure, $this->data );
            
            if ( ! $response->ok ( ) )
                return $response;
            
            $this->data = array_merge ( $this->data, $response->body );
        }

        $this->data = [ ];
    }
}


// i could also combine the returned statuses from the pipe
// and match them like so:

status::combining ( [ 1, 2, 3 ], function ( goal $goal, array $tasks, int $protein )
{
    return view::ok ( 'goals.edit', with ( 'goal', 'tasks', 'protein' ) );
} );



// If any errors occur we just run the pipe like normal
// only we get back 'error' statuses which we can match like so: 

status::combining ( [ 1000, 2, 3 ], function ( $id, array $tasks, int $protein )
{
    session::flash ( 'message', 'Goal not found.' );
    return redirect::to ( '' );
} );


status::combining ( [ 1, 2000, 3 ], function ( goal $goal, int $protein )
{
    $tasks = [ ];
    session::flash ( 'message', 'Goal without tasks or something.' );
    return view::ok ( 'goals.edit', with ( 'goal', 'tasks', 'protein' ) );
} )->route ( '/{goal}' );


// can this ever give conflicts?
// for example i want to use the precedure i want to see my goal for 2 different routes and return a different view for each
// i could check the route in the status but that seems mediocre