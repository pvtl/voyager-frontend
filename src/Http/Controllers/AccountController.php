<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class AccountController extends BaseController
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];

        if ($data['password'] !== null) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Display a Account Information
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        return view('voyager-frontend::modules/auth/account', [ 'user' => $user ]);
    }

    /**
     * Update User Account
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($user->password !== null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        
        return redirect()
            ->route('voyager-frontend.account')
            ->with([
                'message' => __('Account Updated'),
                'alert-type' => 'success',
            ]);
    }
}
