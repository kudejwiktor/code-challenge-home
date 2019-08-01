<?php


namespace Home\LocationService\Application\Location\Commands;


use Home\LocationService\Application\Command;

class DeleteLocationCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}