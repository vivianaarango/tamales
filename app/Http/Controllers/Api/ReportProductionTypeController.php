<?php
namespace App\Http\Controllers\Api;

use App\Http\Transformers\ReporProductionTypesTransformer;
use App\Libraries\Responders\Contracts\ArrayResponseInterface;
use App\Libraries\Responders\ErrorObject;
use App\Libraries\Responders\HttpObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;
use Illuminate\Http\Request;

/**
 * Class ReportTicketsController
 * @package App\Http\Controllers\Api
 */
class ReportProductionTypeController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var HttpObject
     */
    private $httpObject;

    /**
     * @var ErrorObject
     */
    private $errorObject;

    /**
     * @var ArrayResponseInterface
     */
    private $arrayResponse;

    /**
     * ReportNewUsersByRoleController constructor.
     * @param LoggerInterface $logger
     * @param ArrayResponseInterface $arrayResponse
     * @param HttpObject $httpObject
     * @param ErrorObject $errorObject
     */
    public function __construct(
        LoggerInterface $logger,
        ArrayResponseInterface $arrayResponse,
        HttpObject $httpObject,
        ErrorObject $errorObject
    ) {
        $this->logger = $logger;
        $this->arrayResponse = $arrayResponse;
        $this->httpObject = $httpObject;
        $this->errorObject = $errorObject;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = DB::select(
            "SELECT
                    production_types.type_id, types.name,
                    SUM(production_types.quantity) as quantity
                    FROM production_types
                    INNER JOIN types ON types.id = production_types.type_id
                    GROUP BY production_types.type_id, types.name"
        );

        $this->httpObject->setCollection($data);

        return $this->arrayResponse->respondWithCollection(
            $this->httpObject,
            new ReporProductionTypesTransformer(),
            'data'
        );
    }
}
