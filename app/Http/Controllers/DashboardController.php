<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use App\Repositories\Interfaces\HealthRepositoryInterface;
use App\Repositories\Interfaces\BreedingRepositoryInterface;
use App\Repositories\Interfaces\CowRepositoryInterface;

class DashboardController extends Controller
{
    /**
     * @var MilkProductionRepositortInterface
     * @var HealthRepositoryInterface
     * @var BreedingRepositoryInterface
     * @var CowRepositoryInterface
     */
    protected $milkproductionRepository;
    protected $HealthRepository;
    protected $BreedingRepository;
    protected $CowRepository;
    /**
     * @var HealthRepositoryInterface
     */
    protected $HealthRepositoryInterface;

    /**
     * @var BreedingRepositoryInterface
     */
    protected $BreedingRepositoryInterface;

    /**
     * @var CowRepositoryInterface
     */
    protected $CowRepositoryInterface;

    /**
     *
     * @param HealthRepositoryInterface $HealthRepository
     * @param MilkProductionRepositortInterface $milkproductionRepository
     * @param BreedingRepositoryInterface $BreedingRepository
     * @param CowRepositoryInterface $CowRepository
     */

     public function __construct(
        MilkProductionRepositortInterface $milkproductionRepository,
        HealthRepositoryInterface $HealthRepository,
        BreedingRepositoryInterface $BreedingRepository,
        CowRepositoryInterface $CowRepository

    ) {
        $this->milkproductionRepository = $milkproductionRepository;
        $this->HealthRepository = $HealthRepository;
        $this->BreedingRepository = $BreedingRepository;
        $this->CowRepository = $CowRepository;
    }


    public function index(){
        $where = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $where_health_ai = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['highest_milk_producer'] = $this->milkproductionRepository->getHieghestmilkProducer($where);
        $data['lowest_milk_producer'] = $this->milkproductionRepository->getLowestmilkProducer($where);
        $data['total_milk_production_today'] = $this->milkproductionRepository->getTotalProductionofToday($where);
        $data['avg_milk_production'] = $this->milkproductionRepository->getAvgProduction($where);
        $data['total_milk_production'] = $this->milkproductionRepository->getTotalProduction($where);
        $data['highest_health_expense'] = $this->HealthRepository->getHieghestHealthExpense($where_health_ai);
        $data['highest_repeat_ai'] = $this->BreedingRepository->getHieghestRepeatAI($where_health_ai);
        $data['total_lactating_cows'] = $this->CowRepository->getLactatingCows($where);
        $data['total_drying_cows'] = $this->CowRepository->getDryingCows($where);
        $data['total_calf_cows'] = $this->CowRepository->getCalfCows($where);
        return view('components.dashboard', $data);
    }
}
