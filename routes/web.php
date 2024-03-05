<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BustypeController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdspositionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BusBoardingPointController;
use App\Http\Controllers\BusRatingController;
use App\Http\Controllers\BusShaduleController;
use App\Http\Controllers\NepalipriceController;
use App\Http\Controllers\TermsandconditionsController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrivacypolicyController;
use App\Http\Controllers\PostImageController;
use Spatie\Sitemap\SitemapGenerator;


Route::get('/login/{social}',[LoginController::class, 'socialLogin'])->where('social','facebook|google');
Route::get('/login/{social}/callback',[LoginController::class, 'handleProviderCallback'])->where('social','facebook|google');

Route::get('/', [FrontendController::class, 'homepage']) -> name('homepage');
Route::get('/bus-result', [FrontendController::class, 'busresult']) -> name('busresult');


Route::middleware(['auth'])->prefix('/user')->group(function () {
    Route::get('/book/{id}', [FrontendController::class, 'book']) -> name('book');
    Route::get('/booking/finished', [FrontendController::class, 'bookFinish']) -> name('book.finished');
    Route::post('/book/review/{id}', [FrontendController::class, 'reviewbus']) -> name('book.review');
    Route::get('/book/response/esewa', [FrontendController::class, 'esewaSuccessResponse']) -> name('book.payment.esewa.response');
    Route::get('/book/pay/{type}', [FrontendController::class, 'bookPaySeat']) -> name('book.pay.seat');
    Route::get('/book/pay/cash/type', [FrontendController::class, 'bookingPayment']) -> name('book.pay.cash.custome');
    Route::get('/booking/cancel', [FrontendController::class, 'bookingCancel']) -> name('book.cancel');
});


Route::get('/user/phone/verification', [FrontendController::class, 'phoneVerificationPage'])->name('user.phone.verification')->middleware('auth');
Route::post('/user/phone/add', [FrontendController::class, 'addPhoneNumber'])->name('user.phone.add')->middleware('auth');
Route::post('/user/phone/verification', [FrontendController::class, 'phoneVerificationSend'])->name('user.phone.verification.send')->middleware('auth');
Route::post('/user/phone/verify', [FrontendController::class, 'phoneVerifyCode'])->name('user.phone.verify')->middleware('auth');

Route::middleware(['auth','phone_verified'])->prefix('/user')->group(function () {
    Route::get('/my-bookings', [FrontendController::class, 'myBookings']) -> name('my.bookings');
    Route::get('/my-bookings/list', [FrontendController::class, 'myBookingList']) -> name('my.bookings.list');
    Route::get('/my-booking/{id}', [FrontendController::class, 'myBookingDetail']) -> name('my.booking.detail');
    Route::get('/my-booking/cancel/{id}', [FrontendController::class, 'cancelbooking']) -> name('cance.booking');
    Route::get('/my-booking/print/{id}', [FrontendController::class, 'printBooking']) -> name('print.booking');
    Route::get('/my-booking/email/{id}', [FrontendController::class, 'emailBooking']) -> name('email.booking');
    Route::get('/my-booking/sms/{id}', [FrontendController::class, 'smsBooking']) -> name('sms.booking');
    Route::post('/my-booking/email', [FrontendController::class, 'emailsend']) -> name('post.email.booking');
    Route::get('/profile', [FrontendController::class, 'myProfile'])->name('user.profile');
    Route::post('/profile/update', [BackendController::class, 'profileUpdate'])->name('user.profile.update');
});

Route::post('/feedback/give', [FeedbackController::class, 'store'])->name('front.feedback.store');

