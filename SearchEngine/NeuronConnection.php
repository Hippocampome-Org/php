<?php
/**
 * Created by Amar Gawade.
 * User: Gas10
 * Date: 1/25/17
 * Time: 4:51 PM
 * Version: 1.0.0
 */
class NeuronConnection
{
    private $sourceId;
    private $destinationId;
    private $sourceName;
    private $destinationName;


    public function create($sourceId, $destinationId, $sourceName, $destinationName)
    {
        $this->sourceId = $sourceId;
        $this->destinationId = $destinationId;
        $this->sourceName = $sourceName;
        $this->destinationName = $destinationName;
    }


    public function getSourceId()
    {
        return $this->sourceId;
    }


    public function setSourceId($sourceId)
    {
        $this->sourceId = $sourceId;
    }


    public function getDestinationId()
    {
        return $this->destinationId;
    }


    public function setDestinationId($destinationId)
    {
        $this->destinationId = $destinationId;
    }


    public function getSourceName()
    {
        return $this->sourceName;
    }


    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;
    }


    public function getDestinationName()
    {
        return $this->destinationName;
    }


    public function setDestinationName($destinationName)
    {
        $this->destinationName = $destinationName;
    }



}
?>