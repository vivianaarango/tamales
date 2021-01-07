<?php
namespace App\Http\Controllers\Admin;

use App\Exports\ProductionExport;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Production\IndexProduction;
use App\Models\Production;
use App\Models\ProductionType;
use App\Models\Type;
use App\Models\User;
use App\Repositories\Contracts\DbProductionRepositoryInterface;
use App\Repositories\Contracts\DbProductionTypeRepositoryInterface;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class ProductionController
 * @package App\Http\Controllers\Admin
 */
class ProductionController extends Controller
{
    /**
     * @var DbProductionRepositoryInterface
     */
    private $dbProductionRepository;

    /**
     * @var DbProductionTypeRepositoryInterface
     */
    private $dbProductionTypeRepository;

    /**
     * ProductionController constructor.
     * @param DbProductionRepositoryInterface $dbProductionRepository
     * @param DbProductionTypeRepositoryInterface $dbProductionTypeRepository
     */
    public function __construct(
        DbProductionRepositoryInterface $dbProductionRepository,
        DbProductionTypeRepositoryInterface $dbProductionTypeRepository
    ) {
        $this->dbProductionRepository = $dbProductionRepository;
        $this->dbProductionTypeRepository = $dbProductionTypeRepository;
    }

    /**
     * @param IndexProduction $request
     * @return array|Factory|Application|RedirectResponse|Redirector|View
     */
    public function list(IndexProduction $request)
    {
        $user = Session::get('user');

        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            /* @noinspection PhpUndefinedMethodInspection  */
            $data = AdminListing::create(Production::class)
                ->modifyQuery(function($query) {
                    $query->orderBy('id', 'desc');
                })->processRequestAndGet(
                    $request,
                    ['id', 'lot', 'marmitas', 'broken', 'total', 'date'],
                    ['id', 'lot', 'marmitas', 'broken', 'total', 'date']
                );

            if ($request->ajax()) {
                return ['data' => $data, 'activation' => $user->role];
            }

            return view('admin.production.index', [
                'data' => $data,
                'activation' => $user->role
            ]);
        } else {
            return redirect('/admin/user-session');
        }
    }

    /**
     * @return Factory|Application|RedirectResponse|View
     */
    public function create()
    {
        $user = Session::get('user');
        $types = Type::all();
        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            return view('admin.production.create', [
                'activation' => $user->role,
                'types' => $types
            ]);
        } else {
            return redirect('/admin/user-session');
        }
    }

    /**
     * @param Request $request
     * @return array|Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $user = Session::get('user');
        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            $data['date'] = $request['date'];
            $data['lot'] = $request['lot'];
            $data['marmitas'] = $request['marmitas'];
            $data['broken'] = $request['broken'];
            $data['created_by'] = $user->id;
            $production = Production::create($data);

            $types = Type::all();
            $total = 0;
            foreach ($types as $item) {
                $productionType['production_id'] = $production->id;
                $productionType['type_id'] = $item->id;
                $productionType['quantity'] = $request[$item->name];
                ProductionType::create($productionType);
                $total = $total + $productionType['quantity'];
            }

            $production->total = $total + $request['broken'];
            $production->save();
        }

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/production-list'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded')
            ];
        }

        return redirect('admin/production-list');
    }

    /**
     * @param Production $production
     * @return Response|Factory|Application|View
     */
    public function edit(Production $production)
    {
        $userAdmin = Session::get('user');

        if (isset($userAdmin) && ($userAdmin->role == User::ADMIN_ROLE)) {
            $production = $this->dbProductionRepository->findByID($production->id);
            $types = $this->dbProductionTypeRepository->findByProductionID($production->id);

            return view('admin.production.edit', [
                'activation' => $userAdmin->role,
                'production' => $production,
                'types' => $types,
                'url' => $production->resource_url,
            ]);

        } else {
            return redirect('/admin/user-session');
        }
    }

    /**
     * @param Request $request
     * @return array|Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        $adminUser = Session::get('user');

        if (isset($adminUser) && ($adminUser->role == User::ADMIN_ROLE)) {
            $types = Type::all();
            $total = 0;
            foreach ($types as $item) {
                $productionType = $this->dbProductionTypeRepository->findByProductionIDAndTypeID(
                    $request['production_id'],
                    $item->id
                )->first();

                $productionType['quantity'] = $request[$item->name];
                $productionType->save();
                $total = $total + $productionType['quantity'];
            }

            $production = $this->dbProductionRepository->findByID($request['production_id']);
            $production->broken = $request['broken'];
            $production->total = $total + $request['broken'];
            $production->save();

            return redirect('admin/production-list');
        }
        return redirect('admin/user-session');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $date = now();
        return Excel::download(new ProductionExport, 'producción-'.$date.'.xlsx');
    }

    /**
     * @return Factory|Application|RedirectResponse|View
     */
    public function productionTypes()
    {
        $user = Session::get('user');

        if (isset($user) && $user->role == User::ADMIN_ROLE) {
            return view('admin.production.report-types', [
                'activation' => $user->role
            ]);
        } else {
            return redirect('/admin/user-session');
        }
    }
}
