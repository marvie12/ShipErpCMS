<?php

class UsersController extends BaseController
{
    public $roles = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * User management landing page
     * @return string   This template
     */
    public function index()
    {
        $usersEO = new User;

        $sortCols = array(
            'id' => 'id',
            'username' => 'username',
            'name' => 'name',
            'email' => 'email',
            'date' => 'created_at'
        );

        $sort = Input::get('asc', 0);
        $sort = $sort ? 'ASC' : 'DESC';

        $sortBy = Input::get('sort', 'id');

        $search = Input::get('search');

        $data['noRecord'] = 'No Record';

        if (isset($search)) {
            $usersEO = $usersEO->where('name', 'like', '%'.Input::get('search').'%')
                ->orWhere('username', 'like', '%'.Input::get('search').'%')
                ->orWhere('email', 'like', '%'.Input::get('search').'%');

            $data['noRecord'] = 'No users found. Change your search parameters and try submitting again.';
        }

        $usersEO = $usersEO->orderBy($sortCols[$sortBy], $sort)->paginate(10)->appends(Input::except('page'));

        if (!$usersEO->isEmpty()) {
            foreach ($usersEO as $key => $userEO) {

                $data['users'][] = array(
                    'id'         => $userEO->getId(),
                    'username'   => $userEO->getUsername(),
                    'name'       => $userEO->getName(),
                    'email'      => $userEO->getEmail(),
                    'created_at' => $userEO->getCreatedAt(),
                );
            }

            $data['pagi'] = $usersEO->links();
        } else {
            $data['users'] = array();
        }

        $this->layout->content = view('users.index', $data);
    }

    /**
     * Add user landing page
     */
    public function add()
    {        
        $data['accessToken'] = str_random(50);
        $this->layout->content = view('users.add', $data);
    }

    /**
     * Edit user landing page
     * @param  integer $id id
     * @return string      redirect to users landing
     */
    public function edit($id)
    {
        $userEO = User::find($id);

        if ($userEO) {
            $data['id']          = $userEO->getId();
            $data['username']    = $userEO->getUsername();
            $data['name']        = $userEO->getName();
            $data['email']       = $userEO->getEmail();
            $data['password']    = $userEO->password;
            $data['accessToken'] = ($userEO->getAccessToken() != "") ? $userEO->getAccessToken() : str_random(50);

            $this->layout->content = view('users.edit', $data);
        } else {
            return Redirect::to('users');
        }
    }

    /**
     * Process of adding and editing users
     * @return string   redirect to add or edit users
     */
    public function process()
    {
        $validateRegister = Validator::make(Input::all(), [ 'username' => 'required' ]);

        $message = '';
        // dd(Input::get('owner'));
        $id = Input::get('id', 0);

        if (!$validateRegister->fails()) {
            if ($id) {
                $user = User::find($id);

                if ($user) {

                    if($user->username != Input::get('username') && User::where('username', '=', Input::get('username'))->count() > 0){
                      return Redirect::back()->with(['message'=>'The username has already been taken.', 'class'=>'alert'])->withInput();
                    }

                    if(Input::has('password')){
                        if(Auth::user()->id == $user->id){
                            if(!Hash::check(Input::get('old_password'), $user->password)){
                                return Redirect::back()->with(['message'=>'Incorrect old password.', 'class'=>'alert'])->withInput();
                            }
                        }

                        $user->setPassword(Hash::make(Input::get('password')));
                    }

                    $user->setUsername(Input::get('username'));
                    $user->setName(Input::get('name'));
                    $user->setEmail(Input::get('email'));
                    $user->setAccessToken(Input::get('access_token'));
                    $user->setUpdatedAt(time());

                    $user->save();

                    $message = Input::get('username').' successfully edited.';

                } else {
                    $message = 'Error: user cannot be edited.';
                }
            } else {
                if(User::where('username', '=', Input::get('username'))->count() > 0 ){
                  return Redirect::back()->with(['message' => 'The username has already been taken.', 'class' => 'alert'])->withInput();
                }

                $user = new User();
                $user->setUsername(Input::get('username'));
                $user->setPassword(Hash::make(Input::get('password')));
                $user->setName(Input::get('name'));
                $user->setEmail(Input::get('email'));
                $user->setCreatedAt(time());
                $user->setAccessToken(Input::get('access_token'));
                $user->save();

                $message = Input::get('username').' successfully added.';
                return Redirect::to('users')->with('message', $message);
            }

            return Redirect::to('users/edit/'.$id)->with('message', $message);
        } else {
            return Redirect::to('users/add')
                ->withErrors($validateRegister)
                ->withInput();
        }
    }

    /**
     * Delete user
     * @return bool return 1 or 0
     */
    public function delete()
    {
        $user = User::find(Input::get('id'));

        if ($user) {
            $user->delete();
            return '1';
        } else {
            return '0';
        }
    }

}
