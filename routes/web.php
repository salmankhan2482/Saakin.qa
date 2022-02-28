<?php

use App\AmenityProduct;
use App\City;
use App\Types;
use App\PageVisits;
use App\Properties;
use App\Mail\TestMail;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
use App\Mail\MyCustomMail;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BlogController;
use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\ClickCountersController;
use App\Http\Controllers\PropertyReportController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\OmahadminController;

// use App\Http\Controllers\Admin\ClickCountersController;


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

Route::get('clear', function(){
    Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
});


//route to changes buy and sell featured products on home page
Route::get('/select/buyRent/for/search/{purpose}', 'IndexController@selectBuyRentForSearch');

Route::get('auth/google', 'SocialController@redirectToGoogle')->name('google.login');
Route::get('auth/facebook', 'SocialController@redirectToFacebook')->name('facebook.login');

Route::get('auth/google/callback', 'SocialController@handleGoogleCallback');
Route::get('auth/facebook/callback', 'SocialController@handleFacebookCallback');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/new', 'OmahadminController@dashboard_1');
	Route::post('login', 'IndexController@postLogin');
	Route::get('logout', 'IndexController@logout');

    Route::get('/our_backup_database', 'UserController@dbBackup')->name('our_backup_database');

    //menu options
    Route::resource('menuOptions','MenuOptionsController');
    Route::get('menuOptions/delete/{id}','MenuOptionsController@destroy')->name('menuOptions.destroy');

    //permissions
    Route::resource('permissions','PermissionsController');
    Route::get('permissions/delete/{id}','PermissionsController@destroy')->name('permissions.destroy');
    
    //permissions
    Route::resource('roles','RolesController');
    Route::get('roles/delete/{id}','RolesController@destroy')->name('roles.destroy');


	Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
	Route::get('profile', 'AdminController@profile');
	Route::post('profile', 'AdminController@updateProfile');
	Route::post('profile_pass', 'AdminController@updatePassword');
    Route::resource('property_type', Controller::class);
	Route::get('settings', 'SettingsController@settings');
	Route::post('settings', 'SettingsController@settingsUpdates');
	Route::post('smtp_email', 'SettingsController@smtp_email_update');
	Route::post('payment_info', 'SettingsController@payment_info_update');
	Route::post('layout_settings', 'SettingsController@layout_settings_update');
	Route::post('social_links', 'SettingsController@social_links_update');
	Route::post('addthisdisqus', 'SettingsController@addthisdisqus');
	Route::post('about_us', 'SettingsController@about_us_page');
	Route::post('contact_us', 'SettingsController@contact_us_page');
	Route::post('headfootupdate', 'SettingsController@headfootupdate');

	Route::get('slider', 'SliderController@sliderlist');
	Route::get('slider/addslide', 'SliderController@addeditSlide');
	Route::post('slider/addslide', 'SliderController@addnew');
	Route::get('slider/addslide/{id}', 'SliderController@editSlide');
	Route::get('slider/delete/{id}', 'SliderController@delete');


	Route::get('testimonials', 'TestimonialsController@testimonialslist');
	Route::get('testimonials/addtestimonial', 'TestimonialsController@addeditestimonials');
	Route::post('testimonials/addtestimonial', 'TestimonialsController@addnew');
	Route::get('testimonials/addtestimonial/{id}', 'TestimonialsController@edittestimonial');
	Route::get('testimonials/delete/{id}', 'TestimonialsController@delete');


	Route::get('properties', 'PropertiesController@propertieslist')->name('property_listview');
	Route::get('inactive_properties_listing', 'PropertiesController@inactivepropertieslist')->name('inactive_property_listview');
	Route::post('properties/featured/delete', 'PropertiesController@deleteFeaturedImage')->name('delete.featured_image');
	Route::get('properties/create', 'PropertiesController@create');
	Route::post('properties/create', 'PropertiesController@store');
	Route::get('properties/edit/{id}', 'PropertiesController@edit');
    Route::post('properties/edit/{id}', 'PropertiesController@update');
	Route::get('properties/status/{id}', 'PropertiesController@status');
	Route::get('properties/featuredproperty/{id}', 'PropertiesController@featuredproperty');
	Route::any('properties/delete/{id}', 'PropertiesController@delete');
	Route::get('featuredproperties', 'FeaturedPropertiesController@propertieslist');
    Route::get('pendingproperties', 'FeaturedPropertiesController@pendingproperties');
	Route::get('properties/export', 'PropertiesController@property_export');
	Route::post('properties/plan_update', 'PropertiesController@plan_update');

    Route::get('properties/gallery/{id}', 'PropertiesController@listGalleryImages');
    Route::get('properties/generatethumb', 'PropertiesController@generatethumb');
    Route::get('properties/gallery/{id}/create', 'PropertiesController@addGalleryImages');
    Route::post('properties/gallery/{id}/create', 'PropertiesController@storeGalleryImages');
    Route::get('properties/gallery/{id}/edit/{gid}', 'PropertiesController@editGalleryImages');
    Route::post('properties/gallery/{id}/edit/{gid}', 'PropertiesController@updateGalleryImages');
    Route::get('properties/gallery/{id}/delete/{gid}', 'PropertiesController@destroyGalleryImages');

    Route::get('scrapper', 'ScrapperController@index');
    Route::get('properties/neighbourhood/{id}', 'PropertiesController@listNeighbourhood');
    Route::get('properties/neighbourhood/{id}/create', 'PropertiesController@addNeighbourhood');
    Route::post('properties/neighbourhood/{id}/create', 'PropertiesController@storeNeighbourhood');
    Route::get('properties/neighbourhood/{id}/edit/{gid}', 'PropertiesController@editNeighbourhood');
    Route::post('properties/neighbourhood/{id}/edit/{gid}', 'PropertiesController@updateNeighbourhood');
    Route::get('properties/neighbourhood/{id}/delete/{gid}', 'PropertiesController@destroyNeighbourhood');

    Route::get('properties/floor-plan/{id}', 'PropertiesController@listFloorPlan');
    Route::get('properties/floor-plan/{id}/create', 'PropertiesController@addFloorPlan');
    Route::post('properties/floor-plan/{id}/create', 'PropertiesController@storeFloorPlan');
    Route::get('properties/floor-plan/{id}/edit/{gid}', 'PropertiesController@editFloorPlan');
    Route::post('properties/floor-plan/{id}/edit/{gid}', 'PropertiesController@updateFloorPlan');
    Route::get('properties/floor-plan/{id}/delete/{gid}', 'PropertiesController@destroyFloorPlan');

    Route::get('types', 'TypesController@typeslist');
    Route::get('types/addtypes', 'TypesController@addedittypes');
    Route::post('types/addtypes', 'TypesController@addnew');
    Route::get('types/addtypes/{id}', 'TypesController@edittypes');
    Route::get('types/delete/{id}', 'TypesController@delete');

    Route::get('property-purpose', 'PropertyPurposeController@index');
    Route::get('property-purpose/create', 'PropertyPurposeController@create');
    Route::post('property-purpose/create', 'PropertyPurposeController@store');
    Route::get('property-purpose/edit/{id}', 'PropertyPurposeController@edit');
    Route::post('property-purpose/update/{id}', 'PropertyPurposeController@update');
    Route::get('property-purpose/delete/{id}', 'PropertyPurposeController@destroy');

    Route::get('property-amenity', 'PropertyAmenityController@index');
    Route::get('property-amenity/create', 'PropertyAmenityController@create');
    Route::post('property-amenity/create', 'PropertyAmenityController@store');
    Route::get('property-amenity/edit/{id}', 'PropertyAmenityController@edit');
    Route::post('property-amenity/update/{id}', 'PropertyAmenityController@update');
    Route::get('property-amenity/delete/{id}', 'PropertyAmenityController@destroy');

	Route::get('users', 'UsersController@userslist')->name('users.index');
	Route::get('users/adduser', 'UsersController@addUser');
	Route::post('users/adduser', 'UsersController@addnew');
	Route::get('users/edituser/{id}', 'UsersController@editUser');
    Route::post('users/edituser/{id}', 'UsersController@updateUser');
    Route::get('users/view_user/{id}', 'UsersController@view_user');
	Route::get('users/delete/{id}', 'UsersController@delete');
	Route::get('users/export', 'UsersController@user_export');


	Route::get('subscriber', 'SubscriberController@subscriberlist');
	Route::get('subscriber/delete/{id}', 'SubscriberController@delete');


	Route::get('partners', 'PartnersController@partnerslist');
	Route::get('partners/addpartners', 'PartnersController@addpartners');
	Route::post('partners/addpartners', 'PartnersController@addnew');
	Route::get('partners/addpartners/{id}', 'PartnersController@editpartners');
	Route::get('partners/delete/{id}', 'PartnersController@delete');

	Route::get('inquiries', 'InquiriesController@inquirieslist');

    Route::get('property_inquiries', 'InquiriesController@property_inquiries');
    Route::get('inquiry/create', 'InquiriesController@create_inquiry');
    Route::post('inquiry/create', 'InquiriesController@store_property_inquiry');
    Route::get('property_inquiry/edit/{id}', 'InquiriesController@edit_property_inquiry');
    Route::post('property_inquiry/update/{id}', 'InquiriesController@_property_inquiry');

	
	Route::get('agency_inquiries', 'InquiriesController@agency_inquiries');
	Route::get('contact_inquiries', 'InquiriesController@contact_inquiries');
    
    Route::get('view_inquiry/{id}', 'InquiriesController@view_inquiry');
    Route::get('view_property_inquiry/{id}', 'InquiriesController@view_property_inquiry');
    Route::get('view_agency_inquiry/{id}', 'InquiriesController@view_agency_inquiry');
    Route::get('view_contact_inquiry/{id}', 'InquiriesController@view_contact_inquiry');   

	Route::get('inquiries/delete/{id}', 'InquiriesController@delete');

	Route::get('subscription_plan', 'SubscriptionPlanController@subscription_plan_list');
	Route::get('subscription_plan/add_plan', 'SubscriptionPlanController@addSubscriptionPlan');
	Route::get('subscription_plan/edit_plan/{id}', 'SubscriptionPlanController@editSubscriptionPlan');
	Route::post('subscription_plan/add_edit_plan', 'SubscriptionPlanController@addnew');
	Route::get('subscription_plan/delete/{id}', 'SubscriptionPlanController@delete');

	Route::get('transactions', 'TransactionsController@transactions_list');
	Route::get('transactions/export', 'TransactionsController@transactions_export');
	Route::get('transactions/user_invoice/{id}', 'TransactionsController@user_invoice');

	Route::get('about_page', 'PagesController@about_page');
	Route::post('about_page', 'PagesController@update_about_page');
	Route::get('terms_page', 'PagesController@terms_page');
	Route::post('terms_page', 'PagesController@update_terms_page');
	Route::get('privacy_policy_page', 'PagesController@privacy_policy_page');
	Route::post('privacy_policy_page', 'PagesController@update_privacy_policy_page');
	Route::get('faq_page', 'PagesController@faq_page');
	Route::post('faq_page', 'PagesController@update_faq_page');

    Route::get('properties_for_purpose_page', 'PagesController@properties_for_purpose_page');
    Route::post('properties_for_purpose_page', 'PagesController@update_properties_for_purpose_page');

    Route::get('property_type_for_purpose_page', 'PagesController@property_type_for_purpose_page');
    Route::post('property_type_for_purpose_page', 'PagesController@update_property_type_for_purpose_page');

    Route::get('city_property_type_purpose_page', 'PagesController@city_property_type_purpose_page');
    Route::post('city_property_type_purpose_page', 'PagesController@update_city_property_type_purpose_page');

    Route::get('featured_properties_page', 'PagesController@featured_properties_page');
    Route::post('featured_properties_page', 'PagesController@update_featured_properties_page');

    Route::get('api-data', 'ApiController@index');
    Route::post('api-category', 'ApiController@getCategory');

    /////////////////////////// jaleel //////////////////////////////

    Route::get('cities', 'CityGuideController@index');
    Route::get('city/create', 'CityGuideController@create');
    Route::post('city/create', 'CityGuideController@store');
     Route::get('city/show/{id}', 'CityGuideController@show');
    Route::get('city/edit/{id}', 'CityGuideController@edit');
    Route::post('city/update/{id}', 'CityGuideController@update');
    Route::get('city/delete/{id}', 'CityGuideController@destroy');

    Route::get('city-detail/list', 'CityGuideController@listCityDetail');
    Route::get('city-detail/create', 'CityGuideController@createCityDetail');
    Route::post('city-detail/create', 'CityGuideController@storeCityDetail');
    Route::get('city-detail/edit/{id}', 'CityGuideController@editCityDetail');
    Route::post('city-detail/update/{id}', 'CityGuideController@updateCityDetail');
    Route::get('city-detail/delete/{id}', 'CityGuideController@destroyCityDetail');

    Route::get('blogs', 'BlogController@index')->name('blogs.index');
    Route::get('blog/create', 'BlogController@create');
    Route::post('blog/create', 'BlogController@store');
    Route::get('blog/edit/{id}', 'BlogController@edit');
    Route::post('blog/update/{id}', 'BlogController@update');
    Route::get('blog/delete/{id}', 'BlogController@destroy');

    Route::get('blog-category/list', 'BlogController@listBlogCategory')->name('blog-category');
    Route::get('blog-category/create', 'BlogController@createBlogCategory');
    Route::post('blog-category/create', 'BlogController@storeBlogCategory');
    Route::get('blog-category/edit/{id}', 'BlogController@editBlogCategory');
    Route::post('blog-category/update/{id}', 'BlogController@updateBlogCategory');
    Route::get('blog-category/delete/{id}', 'BlogController@destroyBlogCategory');

    Route::get('agencies', 'AgencyController@index')->name('agencies.index');

    Route::get('agency/create', 'AgencyController@create');
    Route::post('agency/create', 'AgencyController@store');
    Route::get('agency/edit/{id}', 'AgencyController@edit');
    Route::post('agency/update/{id}', 'AgencyController@update');
    Route::get('agency/delete/{id}', 'AgencyController@destroy');
    Route::post('agency/keys', 'AgencyController@goMasterimport')->name('get.agences.keys');
    Route::get('agencies/export', 'AgencyController@agencies_export')->name('agencies.export');
    Route::post('agencies/import', 'AgencyController@agencies_import')->name('agencies.import');

    Route::get('landing-pages', 'LandingPagesController@index');
    Route::get('landing-pages/create', 'LandingPagesController@create');
    Route::post('landing-pages/create', 'LandingPagesController@store');
    Route::get('landing-pages/edit/{id}', 'LandingPagesController@edit');
    Route::post('landing-pages/update/{id}', 'LandingPagesController@update');
    Route::get('landing-pages/delete/{id}', 'LandingPagesController@destroy');

    Route::get('properties-page-content', 'LandingPagesController@properties_page_content');
    Route::post('properties-page-content', 'LandingPagesController@update_properties_page_content');

    Route::get('city-guide-page-content', 'LandingPagesController@city_guide_page_content');
    Route::post('city-guide-page-content', 'LandingPagesController@update_city_guide_page_content');

    Route::get('agencies-page-content', 'LandingPagesController@agencies_page_content');
    Route::post('agencies-page-content', 'LandingPagesController@update_agencies_page_content');
    

    // multi task
    
    //property cities routes
    Route::resource('propertyCities', 'PropertyCitiesController');
    Route::get('propertyCities/delete/{id}', 'PropertyCitiesController@destroy')->name('propertyCities.destroy');
    //property sub cities routes
    Route::resource('propertySubCities', 'PropertySubCitiesController');
    Route::get('propertySubCities/delete/{id}', 'PropertySubCitiesController@destroy')->name('propertySubCities.destroy');
    //property towns routes
    Route::resource('propertyTowns', 'PropertyTownsController');
    Route::get('propertyTowns/delete/{id}', 'PropertyTownsController@destroy')->name('propertyTowns.destroy');
    //property areas routes
    Route::resource('propertyAreas', 'PropertyAreasController');
    Route::get('propertyAreas/delete/{id}', 'PropertyAreasController@destroy')->name('propertyAreas.destroy');

    //property click counter or traffic route
    Route::resource('click_counter', 'ClickCountersController');
    Route::get('agencyTotalClicksList/{id}', 'ClickCountersController@agencyTotalClicksList')->name('agencyTotalClicksList');
    Route::get('traffic_per_month', 'ClickCountersController@trafficPerMonth')->name('traffic_per_month');
    Route::get('agencyTrafficList/{id}', 'ClickCountersController@agencyTrafficList')->name('agencyTrafficList');
    Route::get('trafficUsers', 'ClickCountersController@trafficUsers')->name('trafficUsers');
    Route::get('total_clicks', 'ClickCountersController@totalClicks')->name('total_clicks');
    Route::get('top_Ten_Properties', 'ClickCountersController@topTenProperties')->name('top_Ten_Properties');
    Route::get('top_Ten_Properties/{id}', 'ClickCountersController@topTenPropertiesList')->name('top_Ten_Properties.list');
    Route::get('top_5_areas', 'ClickCountersController@top5Areas')->name('top_5_areas');
    Route::get('top_5_areas/{id}', 'ClickCountersController@top5AreasList')->name('top_5_areas.list');
    Route::get('total_leads', 'ClickCountersController@totalLeads')->name('total_leads');

});

