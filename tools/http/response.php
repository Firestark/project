<?php

namespace firestark\http;

use Psr\Http\Message\ResponseInterface as responseInterface;
use Zend\Diactoros\ResponseFactory as responseFactory;
use Zend\Diactoros\Response as r;

class response extends responseFactory
{
	protected $headers =
    [
        'Access-Control-Allow-Origin'       => '*',
        'Access-Control-Allow-Headers'      => 'Origin, Accept, Content-Type, Authorization, X-Requested-With, Content-Range, Content-Disposition'
    ];

	function __construct ( string $class )
	{
		$this->response = $class;
    }

    function status ( int $number )
	{
		$this->headers [ 'X-Firestark-Status' ] = $number;
	}

	function createResponse ( int $code = 200, string $reasonPhrase = '' ) : responseInterface
    {
        $response = ( new r ( ) )
			->withStatus ( $code, $reasonPhrase );

		foreach ( $this->headers as $key => $value )
			$response = $response->withHeader ( $key, $value );

		return $response;
    }
	
	function ok ( int $appStatus, $content ) : responseInterface
	{
		return $this->respond ( 200, $appStatus, $content );
	}

	function created ( int $appStatus, $content ) : responseInterface
	{
		return $this->respond ( 201, $appStatus, $content );
	}

	function conflict ( int $appStatus, $content ) : responseInterface
	{
		return $this->respond ( 409, $appStatus, $content );
	}

	function unauthorized ( int $appStatus, $content = '' ) : responseInterface
	{
		return $this->respond ( 401, $appStatus, $content );
	}

	protected function respond ( int $status, int $appStatus, $content ) : responseInterface
	{
		$class = $this->response;
		$response = new $class ( $content, $status, $this->headers );
		return $response->withHeader ( 'X-Firestark-Status', $appStatus );
	}
}