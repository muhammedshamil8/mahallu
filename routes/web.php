<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/admin', [
	'middleware' => 'admin',
	'uses' => 'Admin\DashboardController@index'
]);
Route::get('/student', [
	'middleware' => 'customer',
	'uses' => 'Student\DashboardController@index'
]);

Route::group(['middleware' => 'admin'], function () {

	Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin/dashboard.index');

	Route::resource('admin/families', 'Admin\FamilyController');
	Route::resource('admin/members', 'Admin\MemberController');

	Route::resource('admin/settings/educations', 'Admin\EducationController');
	Route::resource('admin/settings/islamic_educations', 'Admin\IslamicEducationController');
	Route::resource('admin/settings/jobs', 'Admin\JobController');
	Route::resource('admin/settings/relations', 'Admin\RelationController');
	Route::resource('admin/settings/facilities', 'Admin\FacilityController');
	Route::resource('admin/settings/relegion', 'Admin\RelegionController');
	Route::resource('admin/settings/masjid', 'Admin\MasjidController');
	Route::resource('admin/settings/designation', 'Admin\DesignationController');
	Route::resource('admin/settings/districts', 'Admin\DistrictController');
	Route::resource('admin/settings/executive-members', 'Admin\ExecutiveMemberController');
    
    Route::resource('admin/committe', 'Admin\CommitteController');
    Route::resource('admin/member', 'Admin\MemberListController');
	Route::resource('admin/committee-members', 'Admin\CommitteeMemberController');

	Route::resource('admin/academic/classes', 'Admin\CourseController');
	Route::resource('admin/academic/students', 'Admin\StudentController');
    //Route::get('admin/committe/create', 'Admin\CommitteController@index');

    Route::resource('admin/accounts/account_list', 'Admin\AccountController');
    Route::resource('admin/accounts/receiver_list', 'Admin\ReceiverController');
    Route::resource('admin/accounts/income', 'Admin\IncomeController');
    Route::resource('admin/accounts/expense', 'Admin\ExpenseController');
    Route::resource('admin/accounts/bank_account', 'Admin\BankAccountController');
    Route::resource('admin/accounts/donors', 'Admin\DonorController');
    Route::resource('admin/accounts/helps', 'Admin\HelpController');
    Route::resource('admin/accounts/beneficiaries', 'Admin\BeneficiaryController');
    Route::resource('admin/accounts/shops', 'Admin\ShopController');
    Route::resource('admin/accounts/staffs', 'Admin\StaffController');


	Route::resource('admin/reports/family_reports', 'Admin\FamilyReportController');
	Route::resource('admin/reports/member_reports', 'Admin\MemberReportController');
	Route::resource('admin/reports/tran_reports', 'Admin\TranReportController');

	//////////////////////////////////////
	Route::resource('admin/user', 'Admin\UserController');
	Route::resource('admin/role', 'Admin\RoleController');
});

Route::group(['middleware' => 'customer'], function () {

	Route::get('student/dashboard', 'Student\DashboardController@index')->name('student/dashboard');

	//Route::resource('student/subjects', 'Student\SubjectController');
	Route::get('student/subjects', 'Student\SubjectController@index')->name('student/subjects');
	Route::get('student/chapters', 'Student\ChapterController@index')->name('student/chapters');
	Route::get('student/topics', 'Student\TopicController@index')->name('student/topics');
	Route::get('student/contents', 'Student\ContentController@index')->name('student/contents');
	Route::resource('student/tests', 'Student\TestController');
	Route::resource('student/results', 'Student\ResultController');
});
Route::get('/home', 'HomeController@index')->name('home');


