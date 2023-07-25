<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'street' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'state' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'zip_code' => ['string', 'max:255'],
        ]);

        Address::updateOrCreate(['user_id' => $request->user()->id], [
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
        ]);

        return Redirect::route('profile.edit')->with('status', 'address-updated');
    }
}
