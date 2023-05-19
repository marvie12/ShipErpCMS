<?php

class ProviderController extends BaseController
{
    public $errMsg = 'The `Provider Name` you entered is already in use';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Provider Landing Page
     * @return string   The template
     */
    public function index()
    {
        $provider = new BaseProvider();
        
        $data['noRecord'] = 'No Record.';

        if (Input::get('search')) {
            $provider = $provider->where('name', 'like', '%'.Input::get('search').'%');
            $data['noRecord'] = 'No users found. Change your search parameters and try submitting again.';
        }

        $sortCols = array(
            'id' => 'provider_id',
            'name' => 'name'
        );

        $sort = Input::get('asc', 0);
        $sort = $sort ? 'ASC' : 'DESC';

        $sortBy = Input::get('sort', '');
        if(isset($sortCols[$sortBy])){
            $provider = $provider->orderBy($sortCols[$sortBy], $sort);
        }

        $providerList = $provider->paginate(10)->appends(Input::except('page'));

        if (!$providerList->isEmpty()) {
            foreach ($providerList as $providerInfo) {
                $providerData['provider'][] = array(
                    'id'         => $providerInfo->getId(),
                    'name'       => $providerInfo->getName(),
                    'url'      => $providerInfo->getURL()
                );
            }
            $providerData['pagi'] = $providerList->links();
        } else {
            $providerData['provider'] = array();
        }

        $this->layout->content = view('provider.index', $providerData);
    }

    /**
     * Add Provider landing page
     */
    public function add()
    {
        $this->layout->content = view('provider.add', $data);
    }

    /**
     * Edit Provider landing page
     * @param  integer $id provider_id
     * @return string      redirect to Provider landing
     */
    public function edit($id)
    {
        $provider = BaseProvider::find($id);

        if ($provider) {
            $providerInfo['id']     = $provider->getId();
            $providerInfo['name']   = $provider->getName();
            $providerInfo['url']    = $provider->getURL();
           
            $this->layout->content = view('provider.edit', $providerInfo);
        } else {
            return Redirect::to('provider');
        }
    }

    /**
     * Process of adding and editing Provider
     * @return string   redirect to add or edit Provider
     */
    public function process()
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $validateRegister = Validator::make(Input::all(), [ 'name' => 'required', 'url' => 'required|url|regex:'.$regex ]);

        $message = '';
        $id = Input::get('id', 0);
        $inputName = Input::get('name');
        $inputURL = Input::get('url');

        if (!$validateRegister->fails()) {
            if ($id) {
                $provider = BaseProvider::find($id);

                if ($provider) {
                    if($provider->name != $inputName && BaseProvider::where('name', '=', $inputName)->count() > 0){
                      return Redirect::back()->with(['message'=>$this->errMsg, 'class'=>'alert'])->withInput();
                    }

                    $message = $inputName.' successfully edited.';

                } else {
                    $message = 'Error: user cannot be edited.';
                }
            } else {
                if(User::where('name', '=', $inputName)->count() > 0 ){
                  return Redirect::back()->with(['message' => $this->errMsg, 'class' => 'alert'])->withInput();
                }

                $provider = new BaseProvider();
                $message = $inputName.' successfully added.';
            }
            
            $provider->setName($inputName);
            $provider->setURL($inputURL);
            $provider->save();

            
            if (!$id)
                $redirectTo = 'provider';
            else
                $redirectTo = 'provider/edit/'.$id;

            return Redirect::to($redirectTo)->with('message', $message);
        } else {
            if (!$id)
                $redirectTo = 'provider/add';
            else
                $redirectTo = 'provider/edit/'.$id;

            return Redirect::to($redirectTo)
                ->withErrors($validateRegister)
                ->withInput();
        }
    }

    /**
     * Delete Provider
     * @return bool return 1 or 0
     */
    public function delete()
    {
        $provider = BaseProvider::find(Input::get('id'));

        if ($provider) {
            $provider->delete();
            return '1';
        } else {
            return '0';
        }
    }
}
