<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravolt\Avatar\Facade as Avatar;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        /* $this->get_countries_list();
        return redirect()->back(); */

        $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:25'],
            'last_name' => ['required', 'string', 'min:2', 'max:25'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'string', 'min:2', 'max:25', Rule::in($this->get_countries_list())],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // handle generation of avatar for new user
        try {
            $image_name = explode('@', $user->email)[0] . '_' . $user->id . '.png';
            $avatar_uri = 'images/profile/' . $image_name;
            Avatar::create($user->first_name . ' ' . $user->last_name)->save($avatar_uri, 100);
            $user->avatar = $avatar_uri;
            $user->save();
        } catch (Exception $e) {
            Log::error('User avatar generation error.::' . $e->getMessage());
        }
        return redirect(route('user-area', absolute: false));
    }
    /**
     * get_countries_list
     * @return array[]
     */
    public function get_countries_list()
    {
        if (!Country::first()) {
            try {
                $curl = curl_init();
                // set if it is a get request by checking for ? in the url

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.beezlinq.com/api/v1/get/countries',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                    ),
                ));
                $response = curl_exec($curl);

                curl_close($curl);
                $data = ['status' => 'success'];
                $response_data = [];
                Log::info($response);
                if (is_array(json_decode($response, true))) {
                    $response_data = json_decode($response, true);
                    // save countries to db
                    foreach ($response_data['data'] as $country) {
                        Country::create([
                            'name' => $country['name'],
                            'short_name' => $country['iso3'],
                            'phone_code' => $country['phonecode'],
                            'flag' => $country['flag']
                        ]);
                    }
                    $countries = array_map(function ($c) {
                        return $c['name'];
                    }, $response_data['data']);
                    return $countries;
                }
                return $response_data;
            } catch (Exception $e) {
                Log::info($e);
                return ['status' => 'error', 'code' => '111', 'message' => 'Server api call failed.'];
            }
        }
        // countries already in db
        return
            array_map(function ($c) {
                return $c['name'];
            }, Country::get()->toArray());
    }
}
