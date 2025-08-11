<?php

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

// Route::get('/','HomeController@index');
Route::get('/admin', function(){ 
	// return $location = "httwww.geoplugin.net/php.gp?ip=".$_SERVER['REMOTE_ADDR'];
	// $location = [];
	// $location = var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
	// foreach ($location as $key => $value) {
		// return $location[1];
	// }
	// return $_SERVER['REMOTE_ADDR'];
// 	echo encrypt('virak@12345'); 
	return redirect()->intended('/'); 
});
 
Route::get('login',  'App\Http\Controllers\Auth\LoginController@getLogin')->name('login');
Route::POST('doLogin',  'App\Http\Controllers\Auth\LoginController@doLogin')->name('doLogin');
Route::get('logout',  'App\Http\Controllers\Auth\LoginController@getLogOut')->name('logOut');

// ================== CHECK IS USER AS Admin 
Route::group(['middleware' => ['IsAdmin']], function(){
	Route::get('user/role/menu', 'App\Http\Controllers\Admin\RoleController@roleApply')->name('roleApply');
	Route::post('user/role/menu', 'App\Http\Controllers\Admin\RoleController@menuApplied')->name('menuApplied');
	Route::get('users', 'App\Http\Controllers\Admin\UserController@userList')->name('userList');
	Route::get('user/role', 'App\Http\Controllers\Admin\UserController@rolList')->name('rolList');
	Route::POST("role/create", "App\Http\Controllers\Admin\UserController@createRole")->name('createRole');
	Route::get("user/register", "App\Http\Controllers\Admin\UserController@userForm")->name('userForm');
	Route::get("user/update/{user}/user", "App\Http\Controllers\Admin\UserController@userStore")->name('userStore');
	Route::post("user/update", "App\Http\Controllers\Admin\UserController@updateUser")->name('updateUser');
	Route::post("user/regiser/new", "App\Http\Controllers\Admin\UserController@registerNew")->name('addUser');
	Route::get("user/update/{user}/permission", "App\Http\Controllers\Admin\UserController@editpermission")->name('editpermission');
	Route::post("user/update/permission", "App\Http\Controllers\Admin\UserController@changePermission")->name('changePermission');
});

