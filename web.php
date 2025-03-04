<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\TechnologyController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\Lead\LeadEditController;
use App\Http\Controllers\Lead\LeadStatusController;
use App\Http\Controllers\Lead\LeadStoreController;
use App\Http\Controllers\Lead\LeadCommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\LeadUserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\LeadByCompanyController;
use App\Http\Controllers\Vendor\VendorController;


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
/*
|--------------------------------------------------------------------------
| User login
|--------------------------------------------------------------------------
*/



Route::get('/', function () {
    return view('auth.login');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Company Routes
|--------------------------------------------------------------------------
*/
Route::get('/add-company', [CompanyController::class, 'companyList'])->name('add.company');
Route::post('/add-company', [CompanyController::class, 'companyNameAdd'])->name('add.company.submit');
Route::get('/edit-company/{id}', [CompanyController::class, 'editCompany'])->name('edit.company');
Route::get('/delete-company/{id}', [CompanyController::class, 'destroy'])->name('delete.company');

Route::get('/add-technology', [TechnologyController::class, 'technologyList'])->name('add.technology');
Route::post('/add-technology', [TechnologyController::class, 'addTechnology'])->name('add.technology.submit');
Route::get('/edit-technology/{id}', [TechnologyController::class, 'editTechnology'])->name('edit.technology');
Route::get('/delete-technology/{id}', [TechnologyController::class, 'destroy'])->name('delete.technology');
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('/add-user', [UserController::class, 'showUserForm'])->name('add.user');
Route::get('/view-user', [UserController::class, 'showUser'])->name('view.user');
Route::post('/users', [UserController::class, 'store'])->name('add.user.submit');

Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('update.user');


// Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

// add role and view
Route::get('/add-role', [RoleController::class, 'addRole'])->name('add.role');
Route::post('/add-role-submit', [RoleController::class, 'submit'])->name('add.role.submit');
// edit update delete role
Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit.role');
Route::post('/update-role', [RoleController::class, 'update'])->name('update.role');
Route::post('/delete-role/{id}', [RoleController::class, 'destroy'])->name('delete.role');

/*
|--------------------------------------------------------------------------
| Generate Lead Status edit ,delete ,update controllre
|--------------------------------------------------------------------------
*/
Route::get('/add-leadstatus', [LeadStatusController::class, 'create'])->name('add.leadstatus');
Route::post('/add-leadstatus', [LeadStatusController::class, 'store'])->name('add.leadstatus.submit');
Route::get('/leadstatus/{id}/edit', [LeadStatusController::class, 'edit'])->name('leadstatus.edit');
Route::put('/leadstatus/{leadstatus}', [LeadStatusController::class, 'update'])->name('leadstatus.update');
Route::post('/leadstatus/{id}', [LeadStatusController::class, 'destroy'])->name('leadstatus.delete');

/*
|--------------------------------------------------------------------------
| Generate Lead
|--------------------------------------------------------------------------
*/
Route::get('/add-lead', [LeadController::class, 'showLeadForm'])->name('add.lead');
Route::post('/add-lead', [LeadStoreController::class, 'store'])->name('add.lead.submit');
Route::get('/view-lead', [LeadController::class, 'index'])->name('view.lead');
//Search
Route::post('/search-leads', [LeadController::class, 'searchLeads'])->name('search.leads');
// Edit lead route
Route::get('/leads/{lead}/edit', [LeadEditController::class, 'edit'])->name('leads.edit');
Route::post('/leads/{lead}', [LeadEditController::class, 'update'])->name('leads.update');
Route::delete('/leads/{lead}',[LeadEditController::class, 'destroy'])->name('leads.destroy');

// View comment and update route
Route::get('/leads/{lead}', [LeadCommentController::class, 'show'])->name('leads.show');
Route::post('/comments/add', [LeadCommentController::class, 'store'])->name('comments.add');

/*
|--------------------------------------------------------------------------
| Live Search
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'search']);

/*
|--------------------------------------------------------------------------
| user.leads.show
|--------------------------------------------------------------------------
*/
Route::get('/leads/user/{userId}', [LeadUserController::class, 'show'])->name('user.leads.show');


Route::get('/profiles.index', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

/*
|--------------------------------------------------------------------------
| Lead By CompanyId Ajax Find
|--------------------------------------------------------------------------
*/
Route::get('/leadsbycompanyid', [LeadByCompanyController::class, 'index']);

});
/*
|--------------------------------------------------------------------------
| Vendor Registration
|--------------------------------------------------------------------------
*/

// Route for displaying all vendors
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');

// Route for displaying the form to create a new vendor
Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.createVendor');

// Route for storing a newly created vendor
Route::post('/add-vendor', [VendorController::class, 'store'])->name('add.vendor.submit');

// Route for displaying the form to edit an existing vendor
Route::get('/vendors/{vendor}', [VendorController::class, 'edit'])->name('vendors.editVendor');

// Route for updating an existing vendor
Route::post('/vendors/update', [VendorController::class, 'update'])->name('vendors.updateVendor');




