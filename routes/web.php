<?php

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MailchimpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceListController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServiceFeedbackController;
use App\Http\Controllers\ServiceRequestCustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\FindWorkshopController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\TagController;

//Settings Others
use App\Http\Controllers\StatusChangeController;
use App\Http\Controllers\DestroyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UnionController;

//Inventory Software
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\MarketTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//require __DIR__.'/auth.php';
// Command: php artisan optimize:clear
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    notify()->success("Caches cleared successfully!", "Success");
    return redirect()->back();
});

Route::get('rough', [HomeController::class, 'test']);
Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');
//Route::redirect('home', 'dashboard');
Route::any('demo', [HomeController::class, 'demo'])->name('demo');
Route::redirect('blog', 'insight');
Route::any('insight/{option?}/{slug?}', [BlogController::class, 'index'])->name('insight');
Route::get('insight-details/{slug}', [BlogController::class, 'details'])->name('insight.details');
Route::post('insight-comment', [BlogController::class, 'store'])->name('insight.comment.store');


Route::group(['middleware' => ['guest']], function () {
    Route::any('login', [AuthController::class, 'login'])->name('login');
    Route::any('/register', [AuthController::class, 'register'])->name('register');
    Route::any('/otp', [AuthController::class, 'otp'])->name('otp');
    Route::any('/otp-resend', [AuthController::class, 'otpResend'])->name('otp.resend');
    Route::any('/otp-again', [AuthController::class, 'otpAgain'])->name('otp.again');
});


