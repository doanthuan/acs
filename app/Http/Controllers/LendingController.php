<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LendingController extends Controller{

    public function index()
    {
        return view('index');
    }

    public function getLend()
    {
        return view('lend');
    }

    public function getReturn()
    {
        return view('return');
    }

    public function postLending(\App\Http\Requests\StoreLendingDeviceRequest $request)
    {
        //another validation
        $deviceId = $request->input('DeviceId');
        $exists = \App\DeviceLending::where('DeviceId', $deviceId)->whereRaw('EndDate IS NOT NULL')->exists();
        if($exists){
            return \Redirect::back()->withErrors(array('DeviceId' => trans('Device is lending by other Employee')))->withInput();
        }

        $data = $request->all();
        $data['StartDate'] = date('Y-m-d H:i:s');
        \App\DeviceLending::create($data);

        return \Redirect::back()->with('success', trans('Your request is successful').'!');;
    }

    public function postReturn(Request $request)
    {
        $this->validate($request, [
            'RetDeviceId' => 'required|exists:Devices,Id',
        ]);

        $deviceId = $request->input('RetDeviceId');
        $exists = \App\DeviceLending::where('DeviceId', $deviceId)->whereRaw('EndDate IS NOT NULL')->exists();
        if(!$exists){
            return \Redirect::back()->withErrors(array('RetDeviceId' => trans('Device is not lending by any Employee')))->withInput();
        }

        $deviceLending = \App\DeviceLending::find($deviceId);
        $deviceLending->EndDate = date('Y-m-d H:i:s');
        $deviceLending->save();

        return \Redirect::back()->with('success', trans('Your request is successful').'!');
    }

}
