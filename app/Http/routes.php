<?php

Route::get('blog', 'SiteController\BlogController@new_blog');
Route::get('blog/new', 'SiteController\BlogController@new_blog');
Route::get('blog/list','SiteController\BlogController@index');
Route::get('blog/{id}', 'SiteController\BlogController@show');
Route::post('blog/store','SiteController\BlogController@store');
Route::get('blog/destroy/{id}','SiteController\BlogController@destroy');
Route::get('blog/edit/{id}','SiteController\BlogController@edit');
Route::post('blog/edit/{id}','SiteController\BlogController@update');
Route::get('Gallery','HomeController@galleries');


# Routes that anyone can access.
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

# Redirecting all registered users so they cannot access these pages.

Route::group(['middleware' => ['redirectAdmin','redirect', 'redirectStandardUser', 'redirectSuperAdmin', 'redirectFaculty']], function () {

Route::group(['middleware' => ['redirectAdmin', 'redirectStandardUser', 'redirectSuperAdmin', 'redirectFaculty','redirectAdministrator']], function () {


    # Login page routes.
    Route::get('/', ['as' => 'login', 'uses' => 'SessionsController@create']);
    Route::get('/login', ['as' => 'login', 'middleware' => 'guest', 'uses' => 'SessionsController@create']);
});

# Routes only guests can access.
Route::group(['middleware' => 'guest'], function () {

    # Forgotten Password.
    Route::get('forgot_password', 'Auth\PasswordController@getEmail');
    Route::post('forgot_password', 'Auth\PasswordController@postEmail');
    Route::get('reset_password/{token}', 'Auth\PasswordController@getReset');
    Route::post('reset_password/{token}', 'Auth\PasswordController@postReset');
});

# Routes that Standard Users and Faculty cannot access.
Route::group(['middleware' => ['auth', 'redirectFaculty', 'redirectStandardUser']], function () {

    # Faculty crud Route.
    Route::resource('Faculty', 'FacultyController');
   

    # Examtype crud Routes.
    Route::resource('ExamType', 'ExamTypeController');

    # ExamDetails crud Routes.
    Route::resource('ExamDetails', 'ExamDetailsController');

    # Feetype crud Routes.
    Route::resource('FeeTypes', 'FeeTypesController');

    # Notice crud Routes.
    Route::resource('Notice', 'NoticeController');

    # Batch crud Routes.
    Route::resource('ClassDetails', 'ClassDetailsController');
    Route::resource('Hostel', 'HostelController');
    Route::resource('Fee', 'FeehostelController');
    Route::get('hostelfee', ['as' => 'search.hostelfee', 'uses' => 'FeehostelController@hostelfeesearch']);
    Route::get('dayscholars', ['as' => 'search.dayscholars', 'uses' => 'HostelController@search']);
    Route::get('hostel', ['as' => 'search.hostel', 'uses' => 'HostelController@hostelsearch']);

    # Activity crud Routes.
    Route::resource('Activity', 'ActivityTypeController');

    # Activity Details crud Routes.
    Route::resource('ActivityDetails', 'ActivityDetailsController');

    Route::resource('StoreType', 'StoreTypeController');

    Route::resource('Assignment', 'AssignmentController');

    Route::resource('StoreManagement', 'StoreManagementController');

    # Route to edit student profile.
    Route::post('edit/admin/student/{id}', ['as' => 'studentProfilen.update', 'uses' => 'SuperAdmin\RegistrationController@update']);

    # Route to edit faculty profile.
    Route::post('edit/admin/faculty/{id}', ['as' => 'facultyProfile.update', 'uses' => 'SuperAdmin\RegistrationController@update']);

    #Search Student Route
//    Route::post('Search', ['as' => 'search.queries', 'uses' => 'StudentController@search']);

    # Sms Api Route
    Route::get('SendAnSms/students', 'SmsApiController@students');
    Route::get('SendAnSms/batches', 'SmsApiController@batches');
    Route::get('SendAnSms/faculty', 'SmsApiController@faculty');
    Route::post('SmsApi', 'SmsApiController@sms');
    Route::get('SmsHistory', 'SmsApiController@index');
});

# Routes that Standard User Cannot access.
Route::group(['middleware' => ['auth', 'redirectStandardUser']], function () {

    # Routes to Mark Section.
    Route::resource('mark', 'MarkDetailsController');
    Route::post('fetchStudents', ['uses' => 'MarkDetailsController@fetchStudents']);
    Route::post('fetchMark', ['uses' => 'MarkDetailsController@fetchMark']);

    # Student Registration crud Route.
       Route::resource('Student', 'StudentController');

    # Search Student Route.
   Route::get('Search', ['as' => 'search.queries', 'uses' => 'StudentController@search']);

    # Library crud Route.
    Route::resource('Library', 'LibraryController');
    Route::get('library/issue', ['uses' => 'LibraryController@issueBook']);
});

# Standard User Routes.
Route::group(['middleware' => ['auth', 'standardUser']], function () {

    # Home
    Route::get('home', 'PagesController@getHome');
    Route::get('notice', ['as' => 'notice.getNotice', 'uses' => 'PagesController@getNotice']);
    Route::get('userProtected', 'StandardUser\StandardUserController@getUserProtected');
    Route::resource('profiles', 'StandardUser\UsersController', ['only' => ['show', 'edit', 'update']]);

    # Mark details Route
    Route::get('Marks', ['uses' => 'MarkDetailsController@getMark']);
});

# Admin Routes.
Route::group(['middleware' => ['auth', 'admin']], function () {
    # Home
    Route::get('/admin', ['as' => 'admin_dashboard', 'uses' => 'Admin\AdminController@getHome']);
});

# Super Admin Routes.
Route::group(['middleware' => ['auth', 'superadmin']], function () {

    # Home.
    Route::get('sadmin', ['as' => 'admin_dashboard', 'uses' => 'SuperAdmin\SuperAdminController@getHome']);

    # Admin CRUD Routes.
    Route::get('list/admins', 'SuperAdmin\RegistrationController@index');
    Route::get('create/admin', 'SuperAdmin\RegistrationController@create');
    Route::post('register', ['as' => 'registration.store', 'uses' => 'SuperAdmin\RegistrationController@store']);
    Route::get('edit/admin/{id}', ['as' => 'registration.edit', 'uses' => 'SuperAdmin\RegistrationController@edit']);
    Route::post('edit/admin/{id}', ['as' => 'registration.update', 'uses' => 'SuperAdmin\RegistrationController@update']);
    Route::delete('admin/{id}', ['as' => 'registration.destroy', 'uses' => 'SuperAdmin\RegistrationController@destroy']);
});

# Routes that any Authorized user can use
Route::group(['middleware' => ['auth']], function () {

    # Routes to Attendance Section
    Route::get('attendance/mark', ['uses' => 'AttendanceController@index']);
    Route::get('attendance/mark/{id}', ['uses' => 'AttendanceController@mark']);
    Route::post('attendance/mark', ['uses' => 'AttendanceController@store']);
    Route::get('attendance/batch', ['uses' => 'AttendanceController@selectBatch']);
    Route::get('attendance/batch/{id}', ['uses' => 'AttendanceController@ofBatch']);
    Route::get('attendance/batch/{id}/{date}', ['uses' => 'AttendanceController@ofBatchDate']);
    Route::get('attendance/student', ['uses' => 'AttendanceController@selectStudentGet']);
    Route::post('attendance/student', ['as' => 'attendance.student', 'uses' => 'AttendanceController@selectStudentPost']);
    Route::get('attendance/student/{id}', ['uses' => 'AttendanceController@ofStudent']);
    Route::get('edit/attendance', ['uses' => 'AttendanceController@edit']);
    Route::get('edit/attendance/{id}', ['uses' => 'AttendanceController@selectDate']);
    Route::get('edit/attendance/{id}/{date}', ['uses' => 'AttendanceController@editBatch']);
    Route::post('edit/attendance', ['uses' => 'AttendanceController@update']);
    Route::delete('attendance', ['as' => 'attendance.destroy', 'uses' => 'AttendanceController@destroy']);
    Route::post('rangeAttendance', ['uses' => 'AttendanceController@rangeAttendance']);

});

# Faculty Routes
Route::group(['middleware' => ['auth', 'faculty']], function () {

    # Home
    Route::get('faculty', ['as' => 'home', 'uses' => 'Faculty\FacultyController@getHome']);
});
#subject crud

Route::resource('Subject', 'SubjectController');

Route::resource('Timetable', 'TimetableController');
Route::post('Timetable/config', 'TimetableController@timetable_config');

# Routes that only current user can access
Route::group(['middleware' => ['auth', 'notCurrentUser']], function () {

    # Routes to Change Password
    Route::get('changePassword/{id}', ['uses' => 'ChangePasswordController@edit']);
    Route::post('changePassword/{id}', ['as' => 'password.change', 'uses' => 'ChangePasswordController@update']);
});

Route::resource('transportation', 'BusesController');
Route::resource('BusFee', 'BusFeeController');

Route::get('construction', function(){
    return view('construction');
});

Route::filter('permissions', function ($route, $request) {
    $action = $route->getActionName();

    if (Sentinel::hasAccess($action)) {
        return $request;
    }

    return redirect('/')->withFlashMessage('Permission denied.')->withType('danger');
});

Route::get('/','HomeController@root');
Route::get('About',function () {
    return view('frontend.about');
});
Route::get('Contact','SiteController\AboutController@create');
Route::post('Contact','SiteController\AboutController@store');
Route::get('Blogs','HomeController@blogs');
Route::get('Blog/{id}','BlogController@show');

Route::get('Gallery/{id}',['uses'=>'HomeController@gallery']);
Route::get('Management', 'HomeController@root');
Route::get('Academics', 'HomeController@root');


# Banner Routes
    Route::get('banner','SiteController\BannerController@edit');
    Route::post('banner','SiteController\BannerController@update');
    Route::get('banner/{id}','SiteController\BannerController@destroy');
    Route::get('event/new','SiteController\EventGalleryController@create');
    Route::post('event/new','SiteController\EventGalleryController@store');
    Route::get('event','SiteController\EventGalleryController@index');
    Route::get('event/destroy/{id}','SiteController\EventGalleryController@destroy');
    Route::get('event/gallery/{eventid}',['as'=>'image.create','uses'=>'SiteController\ImageController@create']);
    Route::post('event/gallery',['as'=>'image.store','uses'=>'SiteController\ImageController@store']);
    Route::post('toggle/{id}','SiteController\ImageController@toggle');
    Route::post('caption/{id}','SiteController\ImageController@caption');
    Route::get('event/edit/{id}','SiteController\EventGalleryController@edit');
    Route::post('event/edit/{id}','SiteController\EventGalleryController@update');
