<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\User\MachineController as UserMachineController;

use App\Http\Controllers\User\SensorController as UserSensorController;

use App\Http\Controllers\User\PredictionController as UserPredictionController;

use App\Http\Controllers\User\MaintenanceTaskController as UserMaintenanceTaskController;

use App\Http\Controllers\User\AlertController as UserAlertController;

use App\Http\Controllers\User\BillingController as UserBillingController;

use App\Http\Controllers\User\ReportController as UserReportController;

use App\Http\Controllers\User\SupportController as UserSupportController;

use App\Http\Controllers\User\TeamController as UserTeamController;

use App\Http\Controllers\User\UserProfileController;

use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\NewsletterController;




/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/



// Front-end Public Routes

Route::get('/', function () {

    return view('index');

})->name('home');


Route::get('/product', function () {
     $plans = \App\Models\Plan::all();
 
    return view('product', compact('plans'));
})->name('product');

Route::get('/solution', function () {

    return view('solution');

})->name('solution');






Route::get('/about', function () {

    return view('about');

})->name('about');



Route::get('/services', function () {

    return view('services');

})->name('service');





Route::get('/team', function () {

    return view('team');

})->name('team');



Route::get('/pricing', function () {

    $plans = \App\Models\Plan::all();

    return view('pricing', compact('plans'));

})->name('subscription');



Route::get('/checkout/{plan}', [CheckoutController::class, 'show'])

    ->name('checkout.show');



Route::post('/checkout/{plan}/create-session', [CheckoutController::class, 'createSession'])

    ->name('checkout.create_session');



Route::get('payment/success', [CheckoutController::class, 'success'])

->name('payment.success');





Route::get('/contact', function () {

    return view('contactus');

})->name('contact');



Route::get('/request-for-demo', function () {

    return view('demo');

})->name('demo');



Route::get('/industries', function () {

    return view('industries');

})->name('industries');


Route::get('/whypredictor', function () {

    return view('why_predictor');

})->name('why_predictor');



Route::get('/privacy-policy', function () {

    return view('ourpolicy');

})->name('privacy.policy');



Route::get('/terms-conditions', function () {

    return view('termcondition');

})->name('term.condition');



// User Authentication Routes

Route::post('/newsletter-subscribe', [NewsletterController::class,'subscribe'])->name('newsletter.subscribe');

Route::get('/unsubscribe/{token}', [NewsletterController::class,'unsubscribe'])->name('newsletter.unsubscribe');




Route::get('/signin', [UserController::class, 'showLoginForm'])->name('signin');

Route::post('/signin', [UserController::class, 'login'])->name('user.login');

Route::get('/signup', [UserController::class, 'showRegistrationForm'])->name('signup');

Route::post('/signup', [UserController::class, 'register'])->name('user.register');

Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::post('/demo/submit', [UserController::class, 'submitDemoRequest'])->name('demo.submit');

// User Dashboard Routes (Protected)

Route::middleware(['auth'])->prefix('user')->group(function () {



    

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');



    // Machines CRUD

    Route::resource('machines', UserMachineController::class)->names('user.machines');

    Route::resource('sensors', UserSensorController::class)->names('user.sensors');

    
    // Predictions routes

    Route::resource('predictions', UserPredictionController::class)->names('user.predictions');

    Route::post('predictions/{prediction}/acknowledge', [UserPredictionController::class, 'acknowledge'])->name('user.predictions.acknowledge');

    Route::post('predictions/{prediction}/convert', [UserPredictionController::class, 'convert'])->name('user.predictions.convert');

    Route::post('predictions/{prediction}/resolve', [UserPredictionController::class, 'resolve'])->name('user.predictions.resolve');

    // Maintenance Tasks routes

    Route::resource('maintenance-tasks', UserMaintenanceTaskController::class)->names('user.maintenance-tasks');

    // Alerts

    Route::resource('alerts', UserAlertController::class)->names('user.alerts')->only(['index','show','destroy']);

    Route::post('alerts/{alert}/acknowledge', [UserAlertController::class, 'acknowledge'])->name('user.alerts.acknowledge');

    // Reports

    Route::resource('reports', UserReportController::class)->names('user.reports')->only(['index']);

    // Billing (invoices / subscriptions)

    Route::resource('billing', UserBillingController::class)->names('user.billing')->only(['index','show']);

    // Team (company users)

    Route::resource('team', UserTeamController::class)->names('user.team')->only(['index','show']);

    // Support (tickets)

    Route::resource('support', UserSupportController::class)->names('user.support');

    // Profile

    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');

    Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

});

// User Controllers

Route::prefix('user')->group(function () {

    Route::resource('alerts', 'User\AlertController');

    Route::resource('billing', 'User\BillingController');

    Route::resource('reports', 'User\ReportController');

    Route::resource('support', 'User\SupportController');

    Route::resource('team', 'User\TeamController');

});



// Admin Routes

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login Routes (Public)

    // Route::middleware('guest:admin')->group(function () {

    Route::get('/', [AdminController::class, 'showLoginForm'])->name('login.form');

    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login.form');

    Route::post('/login.submit', [AdminController::class, 'login'])->name('login');

    //  });

    // Admin Protected Routes

   Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        

        // CRUD Routes for all tables

        Route::resource('companies', \App\Http\Controllers\Admin\CompanyController::class)->names('companies');

        Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class)->names('plans');

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('users');

        Route::resource('machines', \App\Http\Controllers\Admin\MachineController::class)->names('machines');

        Route::resource('sensors', \App\Http\Controllers\Admin\SensorController::class)->names('sensors');

        Route::resource('sensor-readings', \App\Http\Controllers\Admin\SensorReadingController::class)->names('sensor-readings');

        Route::resource('predictions', \App\Http\Controllers\Admin\PredictionController::class)->names('predictions');

        Route::resource('maintenance-tasks', \App\Http\Controllers\Admin\MaintenanceTaskController::class)->names('maintenance-tasks');

        Route::resource('alerts', \App\Http\Controllers\Admin\AlertController::class)->names('alerts');

        Route::resource('subscriptions', \App\Http\Controllers\Admin\SubscriptionController::class)->names('subscriptions');

        Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class)->names('invoices');

        Route::resource('tickets', \App\Http\Controllers\Admin\TicketController::class)->names('tickets');
        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->names('settings');

    });

});



// Additional Resource Routes

// Route::resource('alerts', AlertController::class);

// Route::resource('billings', BillingController::class);

// Route::resource('reports', ReportController::class);

// Route::resource('supports', SupportController::class);

// Route::resource('teams', TeamController::class);

