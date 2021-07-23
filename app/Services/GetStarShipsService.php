<?php
namespace App\Services;

use App\SWApi;
use Illuminate\Support\Collection;

class GetStarShipsService
{
    protected int $numberOfPassengers;
    protected Object $apiContext;
    protected array $pilotsMap = [];

    public function __construct(int $numberOfPassengers)
    {
        $this->apiContext = new SWApi;

        $this->numberOfPassengers = $numberOfPassengers;
    }

    public function call() : Collection
    {
        $this->getEntities('people')
            ->map(function($pilot) {
                $this->pilotsMap[$pilot['url']] = $pilot;
            });

        return $this->getEntities('starships')
            ->filter(function ($starShip) {
                return $this->isValidStarShip($starShip);
            })
            ->map(function ($starShip) {
                $starShip['pilots'] = array_map(function ($pilotUrl) {
                    return $this->pilotsMap[$pilotUrl];
                }, $starShip['pilots']);

                return $starShip;
            });
    }

    protected function getEntities(string $entityName) : Collection
    {
        $result = collect();

        $page = 1;
        do {
            $apiResult = $this->apiContext->get($entityName, [
                'page' => $page++
            ]);

            $result = $result->merge($apiResult['results'] ?? collect());
        } while(($apiResult['count'] ?? 0) > 0);

        return $result;
    }

    protected function isValidStarShip(array $starShip) : bool
    {
        if (! is_array($starShip['pilots']) || empty($starShip['pilots'])) {
            return false;
        }

        return intval(str_replace(",", "", $starShip['passengers'])) > $this->numberOfPassengers;
    }
}