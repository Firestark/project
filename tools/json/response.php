<?php

namespace firestark\json;


class response extends \firestark\response
{
	protected $headers =
    [
        'Access-Control-Allow-Origin'       => '*',
        'Content-Type'                      => 'application/json',
        'Access-Control-Allow-Headers'      => 'Origin, Accept, Content-Type, Authorization, X-Requested-With, Content-Range, Content-Disposition',
        'X-Firestark-Status'                => 0
    ];

	private $unpreparedContent = null;

	public function __construct ( $content = '', int $status = 200, array $headers = [ ] )
	{
		$this->unpreparedContent = $content;
		$this->status = $status;

		$this->headers = array_merge ( $this->headers, $headers );
	}

    public function send ( )
    {
        $this->content = $this->prepare
            ( [ 'status' => $this->headers [ 'X-Firestark-Status' ], 'content' => $this->unpreparedContent ] );
        
        return parent::send ( );
    }

    protected function prepare ( $content ) : string
    {
        return json_encode ( $content, JSON_UNESCAPED_SLASHES );
    }
}
