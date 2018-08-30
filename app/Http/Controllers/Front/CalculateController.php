<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CalculateRequest;
use App\Http\Controllers\Controller;
use App\Models\AutoCategories;
use App\Models\City_coefficient;
use App\Models\Regions;
use App\Models\SomePrices;

class CalculateController extends Controller
{
    public function index()
    {
        $autoCategories = AutoCategories::all();
        $regions = Regions::all();

        return view('front.calculator', [
            'autoCategories' => $autoCategories,
            'regions' => $regions
        ]);
    }

    public function calculate(CalculateRequest $request)
    {
        $price = $this->getPrice($request->all());

        $this->quickFlash($price, 'success');
        return redirect()->back();
    }

    public function getData()
    {
        $location = City_coefficient::where('regions_id', $_GET['region'])->get();

        return response($location);
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
            'type' => $type
        ]);
    }

    /*
     *      расчет цены страховки
     */
    private function getPrice($data)
    {
        //  тариф бызовый
        $TB = AutoCategories::where('id', $data['autoCategory'])->value('price');

        //  наценка на физическое лицо
        if ($data['person'] == 'individualPerson') {

            $extra = SomePrices::where('slug', $data['person'])->value('price');
            $TB = $TB + $extra;
        }

        //  коэфициент территориаольный
        $KT = City_coefficient::where('id', $data['location'])->value('auto');

        //  период использования у нас 1 год
        $KC = 1;

        //  коэф мощности
        $KM = $data['autoPower'];

        //  с ограничениями или без
        switch ($data['limit']) {

            //  без ограничений
            case ('noLimitsTime') :
                $KO = 1.8;

                //  коэф бонус-малус
                $KBM = $data['bonusSmall'];

                $price = $TB * $KT * $KC * $KM * $KO * $KBM;
                break;

            //  с ограничениями
            case('limitsTime') :
                $KO = 1;

                //  коэф водителя
                $KCB = $this->ageExperienceDriver($data['ageDriver'], $data['experienceDriver']);

                //  коэф бонус-малус
                $KBM = $data['bonusSmall'];

                //  если есть 2 водитель и КБМ больше
                if (isset($data['ageDriver1']) && ($data['bonusSmall1'] > $KBM)) {

                    $KCB = $this->ageExperienceDriver($data['ageDriver1'], $data['experienceDriver1']);
                    $KBM = $data['bonusSmall1'];
                }

                //  если есть 3 водитель и КБМ больше
                if (isset($data['ageDriver2']) && ($data['bonusSmall2'] > $KBM)) {

                    $KCB = $this->ageExperienceDriver($data['ageDriver2'], $data['experienceDriver2']);
                    $KBM = $data['bonusSmall2'];
                }

                $price = $TB * $KT * $KC * $KM * $KO * $KBM * $KCB;
                break;

            default :
                $price = 'блЭт';
                break;
        }

        //  если надо техосмотр то добавляем в цену
        if (isset($data['noDiagnostic'])) {

            $category = AutoCategories::where('id', $data['autoCategory'])->value('slug');

            switch ($category) {

                case 'carTaxy' :
                case 'car' : $diagnostic = SomePrices::where('slug', 'categoryB')->VALUE('price');
                    break;

                case 'moto' : $diagnostic = SomePrices::where('slug', 'categoryA')->VALUE('price');
                    break;

                case 'truck17' :
                case 'truck15' : $diagnostic = SomePrices::where('slug', 'categoryC')->VALUE('price');
                    break;

                case 'bus17' :
                case 'bus15' : $diagnostic = SomePrices::where('slug', 'categoryD')->VALUE('price');
                    break;

                default :
                    $diagnostic = 500;
                    break;
            }

            $price = $price + $diagnostic;
        }

        //  комиссия за оформление
        $extraPriceMain = SomePrices::where('slug', 'extraPriceMain')->value('price');
        $price = $price + $extraPriceMain;

        return round($price, 2);
    }

    //  коэф водителя
    private function ageExperienceDriver($ageDriver, $experienceDriver)
    {
        if ($ageDriver < 22) {

            if ($experienceDriver < 3) {

                $KCB = 1.8;
            } else {

                $KCB = 1.6;
            }
        } else {

            if ($experienceDriver < 3) {

                $KCB = 1.7;
            } else {

                $KCB = 1;
            }
        }

        return $KCB;
    }
}
