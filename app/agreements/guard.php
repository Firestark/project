<?php

interface guard
{
    function authenticate ( user $user ) : bool;
}