Route::get('/', 'IndexController@index')->name('home');
Route::get('autocomplete/agencies', 'AgenciesController@livesearch');
Route::get('livesearch','IndexController@livesearch');
// Route::get('{slug}', 'PagesController@get_page');

Route::get('about-us','PagesController@about_us');
Route::get('terms-of-use','PagesController@terms_of_use');
Route::get('privacy-policy','PagesController@privacy_policy');
Route::get('faqs','PagesController@faqs');

Route::get('contact-us', 'IndexController@contact_us_page');
Route::post('contact-us', 'IndexController@contact_us_sendemail');

Route::post('subscribe', 'IndexController@subscribe');


// Route::get('agencies', 'AgenciesController@index');
Route::get('real-estate-agencies', 'AgenciesController@index')->name('real-estate-agencies');
Route::post('real-estate-agencies', 'AgenciesController@index')->name('real-estate-agencies');
// Route::post('agency-email','AgenciesController@agency_email');
Route::post('agency-contact','AgenciesController@agency_email');

Route::post('agencies', 'AgenciesController@searchAgencies');
Route::get('agency/{name}/{id}', 'AgenciesController@agencyDetail')->name('agency_detail');
Route::post('agency/email', 'AgenciesController@agencyDetail')->name('email_inquiry');

Route::get('blogs', 'BlogController@index');
Route::post('blogs', 'BlogController@searchBlogs');
Route::get('blog-categories/{slug}', 'BlogController@blogCategories')->name('blog-categories')->where('slug', '[A-Za-z\-\_]+');
Route::get('blog/{slug}', 'BlogController@blogDetail')->name('blog-detail');