// =============== AMINISTRATION SECTION======================================
Route::group(['middleware' => ['IsLogin']], function(){
		// Route documentation :
		Route::prefix("docs")->group(function () {
			Route::get("/", "App\Http\Controllers\DocsController@getDocs")->name("getDocs");
			Route::get("/list", "App\Http\Controllers\DocsController@getDocsList")->name("getDocsList");
			Route::get("action", "App\Http\Controllers\DocsController@createDocs")->name('createDocs');
			Route::post("create/docs", "App\Http\Controllers\DocsController@createNewDocs")->name('createNewDocs');
			Route::get("preview", "App\Http\Controllers\DocsController@getDocsDetail")->name("getDetail_doc");
		});

		Route::get('setting', 'App\Http\Controllers\Admin\ThemeController@setting')->name('setting');
		Route::get('setting/{id}', 'App\Http\Controllers\Admin\ThemeController@settingForm')->name('settingForm');
		Route::POST("setting/update/{id}", 'App\Http\Controllers\Admin\ThemeController@updateSetting')->name('updateSetting');
	// Route::prefix('admin')->group(function () {
		Route::get("setting-options", "App\Http\Controllers\Admin\ThemeController@getTheme")->name('getTheme'); 
		Route::get("company", "App\Http\Controllers\Admin\ThemeController@getCompany")->name('company');
		Route::get("company-form", "App\Http\Controllers\Admin\ThemeController@companyForm")->name('companyForm');
		Route::post("company", "App\Http\Controllers\Admin\ThemeController@addCompany")->name('addCompany');


		Route::get("slide-show", "App\Http\Controllers\Admin\SlideController@index")->name('slides');
		Route::get("slide/add", "App\Http\Controllers\Admin\SlideController@createSlide")->name('createSlide');
		Route::get("slide/update/{slideId}", "App\Http\Controllers\Admin\SlideController@getSlide")->name('getSlide');
		Route::POST("slide/add", "App\Http\Controllers\Admin\SlideController@slideStore")->name('slideStore');
		Route::POST("slide/update", "App\Http\Controllers\Admin\SlideController@updateStore")->name('updateStore');
		
		Route::get("user/update/{user}/user", "App\Http\Controllers\Admin\UserController@userStore")->name('userStore');
		Route::post("user/update", "App\Http\Controllers\Admin\UserController@updateUser")->name('updateUser');	

		Route::get('booking/project', 'App\Http\Controllers\Admin\ProjectController@projectForm')->name('proForm');
		Route::get('booking/project/update/{project}', 'App\Http\Controllers\Admin\ProjectController@projectFormEdit')->name('proFormEdit');
		Route::post('create/project', 'App\Http\Controllers\Admin\ProjectController@createProject')->name('createProject');
		Route::get("/getImageFile", "App\Http\Controllers\Admin\AdminController@getImageFile")->name('getImageFile');
		Route::post('booking/update', 'App\Http\Controllers\Admin\ProjectController@updateProject')->name('updateProject');
		Route::POST("/project/AddNet", 'App\Http\Controllers\Admin\ProjectController@projectAddNetPrice')->name('projectAddNetPrice');

		Route::get('/', 'App\Http\Controllers\Admin\AdminController@index')->name('adminhome');
		Route::post('booked/{project}', 'App\Http\Controllers\Admin\AdminController@searchProject')->name('searchProject');
		Route::get('booked/{project}', 'App\Http\Controllers\Admin\ProjectController@projectList')->name('projectList');
		Route::get('booked/project/{prjectNo}', 'App\Http\Controllers\Admin\ProjectController@preProject')->name('preProject');

		Route::POST("bookedTourUpdate", "App\Http\Controllers\Admin\ProjectController@UpdateTourDesc")->name("UpdateTourDesc");
		
		Route::POST("addClient/project", 'App\Http\Controllers\Admin\ProjectController@addClientForProject')->name('addClientForProject');

		Route::post("addProjectPdF", 'App\Http\Controllers\Admin\ProjectController@addProjectPdF')->name('addProjectPdF');
		
		Route::get('booked/{booktype}/update/{bookId}', 'App\Http\Controllers\Admin\BookingController@geteditBookedType')->name('bookingEdit');
		Route::post('booked/{booktype}/updated', 'App\Http\Controllers\Admin\BookingController@updateBookedType')->name('updateBooked');


		Route::get('booked/hotel/apply/{project}-{hotel}-{bookid}/room', 'App\Http\Controllers\Admin\BookingController@bookedApplyroom')->name('bapplyRoom');
		Route::get('edit/booked/hotel/apply/{project}-{hotel}-{bookid}/room', 'App\Http\Controllers\Admin\BookingController@editbookedApplyroom')->name('editbapplyRoom');
		Route::POST('booked/hotel/apply/room/remark', 'App\Http\Controllers\Admin\BookingController@addHotelRemark')->name('addHotelRemark');
		Route::get('booked/cruise/apply/{project}-{hotel}-{bookid}/room', 'App\Http\Controllers\Admin\BookingController@bookedCruise')->name('bookedCruise');
		Route::post('booking/applied/room', 'App\Http\Controllers\Admin\BookingController@hotelbookedRoomApplied')->name('bookingAppliedroom');
		Route::post('booking/applied/cruisrate', 'App\Http\Controllers\Admin\BookingController@crusebookedRoomApplied')->name('crbgAppliedroom');
		Route::get('country', 'App\Http\Controllers\Admin\DestinationController@CountryList')->name('CountryList');	
		Route::get('country/create/new', 'App\Http\Controllers\Admin\DestinationController@getCountry')->name('getCountry');	
		Route::post('country/create', 'App\Http\Controllers\Admin\DestinationController@createCountry')->name('createCountry');
		Route::get('country/{countryId}/edit', 'App\Http\Controllers\Admin\DestinationController@getCountryEdit')->name('getCountryEdit');
		
		Route::post('country/update', 'App\Http\Controllers\Admin\DestinationController@updateCountry')->name('updateCountry');
		Route::get('province', 'App\Http\Controllers\Admin\DestinationController@provinceList')->name('provinceList');	
		Route::get('province/create/new', 'App\Http\Controllers\Admin\DestinationController@getProvince')->name('getProvince');
		Route::post('province/create', 'App\Http\Controllers\Admin\DestinationController@createProvince')->name("createProvince");
		Route::get('province/{proId}/edit', 'App\Http\Controllers\Admin\DestinationController@getProvinceEdit')->name('getProvinceEdit');
		Route::post('province/update', 'App\Http\Controllers\Admin\DestinationController@updateProvince')->name('updateProvince');
		Route::get('suppliers', 'App\Http\Controllers\Admin\SupplierController@supplierList')->name('supplierList');	
		Route::get('supplier/{supplier}', 'App\Http\Controllers\Admin\SupplierController@supplierBusiness')->name('supplierBusiness');

		Route::get('supplier/transport/{id}/driver', 'App\Http\Controllers\Admin\SupplierController@getDriver')->name('getDriver');
		Route::get("transport/edit", "App\Http\Controllers\Admin\ServiceController@getEditTransport")->name("getEditTransport");

		Route::get('supplier/add/new', 'App\Http\Controllers\Admin\SupplierController@getSupplierForm')->name('getSupplierForm');
		 
		Route::post('supplier/create', 'App\Http\Controllers\Admin\SupplierController@createSupplier')->name('createSupplier');
		Route::get('supplier/edit/{supplierId}', 'App\Http\Controllers\Admin\SupplierController@getEditSupplier')->name('getEditSupplier');
		Route::get('supplier/hotel/update/info/{supplierId}', 'App\Http\Controllers\Admin\HotelController@getEditHotelInfo')->name('getEditHotelInfo');
		Route::post('hotel/update/info', 'App\Http\Controllers\Admin\HotelController@updateHotelInfo')->name('updateHotelInfo');
		Route::POST("AddHotelDiscount", 'App\Http\Controllers\Admin\HotelController@AddHotelDiscount')->name('AddHotelDiscount');
		Route::post('supplier/udpate', 'App\Http\Controllers\Admin\SupplierController@udpateSupplier')->name('udpateSupplier');

		Route::get('flight-schedule', 'App\Http\Controllers\Admin\FlightController@getFlightSchedule')->name('getFlightSchedule');
		Route::get('flight-schedule/add/new', 'App\Http\Controllers\Admin\FlightController@createFlightSchedule')->name('createFlightSchedule');
		
		Route::POST('flight-schedule/create', 'App\Http\Controllers\Admin\FlightController@createSchedule')->name('createSchedule');

		Route::POST('flight-schedule/update', 'App\Http\Controllers\Admin\FlightController@updateSchedule')->name('updateSchedule');
		Route::GET('schedule-price/add', 'App\Http\Controllers\Admin\FlightController@upscheduleprice')->name('upscheduleprice');
		Route::get('flight/edit/{flightId}/schedule', 'App\Http\Controllers\Admin\FlightController@getEditSchedule')->name('getEditSchedule');
		Route::get('flight-schedule/apply/{schedule}', 'App\Http\Controllers\Admin\FlightController@getSchedulePrice')->name('getSchedulePrice');
		 
		Route::get('service/include', 'App\Http\Controllers\Admin\ServiceController@serviceInclude')->name('serviceInclude');
		Route::get('service/{service}', 'App\Http\Controllers\Admin\ServiceController@getService')->name('getService');
		Route::get('restaurant/menu', 'App\Http\Controllers\Admin\ServiceController@restaurantMenu')->name('restMenu');
		Route::get('restautant/menu/create', 'App\Http\Controllers\Admin\ServiceController@createrestMenu')->name('createrestMenu');
		Route::post('service/added', 'App\Http\Controllers\Admin\ServiceController@addService')->name('addService');
		Route::post("restautant/add/menu", "App\Http\Controllers\Admin\ServiceController@AddRestMenu")->name('AddRestMenu');
		Route::post("restautant/update/menu", "App\Http\Controllers\Admin\ServiceController@updateRestMenu")->name('EditRestMenu');
		Route::get("transport/service", "App\Http\Controllers\Admin\ServiceController@tranService")->name('tranService'); 
		Route::get("transport/driver/add", "App\Http\Controllers\Admin\ServiceController@getDriver")->name('getDriver');
		Route::get("transport/vihecle/", "App\Http\Controllers\Admin\ServiceController@getVehicle")->name('getVehicle');

		//edit operation route 
		Route::get("edit/{type}/{id}","App\Http\Controllers\Admin\EditOperationController@editOperation")->name('editoperation');
		Route::get("edit/{type}/{project_no}/{id}","App\Http\Controllers\Admin\EditOperationController@editGuideOperation")->name('editguideoperation');
		Route::post("transport/added/vehicle", "App\Http\Controllers\Admin\ServiceController@CreateVehicle")->name('addVehicle');
		Route::post("transport/service/added", "App\Http\Controllers\Admin\ServiceController@createtranService")->name('addtranService');
		Route::get("golf/service", "App\Http\Controllers\Admin\ServiceController@golfService")->name('golfService');
		Route::post("golf/service", "App\Http\Controllers\Admin\ServiceController@addGolfService")->name('addGolfService');
		Route::get('guide/service', "App\Http\Controllers\Admin\ServiceController@getGuide")->name('getGuide');	

		Route::post('driver/add', "App\Http\Controllers\Admin\ServiceController@addDriver")->name('addDriver');
		Route::get('guide/service/{service}/language', "App\Http\Controllers\Admin\ServiceController@getGuideLanguage")->name('getLanguage'); 
		Route::post('guide/service/added', "App\Http\Controllers\Admin\ServiceController@addGuideService")->name('addGuideService');
		
		Route::get('misc/service/', "App\Http\Controllers\Admin\ServiceController@getMiscService")->name('getMiscService');
		Route::post('misc/service/added', "App\Http\Controllers\Admin\ServiceController@addMisc")->name('addMisc');
		Route::get('entrance/service/', "App\Http\Controllers\Admin\ServiceController@getEntrance")->name('getEntrance'); 
		Route::post('entrance/service/added', "App\Http\Controllers\Admin\ServiceController@addEntrance")->name('addEntrance');
		Route::post("guide/language/added", "App\Http\Controllers\Admin\ServiceController@addLanguage")->name('addLanguage');
		
		//promotion route

		Route::get('hotels/addpromotion','App\Http\Controllers\Admin\PromotionController@addPromotion')->name('addPromotion');
		Route::get('hotels/getpromotion','App\Http\Controllers\Admin\PromotionController@getPromotion')->name('getPromotion');
		Route::post('hotels/storepromotion','App\Http\Controllers\Admin\PromotionController@storePromotion')->name('storePromotion');
		Route::get('promotion/edit/{promoId}', 'App\Http\Controllers\Admin\PromotionController@getEditPromotion')->name('getEditPromotion');

		Route::get('hotel/room', 'App\Http\Controllers\Admin\HotelController@getRoom')->name('getRoom');
		Route::get('hotel/info', 'App\Http\Controllers\Admin\HotelController@getHotelinfo')->name('getHotelinfo');
		Route::post('hotel/info', 'App\Http\Controllers\Admin\HotelController@addHotelinfo')->name('addHotelinfo');
		Route::post('hotel/agentTariff', 'App\Http\Controllers\Admin\SupplierController@sortHotelTariff')->name('sortHotelTariff');


		Route::get('hotel/facility', 'App\Http\Controllers\Admin\HotelController@getHotelFacility')->name('getHotelFacility');
		Route::post('hotel/facility', 'App\Http\Controllers\Admin\HotelController@eddHotelFacility')->name('eddHotelFacility');
		Route::post('hotel/room/update', 'App\Http\Controllers\Admin\HotelController@EditRoomType')->name('EditRoomType');
		Route::get('hotel/category', 'App\Http\Controllers\Admin\HotelController@getRoomCategory')->name('getRoomCat');
		Route::get('hotel/hotelroom', 'App\Http\Controllers\Admin\HotelController@getRoomApplied')->name('getRoomApplied');
		Route::get('hotel/hotelrate', 'App\Http\Controllers\Admin\HotelController@getHotelRoomRate')->name('getHotelRoomRate');
		Route::get('hotel/add/hotel-rate/{hotelId}/{roomId}', 'App\Http\Controllers\Admin\HotelController@getHotelRate')->name('getHotelRate');
		Route::post('hotel/add/hotel-rate/', 'App\Http\Controllers\Admin\HotelController@addRoomRate')->name('addRoomRate');
		Route::GET('hotel/update/hotel-rate/', 'App\Http\Controllers\Admin\HotelController@updateRoomRate')->name('updateRoomRate');
		Route::post('hotel/hotelrate', 'App\Http\Controllers\Admin\HotelController@serachHotelRate')->name('serachHotelRate');

		Route::get('hotel/row/hotel-rate-price', 'App\Http\Controllers\Admin\HotelController@getRatePrice')->name('getRatePrice');		
		Route::get('hotel/edit/hotel-rate/{hotelId}/{roomId}', 'App\Http\Controllers\Admin\HotelController@getEdiRoomRate')->name('getEditHotelRate');

		Route::get('blog', 'App\Http\Controllers\Admin\BlogController@index')->name('blogindex');
		Route::get('blog/create', 'App\Http\Controllers\Admin\BlogController@create')->name('blogcreate');
		Route::POST('blog/store', 'App\Http\Controllers\Admin\BlogController@store')->name('blogstore');
		Route::get("blog/update/{id}", 'App\Http\Controllers\Admin\BlogController@edit')->name('blogedit');
		Route::POST("blog/update/{id}", 'App\Http\Controllers\Admin\BlogController@update')->name('blogupdate');

		Route::get('tours', 'App\Http\Controllers\Admin\TourController@tourList')->name('tourList');
		Route::get('cities/{country}', 'App\Http\Controllers\Admin\AdminController@getCities');
		Route::get('hotels/{country}', 'App\Http\Controllers\Admin\AdminController@getHotels');
		Route::get('flights/{country}', 'App\Http\Controllers\Admin\AdminController@getflights');
		Route::get('golfs/{country}', 'App\Http\Controllers\Admin\AdminController@getGolfs');
		Route::get('restaurants/{city}', 'App\Http\Controllers\Admin\AdminController@getRestaurants');
		Route::get('get_sup_name/{bus_id}','App\Http\Controllers\Admin\ReportController@getSupName');

		Route::get('tour/create/new', 'App\Http\Controllers\Admin\TourController@tourForm')->name('tourForm');
		Route::post('tour/create', 'App\Http\Controllers\Admin\TourController@tourCreate')->name('tourCreate');
		Route::get('tour/update/{tourid}/tour', 'App\Http\Controllers\Admin\TourController@getTourUpdate')->name('getTourUpdate');
		Route::post('tour/updateTour', 'App\Http\Controllers\Admin\TourController@updateTour')->name('updateTour');
		Route::get('tourtype', 'App\Http\Controllers\Admin\TourController@getTourtype')->name('getTourtype');
		Route::get('tourtype/edit', 'App\Http\Controllers\Admin\TourController@getTourTypeedit')->name('getTourTypeedit');
		Route::post("create/tourtype", "App\Http\Controllers\Admin\TourController@createTourType")->name('createTourType');
		Route::get('tour/add/price/{tourid}', 'App\Http\Controllers\Admin\TourController@getTourPrice')->name('getTourPrice');
		Route::get('tour/update/price/{tourid}', 'App\Http\Controllers\Admin\TourController@getTourPriceEdit')->name('getTourPriceEdit');
		Route::post('tour/add/price', 'App\Http\Controllers\Admin\TourController@addTourPrice')->name('addTourPrice');
		Route::post('tour/update/price', 'App\Http\Controllers\Admin\TourController@updateTourPrice')->name('updateTourPrice');

		Route::get('tour/tour-report/{tourid}/{type}', 'App\Http\Controllers\Admin\TourController@getTourReport')->name('getTourReport');
		Route::get('supplier/report/{supplierId}/{supType}', 'App\Http\Controllers\Admin\SupplierController@getSupplierReport')->name('supplierReport');
		Route::post('supplier/report/{supplierId}/{supType}', 'App\Http\Controllers\Admin\SupplierController@sortHotelRateReport')->name('sortHotelRateReport');
		Route::get('supplier/restautant/info', 'App\Http\Controllers\Admin\SupplierController@getRestautantinfo')->name('getRestautantinfo');

		Route::get('report/supplier_booked', 'App\Http\Controllers\Admin\ReportController@reportSupplierBooked')->name('supplierBooked');


		Route::get('supplier/download/{supplierId}/pdf', 'App\Http\Controllers\Admin\SupplierController@getSupplierDownload')->name('getDownload');
		Route::get('cruise/program/{supplierId}', 'App\Http\Controllers\Admin\CruiseController@getCruiseProgram')->name('getCruiseProgram');
		Route::post('cruise/program/create', 'App\Http\Controllers\Admin\CruiseController@createCruiseProgram')->name('getCrProgram');
		Route::get('cruise/program', 'App\Http\Controllers\Admin\CruiseController@getProgram')->name('getProgram');
		Route::get('cruise/program/{cruiseid}/{programid}', 'App\Http\Controllers\Admin\CruiseController@getProgramEdit')->name('getProgramEdit');
		Route::post('cruise/update/program', 'App\Http\Controllers\Admin\CruiseController@updateCruiseProgram')->name('updateCrprogram');
		Route::get('cruise/applied/cabin', 'App\Http\Controllers\Admin\CruiseController@getCrCabin')->name('getCabin');
		Route::get('cruise/cabin', 'App\Http\Controllers\Admin\CruiseController@getCabin')->name('crCabin');
		
		Route::get('cruise/cabin/{proid}/{cabId}/apply', 'App\Http\Controllers\Admin\CruiseController@getApplyCrCabin')->name('applyCabin');
		Route::get('cruise/cabin/{proid}/{cabId}/apply/edit', 'App\Http\Controllers\Admin\CruiseController@getCrCabinEdit')->name('editCabin');
		Route::post('cruise/apply/cabin', 'App\Http\Controllers\Admin\CruiseController@applyCabinprice')->name('applyCabinprice');
		Route::post('cruise/cabin/update', 'App\Http\Controllers\Admin\CruiseController@updateCabinprice')->name('updateCabinprice');
		Route::get('cruise/cabin/price', 'App\Http\Controllers\Admin\CruiseController@getCabinprice')->name('getCabinprice');

		Route::get('hotel/apply/room/{hotelId}', 'App\Http\Controllers\Admin\HotelController@getRoomApply')->name('getRoomApply');
		Route::post('hotel/apply/room/now', 'App\Http\Controllers\Admin\HotelController@getRoomApplyNow')->name('getRoomApplyNow');
		Route::get('add/booking/row', 'App\Http\Controllers\Admin\AdminController@addBookinOption')->name('add_row');
		Route::get('option/remove', 'App\Http\Controllers\Admin\AdminController@getOptionDelete')->name('optionRemove');
		Route::get('option/find', 'App\Http\Controllers\Admin\AdminController@getFilter')->name('getFilter');
		Route::get('option/findlocaiton', 'App\Http\Controllers\Admin\AdminController@getOptionfind')->name('getOptionfind');
		Route::get('changebooking/status', 'App\Http\Controllers\Admin\OperationController@changebookingStatus');	
 
		Route::get("booking/hotelrate/find", "App\Http\Controllers\Admin\AdminController@bookingHotelRate")->name('bookingHotelRate');

		Route::get("hotelrate/remve/{hotel}/{booking}/{type}", "App\Http\Controllers\Admin\AdminController@delPriceRate")->name('RhPrice');
		// report section
		Route::get('report',"Admin\ReportController@tourReport")->name('report');
		Route::post("report", "Admin\ReportController@searchReport")->name("searchReport");
		Route::get('hotel/booking/{project}/{hotelid}/{bookid}/{action}',"Admin\ReportController@getHotelVoucher")->name('hVoucher');

		Route::get("project/booked/{projectNo}/{type}", "App\Http\Controllers\Admin\ReportController@getProjectBooked")->name('getProjectBooked');

		Route::get('project/report/{project}/{type}',"App\Http\Controllers\Admin\ReportController@getPreviewProject")->name('previewProject');
		Route::get("project/daily-operation-chart", "App\Http\Controllers\Admin\ReportController@getOperationDailyChart")->name('OpsDailyChart');

		Route::post("project/daily-operation-chart", "App\Http\Controllers\Admin\ReportController@searchOperationDailyChart")->name('searchPOSDailyChart');
		Route::get('project/invoice/{project}/{type}',"App\Http\Controllers\Admin\ReportController@getInvoice")->name('getInvoice');

		Route::get('arrival_report',"App\Http\Controllers\Admin\ReportController@getClientarrival")->name('clientArrival');
		Route::get('gross_p&l',"App\Http\Controllers\Admin\ReportController@getgrossprofit_loss")->name('gross_p&l');
		Route::get('quotation',"App\Http\Controllers\Admin\ReportController@getQuotation")->name('getQuotation');

		Route::post("arrival_report", "App\Http\Controllers\Admin\ReportController@searchArrival")->name("searchArrival");
		Route::get("statement", "App\Http\Controllers\Admin\ReportController@statement")->name("statement");
		Route::post("statement", "App\Http\Controllers\Admin\ReportController@searchStatement")->name("searchStatement");
		Route::get("payment_report", "App\Http\Controllers\Admin\ReportController@payment_report")->name("payment_report");
		Route::get("changestatus/{projectNum}","App\Http\Controllers\Admin\AdminController@changestatus")->name("changestatus");
		Route::post("gross_p&l", "App\Http\Controllers\Admin\ReportController@searchGross")->name("searchGross");

		Route::get('operation/{type}/voucher/{projectNo}/{ospBid}', 'App\Http\Controllers\Admin\OperationController@opsVoucher')->name('opsVoucher');
		Route::get('operation/{type}/reservation/{projectNo}/{ospBid}', 'App\Http\Controllers\Admin\OperationController@opsReservation')->name('opsReservation');
		Route::get('booking/{operation}/{project}', 'App\Http\Controllers\Admin\OperationController@applyOperation')->name('getops');
		Route::get('booking/{type}/{project}/{supplier_id}', 'App\Http\Controllers\Admin\OperationController@bookingTransport')->name('getBookingVoucher');
		Route::post('booking/applied/transport', 'App\Http\Controllers\Admin\OperationController@assignTransport')->name('assignTransport');
		Route::post('booking/applied/restuatant', 'App\Http\Controllers\Admin\OperationController@assignResturant')->name('assignRestuarant');
		Route::post('booking/applied/entrance', 'App\Http\Controllers\Admin\OperationController@assignEntrance')->name('assignEntrance');
		Route::post("booking/updateTeetime", "App\Http\Controllers\Admin\OperationController@updateTeetime")->name('updateTeetime');
		Route::post('booking/applied/guide', 'App\Http\Controllers\Admin\OperationController@assignGuide')->name('assignGuide');
		Route::post('booking/applied/misc', 'App\Http\Controllers\Admin\OperationController@assignMisc')->name('assignMisc');

		Route::get('restautant/voucher/{project}/{restbooked}', 'App\Http\Controllers\Admin\OperationController@restVoucher')->name('restVoucher');
		Route::get('restautant/booking/{project}/{restbooked}', 'App\Http\Controllers\Admin\OperationController@restBooking')->name('restBooking');
		Route::get('project/report-request/{projectNo}', 'App\Http\Controllers\Admin\OperationController@getReportRequest')->name('requestReport');

		Route::get('window/uploaded', 'App\Http\Controllers\Admin\UploadController@fileUploaded')->name('fileUploaded');
		Route::get('window/remove/fileUploaded', 'App\Http\Controllers\Admin\UploadController@removeFile')->name('removeFile');
		Route::post("window/uploadfile", 'App\Http\Controllers\Admin\UploadController@uploadfile')->name('uploadfile');
		Route::post("window/uploadfile/only", 'App\Http\Controllers\Admin\UploadController@uploadOnlyFile')->name('uploadOnlyFile');
		Route::get("window/remove-image/logo", 'App\Http\Controllers\Admin\UploadController@RemoveLogo')->name('RemoveLogo');
		
		//SupplierbyBusiness_id
		Route::get("supplierbybus/{bus_id}",'App\Http\Controllers\Admin\SupplierController@getsupplierbybus');
		//chartofAccount
		Route::get('chartofaccount', 'App\Http\Controllers\Account\AccountController@chartofAccount')->name('chartofaccount');	
		Route::get('account/accForm', 'App\Http\Controllers\Account\AccountController@accForm')->name('accForm');
		Route::post("addNewAccount", "App\Http\Controllers\Account\AccountController@addNewAccount")->name("addNewAccount");
		Route::get('account/editAccForm/{id}', 'App\Http\Controllers\Account\AccountController@editAccForm')->name('editAccForm');
		Route::post("updateAcc/{id}", "App\Http\Controllers\Account\AccountController@updateAcc")->name("updateAcc");
		Route::get('removeaccount/{id}',"App\Http\Controllers\Account\AccountController@removeAcc")->name("removeAcc");

		//view Client List
		Route::get('viewClientList/{projectno}',"App\Http\Controllers\Admin\ProjectController@viewClientList")->name("viewClientList");
		//additional invoice
		Route::POST("addAdditionalInvoice", 'App\Http\Controllers\Admin\ProjectController@addAdditionalInvoice')->name('addAdditionalInvoice');
}); 
 

