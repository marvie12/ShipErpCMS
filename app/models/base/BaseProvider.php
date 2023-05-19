<?php

class BaseProvider extends Eloquent
{
    protected $table = 'provider';
    protected $primaryKey = 'provider_id';
    public $timestamps = false;
    protected $fillable = array('name', 'url');

    /** id Field **/
    public function getId()
    {
        return $this->attributes['provider_id'];
    }

    public function setId($value)
    {
        $this->attributes['provider_id'] = $value;
    }

    /** title Field **/
    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($value)
    {
        $this->attributes['name'] = $value;
    }

    /** slug Field **/
    public function getURL()
    {
        return $this->attributes['url'];
    }

    public function setURL($value)
    {
        $this->attributes['url'] = $value;
    }
}