Route::get('{property_purpose}/{slug}/{id}', 'PropertiesController@single_properties')->where('id', '[0-9]+')->where('property_purpose', 'rent|sale')->name('property-detail');
Route::any('send-email-agent', 'PropertiesController@property_details_sendemail');


Route::post('properties/inquiry', 'PropertiesController@property_details_sendemail');
Route::get('properties', 'PropertiesController@getPropertyListing');
Route::post('properties', 'PropertiesController@getPropertyListing');

Route::get('city-guide', 'CityGuideController@getCityList');
Route::get('city-guide/{slug}', 'CityGuideController@getCityDetail')->name('cityGuide-detail')
->where('slug', '[A-Za-z\-\_]+');

Route::get('map/{id}', 'PropertiesController@map_property_urlset');

#Route::get('testimonials', 'IndexController@testimonialslist');


Route::get('inquiries', 'UserController@inquirieslist');
Route::get('inquiries/delete/{id}', 'UserController@delete');

Route::post('agentscontact', 'PropertiesController@agentscontact');
Route::post('search-properties', 'PropertiesController@searchProperties');

Route::get('login', [ 'as' => 'login', 'uses' => 'IndexController@login']);
Route::post('login', 'IndexController@postLogin');

Route::get('register', 'IndexController@register');
Route::post('register', 'IndexController@postRegister');