// ===============ACCOUNT SECTION========================================
Route::group(["middleware" => ["IsAccount"]], function(){
	Route::prefix("finance")->group(function () { 
		Route::get("/", "App\Http\Controllers\Account\JournalController@getJournal")->name("finance");
		Route::get("receivable/create", "App\Http\Controllers\Account\AccountController@getAccountReceivable")->name("getAccountReceivable");
		Route::get('report/{slug}', 'App\Http\Controllers\Account\ReportController@index')->name('index');
		Route::get("account-statement", 'App\Http\Controllers\Account\JournalController@getAccountStatement')->name('accountStatement'); 
		Route::get("balance-sheet", 'App\Http\Controllers\Account\JournalController@getBalanceSheet')->name('getBalanceSheet');
		// Route::get("Proj", "Account\AccountController@getAccountReceivable")->name("getAccountReceivable");
		Route::get("gross-profit-p&l", "App\Http\Controllers\Account\JournalController@getGrossProfitePL")->name("getGrossProfitePL");
		Route::POST("gross-profit-p&l", "App\Http\Controllers\Account\JournalController@searchGrossProfitPL")->name("searchGrossProfitPL");
		Route::get("gross-profit-p&l_preview", "App\Http\Controllers\Account\JournalController@getGrossProfitePLPreview")->name("getGrossProfitePLPreview");

		Route::get("posting-preview/{pro_no}/{type}", "App\Http\Controllers\Account\AccountController@previewPosting")->name("previewPosting");
		Route::get("project-preview", "App\Http\Controllers\Account\JournalController@getProjectPreview")->name("getProjectPreview");
		Route::get("posting", "App\Http\Controllers\Account\AccountController@getPostingAccount")->name("getPostingAccount");
		Route::post("posting", "App\Http\Controllers\Account\AccountController@findPostingAccount")->name("findPostingAccount");

		Route::get("payable/create", "App\Http\Controllers\Account\AccountController@getPayable")->name("getPayable");
		Route::get("accountPayable/{view_type}", "App\Http\Controllers\Account\AccountController@accountPayable")->name("accountPayable");
		Route::get("preivew_posted", "App\Http\Controllers\Account\AccountController@PreviewPosted")->name("PreviewPosted");
		Route::get("opening-balance", "App\Http\Controllers\Account\AccountController@openBalance")->name("openBalance");
		// Route::post("accountPayable", "Account\AccountController@searchPosted")->name("searchPosted");
		Route::get("journal", "App\Http\Controllers\Account\JournalController@getJournal")->name("journalList");
		Route::get("office-supplier", "App\Http\Controllers\Account\JournalController@getOfficeSupplier")->name("getOfficeSupplier");
		Route::get("journal/create", "App\Http\Controllers\Account\AccountController@getJournalJson")->name("getJournalJson");

		Route::get("outstanding", "App\Http\Controllers\Account\JournalController@getOutstanding")->name("getOutstanding");
		Route::get("trial-balance", "App\Http\Controllers\Account\JournalController@getTrialBalance")->name("getTrialBalance");
		
		Route::post("make-to-journal", "App\Http\Controllers\Account\AccountController@makeToJournal")->name("makeToJournal");


		Route::post("createReceivable", "App\Http\Controllers\Account\AccountController@createReceivable")->name("createReceivable");
		Route::post("editjournal-entry", "App\Http\Controllers\Account\AccountController@editJournal")->name("editJournal");
		Route::post("createJournal", "App\Http\Controllers\Account\AccountController@createJournal")->name("createJournal");
		Route::post("addAccountName", "App\Http\Controllers\Account\AccountController@addNewAccount")->name("addNewAccount");

		Route::post("createPayable", "App\Http\Controllers\Account\AccountController@createPayment")->name("createPayment");
		
		Route::post("addBankTransfer", "App\Http\Controllers\Account\AccountController@addBankTransfer")->name("addBankTransfer");

		Route::get("findOption",  "App\Http\Controllers\Account\OptionController@loadData")->name("loadData");	
		Route::get("filter_data", "App\Http\Controllers\Account\OptionController@filterData")->name("filterAccount");
		Route::get("removeOption",  "App\Http\Controllers\Account\OptionController@RemoveOption")->name("RemoveOption");	
		Route::get("BankTransfer", "App\Http\Controllers\Account\AccountController@getTransferForm")->name('transfer_form');
		Route::get("bank-preview/report", "App\Http\Controllers\Account\AccountController@getBankPreview")->name('getBankPreview');
		Route::get("getBankTransferred", "App\Http\Controllers\Account\AccountController@getBankTransferred")->name("getBankTransferred");
 
		// json string date_add()
		Route::get("accountjournal", "App\Http\Controllers\Account\AccountController@getJournalList")->name("getJournalList");
		Route::get("journal-entry", "App\Http\Controllers\Account\AccountController@getJournalEntry")->name("getJournalEntry");
		Route::get("accountjournalsingle", "App\Http\Controllers\Account\AccountController@getJournalEdit")->name("getJournalEdit");

		// report  
		Route::get("journal/view", "App\Http\Controllers\Account\JournalController@getJournalReport")->name("getJournalReport");
		Route::get("cash-book", "App\Http\Controllers\Account\JournalController@getCashbook")->name("getCashBook");
		Route::get("daily-cash-book", "App\Http\Controllers\Account\JournalController@getDailytCashbook")->name("getDailytCashbook");

		Route::post("udpateExchangeRate", "App\Http\Controllers\Account\AccountController@udpateExchangeRate")->name("udpateExchangeRate");

		Route::get("report", "App\Http\Controllers\Account\JournalController@getAccountReport")->name("getAccountReport");

		Route::get("profit-and-loss", "App\Http\Controllers\Account\JournalController@getProfitAndLoss")->name("getProfitAndLoss"); 
		Route::get("pnlbysegment", "App\Http\Controllers\Account\JournalController@pnlbysegment")->name("pnlbysegment");
		Route::post("pnlbysegment", "App\Http\Controllers\Account\JournalController@searchPnlbysegment")->name("searchPnlbysegment");
		
		Route::get("bank", "App\Http\Controllers\Admin\ThemeController@getBank")->name('getBank');
		Route::get("bank/add", "App\Http\Controllers\Admin\ThemeController@getBankForm")->name('getBankForm');
		Route::post("bank/add", "App\Http\Controllers\Admin\ThemeController@addBankInfo")->name('addBankInfo');
		// Route::get("journal/report", "Account\JournalController@getJouralReport")->name("getJouralReport");


		
		Route::get("payment_getway", "App\Http\Controllers\Account\PaymentController@getPaymentLink")->name('getPaymentLink');
		Route::get("create/payment_getway", "App\Http\Controllers\Account\PaymentController@createPaymentLink")->name('createPaymentLink');
		Route::post("add/payment_getway", "App\Http\Controllers\Account\PaymentController@addPaymentLink")->name('addPaymentLink');
		Route::post("add/payment_getways", "App\Http\Controllers\Account\PaymentController@editPaymentLink")->name('editPaymentLink');
		

		Route::post("add-new-account", "App\Http\Controllers\Account\AccountController@createAccountName")->name('createAccountName');

		Route::post("add-new-supplier", "App\Http\Controllers\Account\AccountController@AddNewSupplier")->name('AddNewSupplier');
		Route::get("email_sent", function(){
			return view("emails.payment.paymentlinkShipped");
		});
	});
}); 

Route::get("return_payment", "App\Http\Controllers\Account\PaymentController@paymentReturnData")->name('paymentReturnData');
Route::get("payment-view/{id}", "App\Http\Controllers\Account\PaymentController@getPaymentView")->name('getPaymentView');
Route::post("payment/payment_submit", "App\Http\Controllers\Account\PaymentController@paymentSubmit")->name('paymentSubmit');