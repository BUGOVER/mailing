<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\Mailing\AddUserRequest;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use MailchimpMarketing\ApiClient;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthenticatesUsers;
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @var string
     */
    protected $redirectTo = 'mailings';

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return view('mailing');
        }

        return $this->showLoginForm();
    }

    /**
     * Show the application's login form.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function mailingIndex()
    {
        return view('mailing');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     */
    public function login(Request $request)
    {
        $admin = Admin::where('email', '=', $request->email)->first();

        if (!$admin) {
            return redirect()->back();
        }

        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->back();
        }

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password], true)) {
            return $this->sendLoginResponse($request);
        }

        Auth::setUser($admin);
        $this->incrementLoginAttempts($request);
        return redirect()->back();
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard((string)session('assigned_guard'));
    }

    /**
     * @param  AddUserRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function addUser(AddUserRequest $request)
    {
        if (!User::create($request->all())) {
            return response(['message' => 'Created Error'], 400);
        }

        return response(['message' => 'User added']);
    }
}
