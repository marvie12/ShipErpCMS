<?php

class PermissionFilter{
	public function isUserCanAccess($route, $request){
		return;
		/*$page = Request::segment(1);
		$user = User::find(Auth::user()->getId());*/
	}

	public function isUserCanManageUsers($route, $request){
		$routeName   = $route->getName();
		$userEditId  = $route->getParameter('id');
		$user        = Auth::user();
		$userIsOwner = $user->hasRole('Owner');

		$pass = $userIsOwner;
		
		if(in_array($routeName, ['edit.user', 'process.user']) || $userEditId == $user->id){
			$pass = true;
		}

		if(!$pass) return 'Access denied';
	}

	public function isAbleToDo($route, $request)
	{
		$full_user_can_do = ['add','edit','process','delete'];

		if(in_array($request->segment(2), $full_user_can_do))
		{
			if(!Auth::user()->hasRole('Owner') && !Auth::user()->hasRole('Admin')){
				return 'Access denied';
			}
		}
	}
}