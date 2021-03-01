<?php

namespace Modules\Traveller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Traveller\Entities\Journey;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Sender\Entities\Order;
use Modules\Traveller\Entities\Traveller;
use Modules\Traveller\Notifications\NewJourneyTravellerNotification;
use Modules\Traveller\Notifications\NewJourneyAdminNotification;
use Modules\Admin\Entities\Admin;

class JourneyController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['journeys'] = Journey::where(['traveller_id'=>auth()->user()->id])->orderBy('id', 'desc')->paginate(FRONT_RECORD_PER_PAGE);
        return view('traveller::journey.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::get();
        return view('traveller::journey.create')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'departure_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'pickup_date' => 'required:date|after:yesterday',
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'required',
            'package_id' => 'required|exists:packages,id',
        ]);
        if(auth()->user()->user_type!='Traveller'){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'user' => ['Please login with traveller account.'],
            ]);
            throw $error;
        }
        $data = $request->all();
        $package = Package::find($request->package_id);
        $data['weight'] = $package->weight;
        $data['currency_symbol'] = $package->currency_symbol;
        $data['currency_code'] = $package->currency_code;
        $data['price'] = $package->traveller_price;
        $data['traveller_id'] = auth()->user()->id;
        $journey = Journey::create($data);
        // send notification to traveller and admin
        try{
            Traveller::find(auth()->user()->id)->notify(new NewJourneyTravellerNotification($journey));
            $admin = Admin::first();
            $journey->admin = $admin;
            $admin->notify(new NewJourneyAdminNotification($journey));
        }
        catch(\Exception $e){}
        
        return response()->json(['status'=>true, 'message'=>'Journey added successfully']);
        return redirect()->to(route('traveller.journey.complete'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('traveller::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('traveller::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function complete(){
        return view('traveller::journey.complete');
    }

    public function orders($id){
        $view['journey'] = Journey::find($id);
        return view('traveller::journey.orders')->with($view);
    }
}
