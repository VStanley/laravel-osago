<?php

namespace App\Http\Controllers\Admin;

use App\Models\City_coefficient;
use App\Models\Regions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegionsCityCoefficients extends Controller
{
    public function index()
    {
        $region = Regions::all();
        return view('admin.regionsCoefficients.index', ['regions' => $region]);
    }

    /*
     *      добавление нового
     */
    public function store(Request $request)
    {
        if ($request->region == 'region'){

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required',
            ]);

            $region = ['region' => $request->location];

            Regions::create($region);
            $textMessage = 'записан новый регион ' . $request->location;
        } else {

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required',
                'auto' => 'required|numeric'
            ]);

            $city = [
                'regions_id' => $request->region,
                'location' => $request->location,
                'auto' => $request->auto,
                'tractor' => $request->tractor,
            ];

            City_coefficient::create($city);
            $textMessage = 'записан новый коэффициент';
        }

        $this->quickFlash($textMessage, 'success');
        return redirect('/dashboard/regionsCoefficients');
    }

    /*
     *      удаление
     */
    public function destroy(Request $request, $id)
    {
        if ($request->region == 'region'){

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required'
            ]);

            Regions::find($id)->delete();
            $textMessage = $request->location . ' удален';
        } else {

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required',
                'auto' => 'required|numeric'
            ]);

            City_coefficient::find($id)->delete();
            $textMessage = 'коэффициент удален';
        }

        $this->quickFlash($textMessage, 'success');
        return redirect('/dashboard/regionsCoefficients');
    }

    public function create()
    {
        echo 'create';
    }

    public function edit()
    {
        echo 'edit';
    }

    /*
     *      обновление
     */
    public function update(Request $request, $id)
    {
        if ($request->region == 'region'){

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required'
            ]);

            $region = Regions::find($id);

            $region->update(['region' => $request->location]);
            $textMessage = 'Регион ' . $request->location . ' обновлен' ;

        } else {

            $this->validate($request, [
                'region' => 'required',
                'location' => 'required',
                'auto' => 'required|numeric'
            ]);

            $city = [
                'regions_id' => $request->region,
                'location' => $request->location,
                'auto' => $request->auto,
                'tractor' => $request->tractor,
            ];

            $cityCoefficient = City_coefficient::find($id);

            $cityCoefficient->update($city);
            $textMessage = 'Локация ' . $request->location . ' обновлена' ;
        }

        $this->quickFlash($textMessage, 'success');
        return redirect('/dashboard/regionsCoefficients');
    }

    /**
     * Put flash messages into the session
     * --------------PARAMS---------------
     * Message: The flash message itself
     *    Type: info/success/alert/primary Any type that bootstrap supports.
     *          If you're not using bootstrap you can change this to your own
     *
     * @param        $message
     * @param string $type
     */
    public function quickFlash($message, $type = 'info')
    {
        if ($type == 'error') {
            $type = 'danger';
        }
        session()->flash('flash_message', [
            'message' => $message,
            'type'    => $type
        ]);
    }
    
}
