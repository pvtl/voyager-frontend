<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class AccountController extends BaseController
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
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

        return view('voyager-frontend::modules/auth/account', ['user' => $user]);
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

        if ($request->input('password') !== null) {
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

    /**
     * Impersonate a user as an administrator
     *
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonateUser($userId)
    {
        if (Session::has('original_user.id') && $userId == Session::get('original_user.id')) {
            // Login as the original user and destroy session
            Session::forget('original_user.name');
            Auth::loginUsingId(Session::pull('original_user.id'));

            return redirect()->route('voyager.users.index');
        } else {
            // Store our current 'admin' id to switch back to
            Session::put('original_user.name', Auth::user()->name);
            Session::put('original_user.id', Auth::id());

            // Impersonate the requested user
            Auth::loginUsingId($userId);

            return redirect()->route('voyager-frontend.account');
        }
    }
}
