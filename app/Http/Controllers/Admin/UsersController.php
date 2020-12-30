<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\LoginUsers;
use App\Models\User;
use App\Repositories\Contracts\DbUsersRepositoryInterface;
use Brackets\AdminListing\AdminListing;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{
    /**
     * @var DbUsersRepositoryInterface
     */
    private $dbUserRepository;

    /**
     * UsersController constructor.
     * @param DbUsersRepositoryInterface $dbUserRepository
     */
    public function __construct(
        DbUsersRepositoryInterface $dbUserRepository
    ) {
        $this->dbUserRepository = $dbUserRepository;
    }

    /**
     * @param LoginUsers $request
     * @return array|Application|RedirectResponse|Redirector
     */
    public function __invoke(LoginUsers $request)
    {
        $password = md5($request['password']);
        $user = $this->dbUserRepository->findUserByEmailAndPassword($request['email'], $password);

        if (!count($user)) {
            return redirect('admin/login');
        }

        /* @var User $user */
        $user = $user[0];
        Session::put('user', $user);
        $this->dbUserRepository->updateLastLogin($user->id, now());

        if ($user->role == User::ADMIN_ROLE) {
            return redirect('admin/user-production');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return array|Application|RedirectResponse|Redirector
     */
    public function validateSession(Request $request)
    {
        $user = Session::get('user');

        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            return redirect('admin/user-production');
        }

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/login'),
                'message' => 'session not exist'
            ];
        } else {
            return redirect('admin/login');
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Session::remove('user');
        return redirect('/admin/user-session');
    }

    /**
     * @param Request $request
     * @return array|Factory|Application|RedirectResponse|Redirector|\Illuminate\View\View
     */
    public function production(Request $request)
    {
        $user = Session::get('user');
        $data = AdminListing::create(User::class)
            ->processRequestAndGet(
                $request,
                ['id', 'email', 'phone', 'status', 'last_logged_in'],
                ['id', 'email', 'phone', 'status', 'last_logged_in']
            );

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => $user->role, 'url' => ''];
        }

        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            return view('admin.users.production', [
                'activation' => $user->role,
                'data' => $data,
                'url' => ''
            ]);
        } else {
            return redirect('/admin/user-session');
        }
    }
}
