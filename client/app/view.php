<?php

namespace firestark;

use http\response\factory;
use Jenssegers\Blade\Blade as engine;

class view
{
    private $response, $view;

    public function __construct ( factory $response, engine $view )
    {
        $this->response = $response;
        $this->view = $view;
    }

    public function ok ( string $template, array $data = [ ] ) : \http\response
    {
        $view = $this->view->make ( $template, $data );
        return $this->response->ok ( ( string ) $view );
    }

    public function notFound ( string $template, array $data = [ ] ) : \http\response
    {
        $view = $this->view->make ( $template, $data );
        return $this->response->notFound ( ( string ) $view );
    }

    public function conflict ( string $template, array $data = [ ] ) : \http\response
    {
        $view = $this->view->make ( $template, $data );
        return $this->response->conflict ( ( string ) $view );
    }

    public function title ( string $title )
    {
        $this->view->share ( 'title', $title );
    }
}