// Subscribe
Route::any('subscribe', [MailchimpController::class, 'subscribe'])->name('subscribe');
Route::any('subscribers-list', [MailchimpController::class, 'subscribersList'])->name('subscribers.list');
Route::any('unsubscribe', [MailchimpController::class, 'unsubscribe'])->name('unsubscribe');
Route::any('attach-unsubscribe-event', [MailchimpController::class, 'attachUnsubscribeEvent'])->name('attach.unsubscribe-event');
Route::any('listen-unsubscribe-event', [MailchimpController::class, 'subscribe'])->name('listen.unsubscribe-event');


Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('demo-dashboard', [DashboardController::class, 'demoDashboard'])->name('dashboard.demo');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', [TestController::class, 'user'])->name('user');
    Route::get('/dash-plan', [TestController::class, 'plan'])->name('plan');
    Route::get('profile-update', [TestController::class, 'profileUpdate'])->name('profile-update');
    Route::get('profile-info', [ProfileController::class, 'showProfile'])->name('profile.info');
    Route::post('profile-info', [ProfileController::class, 'updateProfile'])->name('profile.info');


    // Product
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('good', GoodController::class);
    Route::resource('market-type', MarketTypeController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('warehouse', WarehouseController::class);
    Route::resource('product', ProductController::class);
    Route::get('product-list/{show}', [ProductController::class, 'productList'])->name('product.list');

    //--Status and Destroy Controller
    Route::any('status', [StatusChangeController::class, 'status']);
    Route::post('destroy', [DestroyController::class, 'destroy'])->name('destroy');


    Route::get('workshop-info', [ProfileController::class, 'showWorkshop'])->name('workshop.info');
    Route::post('workshop-info', [ProfileController::class, 'updateWorkshop'])->name('workshop.info');
    Route::any('profile-password', [ProfileController::class, 'profilePassword'])->name('profile.password');


    /*Route::get('get-location', [WorkshopController::class, 'getLocation'])->name('location.search');
    Route::get('search-workshops', [WorkshopController::class, 'searchWorkshop'])->name('workshops.search');
    Route::any('workshop-list', [WorkshopController::class, 'workshopList'])->name('workshops.list');
    Route::get('workshop-details', [WorkshopController::class, 'workshopDetails'])->name('workshop.details');
    Route::get('workshop-profile', [WorkshopController::class, 'workshopProfile'])->name('workshop.profile');
    Route::get('insert-data', [FindWorkshopController::class, 'insertData']);


    Route::any('nearest-workshop', [FindWorkshopController::class, 'nearestWorkshop'])->name('nearest.workshop')->withoutMiddleware('auth');
    Route::post('nearest-workshop-list', [FindWorkshopController::class, 'getWorkshopList'])->name('nearest.workshop.list')->withoutMiddleware('auth');

    Route::any('workshop-send-request', [FindWorkshopController::class, 'sendRequest'])
        ->name('workshop.send-request');
    Route::any('workshop-accept-request/{serviceRequest}', [FindWorkshopController::class, 'acceptRequest'])
        ->name('workshop.accept-request');*/


    Route::view('welcome', 'welcome');

    /*Route::resource('workshops', WorkshopController::class);

    // ServiceType CRUD-Operation [1=workshop, 2=fuel, 3=raker]
    Route::prefix('service')->group(function () {
        Route::get('{type}', [ServiceController::class, 'index'])->name('service.type.index')->where('type', 'workshop|fuel|raker');
        Route::get('type/{type}', [ServiceController::class, 'serviceType'])->name('service.type')->where('type', '[1-3]+');
        Route::get('{type}/create', [ServiceController::class, 'create'])->name('service.type.create')->where('type', 'workshop|fuel|raker');
        Route::get('{type}/{id}/edit', [ServiceController::class, 'edit'])->name('service.type.edit')->where('type', 'workshop|fuel|raker')->where('id', '[0-9]+');
        Route::put('{type}/update', [ServiceController::class, 'update'])->name('service.type.update')->where('type', 'workshop|fuel|raker');
        Route::delete('{type}/{id}/destroy', [ServiceController::class, 'destroy'])->name('service.type.destroy')->where('type', 'workshop|fuel|raker')->where('id', '[1-9]+');
        Route::post('{type}/store', [ServiceController::class, 'store'])->name('service.type.store')->where('type', 'workshop|fuel|raker');
    });*/


    // Service Type
    //Route::get('{service_type}/{id}/edit',  [ServiceTypeController::class, 'edit'])->where('service_type', 'workshop|fuel|raker');


/*    Route::post('service-request/{serviceRequest}/status', [ServiceRequestController::class, 'changeStatus'])
        ->name('service-request.status');

    Route::resource('service-request', ServiceRequestController::class);
    Route::get('service-request-workshop', [ServiceRequestController::class, 'requestDetails'])
        ->name('service-request.workshop');

    Route::resource('service-request-customer', ServiceRequestCustomerController::class)
        ->parameter('service-request-customer', 'service-request');
    Route::get('service-request-customer-details', [ServiceRequestCustomerController::class, 'details'])
        ->name('service-request-customer-details');


    Route::resource('plan', PlanController::class);
    Route::resource('service-category', ServiceCategoryController::class);
    Route::resource('service-list', ServiceListController::class);


    // Blog or Insight
    Route::resource('post', PostController::class);
    Route::resource('tag', TagController::class);*/


    // Settings
    Route::resource('division', DivisionController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('upazila', UpazilaController::class);
    Route::resource('union', UnionController::class);

    Route::resource('service-feedback', ServiceFeedbackController::class);


});

Route::get('google-api-test', [TestController::class, 'googleApiTest']);


Route::prefix('design')->group(function () {
    Route::get('contact-us', [DesignController::class, 'contactUs'])->name('design.contact-us');
    Route::get('about-us', [DesignController::class, 'aboutUs'])->name('design.about-us');
    Route::get('blog', [DesignController::class, 'blogPage'])->name('design.blog');
    Route::get('blog-details', [DesignController::class, 'blogDetails'])->name('design.blog-details');
    Route::get('404', [DesignController::class, 'notFound'])->name('design.not_found');
    Route::get('contact-us', [DesignController::class, 'contactUs'])->name('design.contact-us');
    Route::get('about-us', [DesignController::class, 'aboutUs'])->name('design.about-us');
    Route::get('blog', [DesignController::class, 'blogPage'])->name('design.blog');
    Route::get('blog-details', [DesignController::class, 'blogDetails'])->name('design.blog-details');
});