Route::get('logout', 'IndexController@logout');

Route::get('dashboard', 'UserController@dashboard');
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@profile_update');
Route::get('change_pass', 'UserController@change_pass');
Route::post('update_password', 'UserController@updatePassword');

Route::get('my_properties', 'PropertiesController@my_properties');

Route::get('submit-property', 'PropertiesController@add_property_form');
Route::post('submit-property', 'PropertiesController@addnew')->name('add-new-property');
Route::post('property/gallery', 'PropertiesController@uploadImage')->name('property.gallery');
Route::get('update-property/{id}', 'PropertiesController@editproperty');
Route::get('delete/{id}', 'PropertiesController@delete');
Route::get('gallery_image_delete/{id}', 'PropertiesController@gallery_image_delete');

Route::get('invoice', 'TransactionController@transaction_list');
Route::get('user_invoice/{id}', 'TransactionController@user_invoice');

Route::get('plan/{id}', 'UserController@plan_list');
Route::post('plan_send', 'UserController@plan_send');
Route::get('plan_summary', 'UserController@plan_summary');
Route::post('payment_send', 'UserController@payment_send');

//Route::get('paypal_payment', 'PaypalController@payWithPaypal');
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'PaypalController@getPaymentStatus',));

Route::get('stripe', 'StripeController@payWithStripe');
Route::post('stripe', 'StripeController@postPaymentWithStripe');
//Route::post('stripe/charge', 'StripeController@paymentWithStripe');