Route::get('/offers', [FrontendController::class, 'offers'])->name('front.offers');
Route::get('/gallery', [FrontendController::class, 'gallery']) -> name('gallery');
Route::get('/faq', [FrontendController::class, 'faq']) -> name('faq');
Route::get('/help', [FrontendController::class, 'frontHelp']) -> name('front.help');
Route::get('/complaint-suggestion', [FrontendController::class, 'complainsug']) -> name('front.complainsug');
Route::get('/privacy-policy', [FrontendController::class, 'privacypolicy']) -> name('privacypolicy');
Route::get('/terms-conditions', [FrontendController::class, 'termsconditions']) -> name('termsconditions');
Route::get('/about-us', [FrontendController::class, 'aboutus']) -> name('aboutus');
Route::get('/contact-us', [FrontendController::class, 'contactus']) -> name('contactus');


Route::get('/print', function () {
    return view('frontend.pages.print');
});


// For Superadmin Only
Route::middleware(['check-permission:Superadmin'])->group(function () {
});

Route::middleware('auth','operator','phone_verified')->prefix('operator')->group(function (){
    Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::get('/digital-chalani', [OperatorController::class, 'digitalChalani'])->name('operator.digital.chalani');
});

Route::middleware(['auth','phone_verified','check-permission:Editor|Admin|Superadmin|Author'])->group(function () {

    // BACKEND SECTION
    Route::get('/admin/dashboard', [HomeController::class,'index']) -> name('admin');

    Route::get('/admin/users', [UserController::class,'index']) -> name('admin.user.index');
    Route::get('/admin/users/add', [UserController::class,'create']) -> name('admin.user.create');
    Route::post('/admin/users/store', [UserController::class,'store'])->name('admin.user.store');
    Route::get('/admin/users/delete/{id}', [UserController::class,'delete'])->name('admin.user.delete');
    Route::get('/admin/users/edit/{id}', [UserController::class,'show'])->name('admin.user.edit');
    Route::post('/admin/users/update/{id}', [UserController::class,'update'])->name('admin.user.update');
    Route::get('/admin/users/status/{id}', [UserController::class,'userstatus'])->name('users.status');
    Route::get('/admin/users/role/{id}', [UserController::class,'userrole'])->name('users.role');


    // Profile
    Route::get('/my/profile', [App\Http\Controllers\BackendController::class, 'profile'])->name('admin.profile.index');
    Route::post('/my/profile/{id}', [App\Http\Controllers\BackendController::class, 'profileUpdate'])->name('admin.profile.update');


    Route::get('/admin/feedback', [FeedbackController::class,'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/delete/{id}', [FeedbackController::class,'deletefeedback'])->name('admin.feedback.delete');


    Route::get('/admin/review', [BusRatingController::class,'index'])->name('admin.review.index');
    // Route::get('/admin/review/add', [BusRatingController::class,'create']);
    // Route::post('/admin/review-store', [BusRatingController::class,'store'])->name('review.store');
    Route::get('/admin/review-delet/{id}', [BusRatingController::class,'destroy'])->name('review.delet');

    //category
    Route::get('/admin/category', [CategoryController::class,'index'])->name('admin.category.index');
    Route::get('/admin/category/add', [CategoryController::class,'create']);
    Route::post('/admin/category-store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/admin/category-delet/{id}', [CategoryController::class,'deletecategory'])->name('category.delet');
    Route::get('/admin/category-edit/{id}', [CategoryController::class,'showcategory'])->name('category.edit');
    Route::post('/admin/category-update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::get('/admin/category/status/{id}', [CategoryController::class,'categorystatus'])->name('category.status');
    Route::post('/admin/category-edit/sn/{category_id}', [CategoryController::class,'sn_update'])->name('category.sn.update');



    Route::get('/admin/offers', [OfferController::class, 'index'])->name('admin.offers');
    Route::post('/admin/offers/store', [OfferController::class, 'store'])->name('admin.offers.store');
    Route::get('/admin/offers/delete/{id}', [OfferController::class, 'destroy'])->name('admin.offers.delete');



    //subcategory
    Route::get('/admin/subcategory', [SubcategoryController::class,'index'])->name('admin.subcategory.index');
    Route::get('/admin/subcategory/add', [SubcategoryController::class,'create']);
    Route::post('/admin/subcategory-store', [SubcategoryController::class,'store'])->name('subcategory.store');
    Route::get('/admin/subcategory-delet/{id}', [SubcategoryController::class,'deletesubcategory'])->name('subcategory.delet');
    Route::get('/admin/subcategory-edit/{id}', [SubcategoryController::class,'showsubcategory'])->name('subcategory.edit');
    Route::post('/admin/subcategory-update/{id}', [SubcategoryController::class,'update'])->name('subcategory.update');
    Route::get('/admin/subcategory/status/{id}', [SubcategoryController::class,'subcategorystatus'])->name('subcategory.status');

    Route::get('/admin/setting', [SettingController::class,'index'])->name('admin.setting.index');
    Route::get('/admin/setting/add', [SettingController::class,'create']);
    Route::post('/admin/setting-store', [SettingController::class,'store'])->name('setting.store');
    Route::get('/admin/setting-delet/{id}', [SettingController::class,'deletesetting'])->name('setting.delet');
    Route::get('/admin/setting-edit/{id}', [SettingController::class,'showsetting'])->name('setting.edit');
    Route::post('/admin/setting-update/{id}', [SettingController::class,'update'])->name('setting.update');
    Route::get('/admin/setting/status/{id}', [SettingController::class,'settingstatus'])->name('setting.status');

    //aboutus
    // Route::get('/admin/aboutus', [AboutusController::class,'index'])->name('admin.aboutus.index');
    // Route::get('/admin/aboutus/add', [AboutusController::class,'create']);
    // Route::post('/admin/aboutus-store', [AboutusController::class,'store'])->name('aboutus.store');
    // Route::get('/admin/aboutus-delet/{id}', [AboutusController::class,'deleteaboutus'])->name('aboutus.delet');
    // Route::get('/admin/aboutus-edit/{id}', [AboutusController::class,'showaboutus'])->name('aboutus.edit');
    // Route::post('/admin/aboutus-update/{id}', [AboutusController::class,'update'])->name('aboutus.update');
    // Route::get('/admin/aboutus/status/{id}', [AboutusController::class,'aboutusstatus'])->name('aboutus.status');
    //termsandconditions
    Route::get('/admin/termsandconditions', [termsandconditionsController::class,'index'])->name('admin.termsandconditions.index');
    Route::get('/admin/termsandconditions/add', [termsandconditionsController::class,'create']);
    Route::post('/admin/termsandconditions-store', [termsandconditionsController::class,'store'])->name('termsandconditions.store');
    Route::get('/admin/termsandconditions-delet/{id}', [termsandconditionsController::class,'deletetermsandconditions'])->name('termsandconditions.delet');
    Route::get('/admin/termsandconditions-edit/{id}', [termsandconditionsController::class,'showtermsandconditions'])->name('termsandconditions.edit');
    Route::post('/admin/termsandconditions-update/{id}', [termsandconditionsController::class,'update'])->name('termsandconditions.update');
    Route::get('/admin/termsandconditions/status/{id}', [termsandconditionsController::class,'termsandconditionsstatus'])->name('termsandconditions.status');
    //contactus
    Route::get('/admin/contactus', [ContactusController::class,'index'])->name('admin.contactus.index');
    Route::get('/admin/contactus/add', [ContactusController::class,'create']);
    Route::post('/admin/contactus-store', [ContactusController::class,'store'])->name('contactus.store');
    Route::get('/admin/contactus-delet/{id}', [ContactusController::class,'deletecontactus'])->name('contactus.delet');
    Route::get('/admin/contactus-edit/{id}', [ContactusController::class,'showcontactus'])->name('contactus.edit');
    Route::post('/admin/contactus-update/{id}', [ContactusController::class,'update'])->name('contactus.update');
    Route::get('/admin/contactus/status/{id}', [ContactusController::class,'contactusstatus'])->name('contactus.status');
    //privacypolicy
    Route::get('/admin/privacypolicy', [PrivacypolicyController::class,'index'])->name('admin.privacypolicy.index');
    Route::get('/admin/privacypolicy/add', [PrivacypolicyController::class,'create']);
    Route::post('/admin/privacypolicy-store', [PrivacypolicyController::class,'store'])->name('privacypolicy.store');
    Route::get('/admin/privacypolicy-delet/{id}', [PrivacypolicyController::class,'deleteprivacypolicy'])->name('privacypolicy.delet');
    Route::get('/admin/privacypolicy-edit/{id}', [PrivacypolicyController::class,'showprivacypolicy'])->name('privacypolicy.edit');
    Route::post('/admin/privacypolicy-update/{id}', [PrivacypolicyController::class,'update'])->name('privacypolicy.update');
    Route::get('/admin/privacypolicy/status/{id}', [PrivacypolicyController::class,'privacypolicystatus'])->name('privacypolicy.status');
    //nepaliprice
    Route::get('/admin/nepaliprice', [NepalipriceController::class,'index'])->name('admin.nepaliprice.index');
    Route::get('/admin/nepaliprice/add', [NepalipriceController::class,'create']);
    Route::post('/admin/nepaliprice-store', [NepalipriceController::class,'store'])->name('nepaliprice.store');
    Route::get('/admin/nepaliprice-delet/{id}', [NepalipriceController::class,'deletenepaliprice'])->name('nepaliprice.delet');
    Route::get('/admin/nepaliprice-edit/{id}', [NepalipriceController::class,'shownepaliprice'])->name('nepaliprice.edit');
    Route::post('/admin/nepaliprice-update/{id}', [NepalipriceController::class,'update'])->name('nepaliprice.update');
    Route::get('/admin/nepaliprice/status/{id}', [NepalipriceController::class,'nepalipricestatus'])->name('nepaliprice.status');
    //bustype
    Route::get('/admin/bustype', [BustypeController::class,'index'])->name('admin.bustype.index');
    Route::get('/admin/bustype/add', [BustypeController::class,'create']);
    Route::post('/admin/bustype-store', [BustypeController::class,'store'])->name('bustype.store');
    Route::get('/admin/bustype-delet/{id}', [BustypeController::class,'deletebustype'])->name('bustype.delet');
    Route::get('/admin/bustype-edit/{id}', [BustypeController::class,'showbustype'])->name('bustype.edit');
    Route::post('/admin/bustype-update/{id}', [BustypeController::class,'update'])->name('bustype.update');
    Route::get('/admin/bustype/status/{id}', [BustypeController::class,'bustypestatus'])->name('bustype.status');
    Route::post('/admin/bustype-edit/sn/{bustype_id}', [BustypeController::class,'sn_update'])->name('bustype.sn.update');


    Route::get('/admin/get/route/bus', [Buscontroller::class, 'getbusRoutewise'])->name('bus.routewise.get');

    //Bus
    Route::get('/admin/bus/active', [BusController::class,'active_bus'])->name('admin.bus.active');
    Route::get('/admin/bus', [BusController::class,'index'])->name('admin.bus.index');
    Route::get('/admin/bus/calander/{id}', [BusController::class,'calander'])->name('admin.bus.calander');
    Route::get('/admin/bus/points/{id}', [BusController::class,'boadingpoints'])->name('admin.bus.boadingpoints');
    Route::get('/admin/details/{id}', [BusController::class,'details'])->name('admin.bus.details');
    Route::get('/admin/bus/add', [BusController::class,'create']);
    Route::post('/admin/bus-store', [BusController::class,'store'])->name('bus.store');
    Route::get('/admin/bus-delet/{id}', [BusController::class,'deletebus'])->name('bus.delet');
    Route::get('/admin/bus-edit/{id}', [BusController::class,'showbus'])->name('bus.edit');
    Route::post('/admin/bus-update/{id}', [BusController::class,'update'])->name('bus.update');
    Route::get('/admin/bus/status/{id}', [BusController::class,'busstatus'])->name('bus.status');
    Route::post('/admin/bus-edit/sn/{bus_id}', [BusController::class,'sn_update'])->name('bus.sn.update');



    Route::get('/admin/digital/chalani', [BookingController::class,'digitalChalani'])->name('admin.digital.chalani');
    Route::get('/admin/digital/payment', [BookingController::class,'paymentManage'])->name('admin.digital.payment');


    // busshadule
    Route::get('/admin/calander/add', [BusShaduleController::class, 'addcalander'])->name('bus.calander.add');
    Route::get('/admin/calander/remove', [BusShaduleController::class, 'removecalander'])->name('bus.calander.remove');


    // bus boarding point
    Route::get('/admin/point/add/{bus_id}', [BusBoardingPointController::class, 'addpoint'])->name('bus.point.add');
    Route::get('/admin/point/remove/{id}', [BusBoardingPointController::class, 'removepoint'])->name('bus.point.remove');


    //gallery
    Route::get('/admin/gallery', [GalleryController::class,'index'])->name('admin.gallery.index');
    Route::get('/admin/gallery/add', [GalleryController::class,'create']);
    Route::post('/admin/gallery-store', [GalleryController::class,'store'])->name('gallery.store');
    Route::get('/admin/gallery-delet/{id}', [GalleryController::class,'deletegallery'])->name('gallery.delet');
    Route::get('/admin/gallery-edit/{id}', [GalleryController::class,'showgallery'])->name('gallery.edit');
    Route::post('/admin/gallery-update/{id}', [GalleryController::class,'update'])->name('gallery.update');
    Route::get('/admin/gallery/status/{id}', [GalleryController::class,'gallerystatus'])->name('gallery.status');


    //bookings
    Route::get('/admin/bookings', [BookingController::class, 'bookintList'])->name('admin.bookings');

    //booking
    Route::get('/admin/booking', [BookingController::class,'index'])->name('user.booking.index');
    Route::get('/admin/booking/show/{id}', [BookingController::class,'showTicket'])->name('user.booking.show');
    Route::get('/admin/booking/email/{id}', [BookingController::class,'emailTicket'])->name('user.booking.email');
    Route::get('/admin/booking/cancel/{id}', [BookingController::class,'cancelTicket'])->name('user.booking.cancel');
    Route::get('/admin/booking/refund/{id}', [BookingController::class,'refundTicket'])->name('user.booking.refund');
    Route::get('/admin/booking/sms/{id}', [BookingController::class,'smsTicket'])->name('user.booking.sms');
    Route::get('/admin/passanger', [BookingController::class,'showpassangers'])->name('user.showpassangers.index');
    Route::get('/admin/passanger/cancelled', [BookingController::class,'cancelledPassenger'])->name('user.showpassangers.cancelled');
    Route::get('/booking/{id}', [BookingController::class,'create']);
    Route::get('/admin/booking-delet/{id}', [BookingController::class,'deletebooking'])->name('booking.delet');
    Route::get('/admin/booking-edit/{id}', [BookingController::class,'showbooking'])->name('booking.edit');
    Route::post('/admin/booking-update/{id}', [BookingController::class,'update'])->name('booking.update');
    Route::get('/admin/booking/status/{id}', [BookingController::class,'bookingstatus'])->name('booking.status');
    Route::post('/admin/booking-edit/sn/{booking_id}', [BookingController::class,'sn_update'])->name('booking.sn.update');

});
Route::post('/user/booking-store/{id}', [BookingController::class,'store'])->name('booking.store');


Route::get('user/login', [LoginController::class, 'login_view'])->name('login');
Route::post('user/login', [LoginController::class, 'login_verify'])->name('login');

Route::get('user/register', [RegisterController::class, 'register_view'])->name('register');
Route::post('user/register', [RegisterController::class, 'register_custom'])->name('register');



Auth::routes([
    'verify' => true,
]);
