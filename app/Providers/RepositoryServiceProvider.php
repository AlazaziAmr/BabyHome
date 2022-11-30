<?php

namespace App\Providers;

use App\Repositories\Classes\Api\Generals\NationalityRepository;
use App\Repositories\Classes\Api\Inspector\NurseryEvaluationRepository;
use App\Repositories\Classes\Api\Master\BookingRequestRepository;
use App\Repositories\Classes\Api\Master\ChildAlertRepository;
use App\Repositories\Classes\Api\Master\ChildAllergyRepository;
use App\Repositories\Classes\Api\Master\ChildPhoneRepository;
use App\Repositories\Classes\Api\Master\ChildSicknessRepository;
use App\Repositories\Classes\Api\Master\MasterJoinRequestRepository;
use App\Repositories\Classes\Api\Nurseries\BookingNurseryRepository;
use App\Repositories\Classes\Api\Nurseries\Profile\BabysitterQulificationRepository;
use App\Repositories\Classes\Api\Nurseries\Profile\BabySitterRepository;
use App\Repositories\Classes\Api\Nurseries\Profile\BabySitterSkillsRepository;
use App\Repositories\Classes\Api\Nurseries\Profile\NurseryAmenityRepository;
use App\Repositories\Classes\Api\Nurseries\Profile\NurseryServiceRepository;
use App\Repositories\Classes\Api\Payment\PaymentRepository;
use App\Repositories\Interfaces\Api\Generals\INationalityRepository;
use App\Repositories\Interfaces\Api\Inspector\INurseryEvaluationRepository;
use App\Repositories\Interfaces\Api\Master\IChildAlertRepository;
use App\Repositories\Interfaces\Api\Master\IChildAllergyRepository;
use App\Repositories\Interfaces\Api\Master\IChildPhoneRepository;
use App\Repositories\Interfaces\Api\Master\IChildSicknessRepository;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQulificationRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterSkillsRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryAmenityRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryServiceRepository;
use App\Repositories\Interfaces\Api\Payment\IPaymentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Classes\Api\Admin\RoleRepository;
use App\Repositories\Classes\Api\Users\UserRepository;
use App\Repositories\Classes\Api\Admin\AdminRepository;
use App\Repositories\Classes\Api\Generals\DayRepository;
use App\Repositories\Classes\Api\Generals\BankRepository;
use App\Repositories\Classes\Api\Generals\CityRepository;
use App\Repositories\Classes\Api\Master\MasterRepository;
use App\Repositories\Interfaces\Api\Admin\IRoleRepository;
use App\Repositories\Interfaces\Api\Users\IUserRepository;
use App\Repositories\Classes\Api\Generals\GenderRepository;
use App\Repositories\Classes\Api\Master\ChildrenRepository;
use App\Repositories\Interfaces\Api\Admin\IAdminRepository;
use App\Repositories\Classes\Api\Admin\InspectionRepository;
use App\Repositories\Classes\Api\Admin\RestoreRequestRepository;
use App\Repositories\Classes\Api\Generals\CountryRepository;
use App\Repositories\Interfaces\Api\Generals\IDayRepository;
use App\Repositories\Classes\Api\Generals\ActivityRepository;
use App\Repositories\Classes\Api\Generals\AmenityRepository;
use App\Repositories\Classes\Api\Generals\LanguageRepository;
use App\Repositories\Classes\Api\Generals\RelationRepository;
use App\Repositories\Classes\Api\Nurseries\NurseryRepository;
use App\Repositories\Interfaces\Api\Generals\IBankRepository;
use App\Repositories\Interfaces\Api\Generals\ICityRepository;
use App\Repositories\Interfaces\Api\Master\IMasterRepository;
use App\Repositories\Interfaces\Api\Generals\IGenderRepository;
use App\Repositories\Interfaces\Api\Master\IChildrenRepository;
use App\Repositories\Interfaces\Api\Admin\IInspectionRepository;
use App\Repositories\Interfaces\Api\Generals\ICountryRepository;
use App\Repositories\Classes\Api\Generals\NeighborhoodRepository;
use App\Repositories\Classes\Api\Generals\PackagesTypeRepository;
use App\Repositories\Classes\Api\Nurseries\JoinRequestRepository;
use App\Repositories\Interfaces\Api\Generals\IActivityRepository;
use App\Repositories\Interfaces\Api\Generals\ILanguageRepository;
use App\Repositories\Interfaces\Api\Generals\IRelationRepository;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use App\Repositories\Classes\Api\Generals\QualificationRepository;
use App\Repositories\Interfaces\Api\Generals\INeighborhoodRepository;
use App\Repositories\Interfaces\Api\Generals\IPackagesTypeRepository;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;
use App\Repositories\Interfaces\Api\Generals\IQualificationRepository;
use App\Repositories\Classes\Api\Generals\NurseryServiceTypeRepository;
use App\Repositories\Classes\Api\Generals\ServiceRepository;
use App\Repositories\Classes\Api\Generals\UtilityRepository;
use App\Repositories\Interfaces\Api\Admin\IRestoreRequestRepository;
use App\Repositories\Interfaces\Api\Generals\IAmenityRepository;
use App\Repositories\Interfaces\Api\Generals\INurseryServiceTypeRepository;
use App\Repositories\Interfaces\Api\Generals\IServiceRepository;
use App\Repositories\Interfaces\Api\Generals\IUtilityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(ICountryRepository::class, CountryRepository::class);
        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(INeighborhoodRepository::class, NeighborhoodRepository::class);
        $this->app->bind(IQualificationRepository::class, QualificationRepository::class);
        $this->app->bind(ILanguageRepository::class, LanguageRepository::class);
        $this->app->bind(IBankRepository::class, BankRepository::class);
        $this->app->bind(INurseryServiceTypeRepository::class, NurseryServiceTypeRepository::class);
        $this->app->bind(IPackagesTypeRepository::class, PackagesTypeRepository::class);
        $this->app->bind(IActivityRepository::class, ActivityRepository::class);
        $this->app->bind(INurseryRepository::class, NurseryRepository::class);
        $this->app->bind(IDayRepository::class, DayRepository::class);
        $this->app->bind(IGenderRepository::class, GenderRepository::class);
        $this->app->bind(IRelationRepository::class, RelationRepository::class);
        $this->app->bind(IMasterRepository::class, MasterRepository::class);
        $this->app->bind(IChildrenRepository::class, ChildrenRepository::class);
        $this->app->bind(IJoinRequestRepository::class, JoinRequestRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IInspectionRepository::class, InspectionRepository::class);
        $this->app->bind(INurseryEvaluationRepository::class, NurseryEvaluationRepository::class);
        $this->app->bind(IUtilityRepository::class, UtilityRepository::class);
        $this->app->bind(IAmenityRepository::class, AmenityRepository::class);
        $this->app->bind(IServiceRepository::class, ServiceRepository::class);
        $this->app->bind(IRestoreRequestRepository::class, RestoreRequestRepository::class);
        $this->app->bind(INationalityRepository::class, NationalityRepository::class);
        $this->app->bind(IBabySitterRepository::class, BabySitterRepository::class);
        $this->app->bind(IBabySitterSkillsRepository::class, BabySitterSkillsRepository::class);
        $this->app->bind(IBabysitterQulificationRepository::class, BabysitterQulificationRepository::class);
        $this->app->bind(INurseryAmenityRepository::class, NurseryAmenityRepository::class);
        $this->app->bind(INurseryServiceRepository::class, NurseryServiceRepository::class);
        $this->app->bind(IChildSicknessRepository::class, ChildSicknessRepository::class);
        $this->app->bind(IChildAllergyRepository::class, ChildAllergyRepository::class);
        $this->app->bind(IChildAlertRepository::class, ChildAlertRepository::class);
        $this->app->bind(IBookingRequestRepository::class, BookingRequestRepository::class);
        $this->app->bind(IBookingNurseryRepository::class, BookingNurseryRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
        $this->app->bind(IChildPhoneRepository::class, ChildPhoneRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