Route::post('razorpay-success', 'RazorpayController@payment_success');

Route::post('pay', 'PaystackController@redirectToGateway')->name('pay');
Route::get('payment/callback', 'PaystackController@handleGatewayCallback');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('password.email');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.email.post');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.reset');;

Route::get('auth/confirm/{code}', 'IndexController@confirm');
Route::get('/sitemap.xml', 'IndexController@sitemap');

// buyRent First Url
Route::get('{type}/properties-for-{property_purpose}', 'PropertiesController@propertiesForPurpose')
->where(['type' => 'buy|rent', 'property_purpose' => 'sale|rent'])->name('property-purpose');

// buyRent second url
Route::get('{type}/{property}', 'PropertiesController@propertyTypeForPurpose')
->where(['type' => 'buy|rent'])->name('property-type-purpose');

// thirdl url
Route::get('{type}/{city}/{property_type_purpose}', 'PropertiesController@cityPropertyTypeForPurpose')
->where(['type' => 'buy|rent'])->name('cpt-purpose');


// featured/properties url
Route::get('featured-properties', 'PropertiesController@featureProperties')->name('featured-properties');


//property reports
Route::resource('admin/properties_reports', 'PropertyReportController');

Route::get('admin/property_reports', 'PropertyReportController@index');
Route::post('admin/property_reports/store', 'PropertyReportController@store');
Route::get('admin/property_reports/update/{id}', 'PropertyReportController@update');
Route::get('admin/property_reports/delete/{id}', 'PropertyReportController@destroy');

//live serach url on home page
Route::get('search-desktop', 'IndexController@searchMeDesktop')->name('search-desktop');
Route::get('search-mobile', 'IndexController@searchMeMobile')->name('search-mobile');


//ajax sub cities and town and area call
Route::get('callSubCityTown', 'AjaxController@callSubCity')->name('callSubCityTown');
Route::get('callSubCities', 'AjaxController@callSubCities')->name('callSubCities');
Route::get('callTown','AjaxController@callTown')->name('callTown');
Route::get('callArea','AjaxController@callArea')->name('callArea');
Route::get('callLatLong','AjaxController@callLatLong')->name('callLatLong');

//ajax route to click count on call and whatsapp and email button 
Route::get('click_count', 'AjaxController@clickCount')->name('click_count');
    
Route::get('site-register', 'SiteAuthController@siteRegister');
Route::post('site-register', 'SiteAuthController@siteRegisterPost');
