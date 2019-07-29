<?php

App::bind(Todo::class, function ($app, array $args)
{
    return new Todo(
        $args['id'] ?? uniqid(),
        $args['description'] ?? ''
    );
});