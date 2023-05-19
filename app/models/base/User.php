<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'adminusers';
	protected $primaryKey = 'id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	protected $guarded = [];



	public function getId(){
		return $this->attributes['id'];
	}

	public function setId($value){
		$this->attributes['id'] = $value;
	}

	public function getUsername(){
		return $this->attributes['username'];
	}

	public function setUsername($value){
		$this->attributes['username'] = $value;
	}

	public function getPassword(){
		return $this->attributes['password'];
	}

	public function setPassword($value){
		$this->attributes['password'] = $value;
	}

	public function getName(){
		return $this->attributes['name'];
	}

	public function setName($value){
		$this->attributes['name'] = $value;
	}

    public function getUserLevel(){
        return $this->attributes['userlevel'];
    }

    public function setUserLevel($value){
        $this->attributes['userlevel'] = $value;
    }

	public function getEmail(){
		return $this->attributes['email'];
	}

	public function setEmail($value){
		$this->attributes['email'] = $value;
	}

	public function getAccessToken(){
		return $this->attributes['access_token'];
	}

	public function setAccessToken($value){
		$this->attributes['access_token'] = $value;
	}

	public function getSite(){
		return $this->attributes['site'];
	}

	public function setSite($value){
		$this->attributes['site'] = $value;
	}

	public function getCreatedAt(){
		return $this->attributes['created_at'];
	}

	public function setCreatedAt($value){
		$this->attributes['created_at'] = $value;
	}

	public function getUpdatedAt(){
		return $this->attributes['updated_at'];
	}

	public function setUpdatedAt($value){
		$this->attributes['updated_at'] = $value;
	}

}
