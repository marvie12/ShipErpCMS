<?php 

class UserHelper extends BaseHelper{

	/**
	 * Get user's username
	 * @param  string $id id
	 * @return string     username or blank
	 */
	public function getUserName($id){
		$currentuser = User::find($id);

		if($currentuser){
			return $currentuser->getUsername();
		} else {
			return '';
		}

	}

	/**
	 * Get user's name
	 * @param  string $id id
	 * @return string     username or blank
	 */
	public function getName($id){
		$currentuser = User::find($id);

		if($currentuser){
			return $currentuser->getName();
		} else {
			return '';
		}

	}

}
