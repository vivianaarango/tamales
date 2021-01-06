<?php
namespace App\Providers;

use App\Repositories\Contracts\DbAdminUsersRepositoryInterface;
use App\Repositories\Contracts\DbProductionRepositoryInterface;
use App\Repositories\Contracts\DbProductionTypeRepositoryInterface;
use App\Repositories\Contracts\DbUsersRepositoryInterface;
use App\Repositories\DbAdminUsersRepository;
use App\Repositories\DbProductionRepository;
use App\Repositories\DbProductionTypeRepository;
use App\Repositories\DbUsersRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var array
     */
    protected $classes = [
        DbUsersRepositoryInterface::class => DbUsersRepository::class,
        DbAdminUsersRepositoryInterface::class => DbAdminUsersRepository::class,
        DbProductionTypeRepositoryInterface::class => DbProductionTypeRepository::class,
        DbProductionRepositoryInterface::class => DbProductionRepository::class
    ];

    /**
     * Register the repositories
     */
    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array_keys($this->classes);
    }
}
