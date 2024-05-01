<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\GlobalTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use GlobalTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            try {
                $user = User::findOrFail(Auth::user()->id);

                $image = $request->file('avatar');
                $user_name = explode('@', $request->user()->email)[0] . '_' . $user->id;
                $imageName = "{$user_name}.{$image->getClientOriginalExtension()}";
                $avatar_link = $this->getImagesDir() . 'profile/' . $imageName;
                $image->move($this->getImagesDir() . 'profile/', $imageName);
                // delete previous avatar in situations where the new one has different file extension
                if (file_exists($user->avatar)) {
                    Log::info('found image file and about to delete:::' . $user->avatar);
                    unlink($user->avatar);
                } else {
                    Log::info('could not find image file and cannot delete:::' . $user->avatar);
                }
                $user->avatar = $avatar_link;
            } catch (Exception $e) {
                Log::error('Error saving avatar:' . $e->getMessage());
            }
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'profile updated',
            'data' => $user,
        ]);

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
