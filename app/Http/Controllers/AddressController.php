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
            'street' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:255'],
        ]);

        Address::updateOrCreate(['user_id' => $request->user()->id], [
            'street' => ucwords($request->street ?? ''),
            'city' => ucwords($request->city ?? ''),
            'state' => ucwords($request->state ?? ''),
            'country' => ucwords($request->country ?? ''),
            'zip_code' => $request->zip_code ?? '',
        ]);

        return Redirect::to(route('profile.edit') . "#address")->with('status', 'address-updated');
    }
}
