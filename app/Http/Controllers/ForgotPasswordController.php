<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No account found with that email.']);
        }

        DB::table('password_resets')->where('email', $request->email)->delete();

        $token = Password::broker()->createToken($user);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            'expires_at' => Carbon::now()->addMinutes(30),
        ]);

        $link = route('password.reset', ['token' => $token, 'email' => urlencode($request->email)]);

        Mail::send('emails.reset', ['link' => $link], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset Request');
        });

        return back()->with('status', 'Password reset link sent!');
    }

    public function showResetForm($token, Request $request)
{
    $email = $request->query('email');

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $email,
    ]);
}
public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();


        if (!$resetRecord || Carbon::now()->greaterThan(Carbon::parse($resetRecord->expires_at))) {
            return back()->withErrors(['token' => 'The reset token has expired. Please request a new one.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        DB::table('password_resets')->where('token', $request->token)->delete();

        return $status === Password::PASSWORD_RESET
            ? redirect('login')->with('status', 'Your password has been reset!')
            : back()->withErrors(['email' => [__($status)]]);
    }

}
