<?php

namespace firestark;

class request extends \http\request
{
    public function uri ( )
    {
        return $this->uri;
    }
}