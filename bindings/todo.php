<?php

App::bind(Todo::class, function ($app)
{
    return new Todo(
        Input::get('id', uniqid()),
        Input::get('description', '')
    );
});