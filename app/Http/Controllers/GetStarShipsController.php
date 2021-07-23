<?php

namespace App\Http\Controllers;

use App\Services\GetStarShipsService;
use Illuminate\Support\Facades\Validator;

class GetStarShipsController extends Controller
{
    public function showForm()
    {
        return view('star_ships.form');
    }

    public function showList()
    {
        $validator = Validator::make($data = request()->all(), [
            'number_of_passengers' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->data['starShips'] = (new GetStarShipsService($data['number_of_passengers']))->call();

        return view('star_ships.list', $this->data);
    }
}
