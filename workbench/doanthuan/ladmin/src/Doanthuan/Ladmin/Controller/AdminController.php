<?php
namespace Doanthuan\Ladmin\Controller;

use \Illuminate\Support\Str as Str;

use Controller, View, Config, Session, Input, Redirect, Lang, Request, Route;

use \Doanthuan\Ladmin\Html\Toolbar;
use \Doanthuan\Ladmin\Helper\Data;

class AdminController extends AdminBaseController {

    protected $name;

    protected $viewKey;

    protected $model;

    protected $objectUrl;

    protected $createUrl;

    protected $editUrl;

    protected $storeUrl;

    protected $deleteUrl;

    protected $request;

    public function __construct()
    {
        parent::__construct();

        $route = Route::current();

        \Doanthuan\Ladmin\Helper::setSegments($route);

        if(!isset($this->name)){
            $controller = Session::get('current_controller');
            if(strpos($controller, 'Admin') !== false){
                $controller = substr($controller, strlen('Admin'));
            }

            $this->name = $controller;
        }

        //set view key
        if(!isset($this->viewKey))
        {
            $this->viewKey = Data::camel2dashed($this->name);
        }

        $this->setHandyUrls();
        $this->shareHandyUrls();

        $this->resetGridFilters();
    }


    /**
     * Set the URL's to be used in the views
     * @return void
     */
    private function setHandyUrls()
    {
        $this->objectUrl = url('admin/'.$this->viewKey);

        if( is_null( $this->createUrl ) )
            $this->createUrl = $this->objectUrl.'/create';

        if( is_null( $this->editUrl ) )
            $this->editUrl = $this->objectUrl.'/edit';

        if( is_null( $this->storeUrl ) )
            $this->storeUrl = $this->objectUrl.'/edit';

        if( is_null( $this->deleteUrl ) )
            $this->deleteUrl = $this->objectUrl.'/delete';
    }

    /**
     * Set the view to have variables detailing some of the key URL's used in the views
     * Trying to keep views generic...
     * @return void
     */
    private function shareHandyUrls()
    {
        // Share these variables with any views
        view()->share('objectUrl', $this->objectUrl);
        view()->share('createUrl', $this->createUrl);
        view()->share('editUrl', $this->editUrl);
        view()->share('storeUrl', $this->storeUrl);
        view()->share('deleteUrl', $this->deleteUrl);

        Session::put('editUrl', $this->editUrl);
    }

    private function resetGridFilters()
    {
        //reset grid filters when switch controllers
        $currentController = Session::get('current_controller');
        $prevController = Session::get('prev_controller');
        if(isset($prevController) && $prevController != $currentController)
        {
            Session::forget('grid_filters');
        }
    }


    public function anyIndex()
    {
        $title = trans('Manage '.Str::plural($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE)) ;

        return view('admin.'.$this->viewKey.'.index');
    }

    public function getCreate()
    {
        $title = trans('New '.ucfirst($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model;
        $data['item'] = $item;

        return view('admin.'.$this->viewKey.'.edit', $data);
    }

    public function getEdit()
    {
        $title = trans('Edit '.ucfirst($this->name));
        Toolbar::title($title);
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = $this->model->find(Input::get('id'));
        if(is_null($item))
        {
            throw new \Exception('Could not find record');
        }
        $data['item'] = $item;

        return view('admin.'.$this->viewKey.'.edit', $data);
    }

    public function postEdit()
    {
        $input = Input::all();

        //store item to db
        $item = $this->model;
        if(!$item->validate($input))
        {
            return Redirect::back()->withErrors($item->getErrors())->withInput();
        }
        $item->setData($input);
        $item->save();

        return Redirect::to($this->objectUrl)->with('success', trans(ucfirst($this->viewKey).' Saved').'!');
    }

    public function setFilter()
    {
        $input = Request::all();
        Session::put('grid_filters', $input);

        return Redirect::back();
    }

    public function resetFilter()
    {
        Session::forget('grid_filters');
        return Redirect::back();
    }

    public function delete()
    {
        $cid = Input::get('cid');
        if (empty($cid)){
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

//        $items = $this->model->find($cid);
//        foreach($items as $item)
//        {
//            if (!$item->delete())
//            {
//                return Redirect::back()->withErrors(trans('Error delete '.Str::plural($this->viewKey)));
//            }
//        }
        $this->model->destroy($cid);

        return Redirect::back()->with('success', trans(ucfirst(Str::plural($this->viewKey)).'(s) deleted').'!');
    }

    public function publish()
    {
        // Get items to publish from the request.
        $cid = Input::get('cid');
        $value = Input::get('params');
        if (empty($cid))
        {
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }
        list($value, $col) = explode(":", $value);
        if(!$col){
            $col = 'status';
        }

        // Publish the items.
        if (!$this->model->publish($cid, $value, $col))
        {
            return Redirect::back()->withErrors(trans('Error publish '.Str::plural($this->viewKey)));
        }

        return Redirect::to($this->objectUrl);
    }

    public function saveSortOrder()
    {
        // Get the input
        $pks = Input::get('cid');
        $order = Input::get('order');

        if(empty($pks))
        {
            return Redirect::back()->withErrors(trans('No '.$this->viewKey.' selected'));
        }

        // Sanitize the input
        Data::toInteger($pks);
        Data::toInteger($order);

        // Save the sort_order
        $return = $this->model->saveorder($pks, $order);
        if ($return === false)
        {
            return Redirect::to($this->objectUrl)->with('success', trans('Reorder Failed'));
        }
        else
        {
            return Redirect::to($this->objectUrl)->with('success', trans('Reorder Success'));
        }
    }

}