<?php

use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CommentController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\ManagerOrderController;
use App\Http\Controllers\backend\PitchController;
use App\Http\Controllers\backend\PostCategoryController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\PricePitchController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\PostController as FrontendPostController;

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
// frontend
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::post('search', [FrontendController::class, 'search'])->name('search');



Route::get('/chitietsan/{id}', [FrontendController::class, 'viewDetail'])->name('viewDetail');
Route::post('/savecart', [CartController::class, 'saveCart'])->name('savecart');
Route::get('/showcart', [CartController::class, 'showcart'])->name('showcart');
Route::post('/deletecart', [CartController::class, 'deletecart'])->name('deletecart');
Route::get('/delete_coupon', [CartController::class, 'delete_coupon'])->name('delete_coupon');
Route::get('/delete_couponcheckout', [CartController::class, 'delete_couponcheckout'])->name('delete_couponcheckout');


//Checkout
Route::get('/login_checkout', [CheckoutController::class, 'login_checkout'])->name('login_checkout');
Route::get('/register', [CheckoutController::class, 'register'])->name('register');
Route::post('login_customer', [CheckoutController::class, 'login_customer'])->name('login_customer');
Route::post('/add_customer', [CheckoutController::class, 'add_customer'])->name('add_customer');
Route::post('/order_place', [CheckoutController::class, 'order_place'])->name('order_place');
Route::get('/quenmatkhau', [CheckoutController::class, 'quenmatkhau'])->name('quenmatkhau');
Route::post('/recover_pass', [CheckoutController::class, 'recover_pass'])->name('recover_pass');
Route::get('/update-new-pass', [CheckoutController::class, 'update_new_pass'])->name('update_new_pass');
Route::post('/reset_newpass', [CheckoutController::class, 'reset_newpass'])->name('reset_newpass');


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name(('checkout'));
Route::get('/logout_checkout', [CheckoutController::class, 'logout_checkout'])->name(('logout_checkout'));
Route::post('/savecheckout_customer', [CheckoutController::class, 'savecheckout_customer'])->name(('savecheckout_customer'));
Route::get('/payment', [CheckoutController::class, 'payment'])->name(('payment'));
Route::post('/confirm_order', [CheckoutController::class, 'confirm_order'])->name(('confirm_order'));
Route::get('/payment-success', [CheckoutController::class, 'paymentSuccess'])->name(('payment-success'));

Route::get('/danhmucbaiviet/{slug}', [FrontendPostController::class, 'danhmucbaiviet'])->name('danhmucbaiviet');
Route::get('/baiviet/{slug}', [FrontendPostController::class, 'baiviet'])->name('baiviet');

Route::get('/login_customer_google',[FrontendController::class,'login_customer_google'])->name('login_customer_google');

//backend
Route::prefix('admin')->group(function () {
    Route::get('/register', [LoginController::class, 'register'])->name('viewRegister');
    Route::get('/', [LoginController::class, 'index'])->name('dashboard');
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/filter-by-date',[DashboardController::class,'filter_by_date']);
    Route::post('/dashboard-filter',[DashboardController::class,'dashboard_filter']);
    Route::post('/days-order',[DashboardController::class,'days_order']);

   
    
    Route::prefix('banner')->group(function () {
        Route::get('/all_banner', [SliderController::class, 'index'])->name('all_banner')->middleware('auth');
        Route::get('/add_slider', [SliderController::class, 'create'])->name('add_slider')->middleware('auth');
        Route::post('/addSlider', [SliderController::class, 'store'])->name('addSlider')->middleware('auth');
        Route::get('/updateSlider/{id}', [SliderController::class, 'edit'])->name('updateSlider')->middleware('auth');
        Route::get('/unactive_slider/{id}', [SliderController::class, 'unactive_slider'])->name('unactive_slider')->middleware('auth');
        Route::get('/active_slider/{id}', [SliderController::class, 'active_slider'])->name('active_slider')->middleware('auth');
        Route::get('/deleteSlider/{id}', [SliderController::class, 'delete'])->name('deleteSlider')->middleware('auth');
    });
    Route::prefix('category')->group(function () {
        Route::get('/all_category', [CategoryController::class, 'index'])->name('all_category')->middleware('auth.roles','auth');
        Route::get('/add_category', [CategoryController::class, 'create'])->name('add_category')->middleware('auth.roles','auth');
        Route::get('/updateCategory/{id}', [CategoryController::class, 'edit'])->name('updateCategory')->middleware('auth');
        Route::post('/addCategory', [CategoryController::class, 'store'])->name('addCategory')->middleware('auth');
        Route::get('/unactive_category/{id}', [CategoryController::class, 'unactive_category'])->name('unactive_category')->middleware('auth');
        Route::get('/active_category/{id}', [CategoryController::class, 'active_category'])->name('active_category')->middleware('auth');
        Route::post('/updateCategory/{id}', [CategoryController::class, 'update'])->name('update_category')->middleware('auth');
        Route::get('/deleteCategory/{id}', [CategoryController::class, 'delete'])->name('deleteCategory')->middleware('auth');
    });
    Route::prefix('pricepitch')->group(function () {
        Route::get('/all_pricepitch', [PricePitchController::class, 'index'])->name('all_pricepitch')->middleware('auth');
        Route::get('/add_pricepitch', [PricePitchController::class, 'create'])->name('add_pricepitch')->middleware('auth');
        Route::post('/addPricepitch', [PricePitchController::class, 'store'])->name('addPricepitch')->middleware('auth');
        Route::get('/updatePricepitch/{id}', [PricePitchController::class, 'edit'])->name('updatePricepitch')->middleware('auth');
        Route::post('/updatePricepitch/{id}', [PricePitchController::class, 'update'])->name('update_pricepitch')->middleware('auth');
        Route::get('/deletePricepitch/{id}', [PricePitchController::class, 'delete'])->name('deletePricepitch')->middleware('auth');
    });
    Route::prefix('pitch')->group(function () {
        Route::get('/all_pitch', [PitchController::class, 'index'])->name('all_pitch')->middleware('auth');
        Route::get('/add_pitch', [PitchController::class, 'create'])->name('add_Pitch')->middleware('auth');
        Route::get('/updatepitch/{id}', [PitchController::class, 'edit'])->name('updatepitch')->middleware('auth');
        Route::post('/addpitch', [PitchController::class, 'store'])->name('addPitch')->middleware('auth');
        Route::get('/unactive_pitch/{id}', [PitchController::class, 'unactive_pitch'])->name('unactive_pitch')->middleware('auth');
        Route::get('/active_pitch/{id}', [PitchController::class, 'active_pitch'])->name('active_pitch')->middleware('auth');
        Route::post('/updatepitch/{id}', [PitchController::class, 'update'])->name('update_pitch')->middleware('auth');
        Route::get('/deletepitch/{id}', [PitchController::class, 'delete'])->name('deletepitch')->middleware('auth');
    });
    //Quản lý đặt sân
    Route::prefix('order')->group(function () {
        Route::get('/manageorder', [ManagerOrderController::class, 'manageorder'])->name('manageorder')->middleware('auth');
        Route::get('/print_order/{checkout_code}', [ManagerOrderController::class, 'print_order'])->name('print_order')->middleware('auth');
        Route::post('/update-order',[ManagerOrderController::class,'update_order']);
        Route::get('/vieworder/{id}', [ManagerOrderController::class, 'view_order'])->name('view_order')->middleware('auth');
    });
    //Login facebook
    Route::get('/login-facebook', [LoginController::class, 'login_facebook']);
    Route::get('/admin/callback', [Logincontroller::class, 'callback_facebook']);
    Route::prefix('coupon')->group(function () {
        Route::get('managecoupon', [CouponController::class, 'managecoupon'])->name('managecoupon')->middleware('auth');
        Route::get('add_coupon', [CouponController::class, 'add_coupon'])->name('add_coupon')->middleware('auth');
        Route::post('addCoupon', [CouponController::class, 'addCoupon'])->name('addCoupon')->middleware('auth');
        Route::get('/deletecoupon/{id}', [CouponController::class, 'delete'])->name('deletecoupon')->middleware('auth');
        Route::get('/send-coupon',[CouponController::class,'send_coupon'])->name('send_coupon')->middleware('auth');
        Route::get('/mail-example',[CouponController::class,'mail_example'])->name('mail_example')->middleware('auth');
    
    });
    Route::group(['middleware'=>'auth.roles'],function(){
        Route::get('/all_users', [UserController::class, 'index'])->name('all_users')->middleware('auth');
        Route::post('/assign-roles', [UserController::class, 'assign_roles'])->name('assign-roles')->middleware('auth');
        Route::get('/deleteUser_role/{id}', [UserController::class, 'deleteUser_role'])->name('deleteUser_role')->middleware('auth');
        Route::get('/add_user', [UserController::class, 'add_user'])->name('add_user')->middleware('auth');
        Route::get('/impersonate/{id}', [UserController::class, 'impersonate'])->name('impersonate')->middleware('auth');
        
    });
    //Authencation
    Route::get('/register_auth', [AuthController::class, 'register_auth'])->name('register_auth');
    Route::get('/login', [AuthController::class, 'login'])->name('login_auth');
    Route::get('/logout_auth', [AuthController::class, 'logout_auth'])->name('logout_auth');
    Route::post('/registerAuth', [AuthController::class, 'registerAuth'])->name('registerAuth');
    Route::post('/loginAuth', [AuthController::class, 'loginAuth'])->name('loginAuth');
    Route::get('/impersonate_destroy',[UserController::class,'impersonate_destroy'])->name('impersonate_destroy');
    
    //Danh mục bài viết
    Route::prefix('category_post')->group(function () {
        Route::get('/all_category_post', [PostCategoryController::class, 'index'])->name('all_category_post')->middleware('auth');
        Route::get('/add_PostCategory', [PostCategoryController::class, 'create'])->name('add_PostCategory')->middleware('auth');
        Route::get('/updatecategory_post/{id}', [PostCategoryController::class, 'edit'])->name('updatecategory_post')->middleware('auth');
        Route::post('/addCategoryPost', [PostCategoryController::class, 'store'])->name('addCategoryPost')->middleware('auth');
        Route::post('/editCategoryPost/{id}', [PostCategoryController::class, 'update'])->name('editCategoryPost')->middleware('auth');
        Route::get('/deleteCategoryPost/{id}', [PostCategoryController::class, 'delete'])->name('deleteCategoryPost')->middleware('auth');
    });
    Route::prefix('post')->group(function () {
        Route::get('/all_post', [PostController::class, 'index'])->name('all_post')->middleware('auth');
        Route::get('/add_post', [PostController::class, 'create'])->name('add_post')->middleware('auth');
        Route::get('/updatepost/{id}', [PostController::class, 'edit'])->name('updatepost')->middleware('auth');
        Route::post('/addPost', [PostController::class, 'store'])->name('addPost')->middleware('auth');
        Route::get('/unactive_post/{id}', [PostController::class, 'unactive_post'])->name('unactive_post')->middleware('auth');
        Route::get('/active_post/{id}', [PostController::class, 'active_post'])->name('active_post')->middleware('auth');
        Route::post('/updatePost/{id}', [PostController::class, 'update'])->name('update_Post')->middleware('auth');
        Route::get('/deletePost/{id}', [PostController::class, 'delete'])->name('deletePost')->middleware('auth');
    });
    Route::prefix('comment')->group(function () {
        Route::get('/all_comment', [CommentController::class, 'index'])->name('all_comment')->middleware('auth');
        Route::post('/allow_comment', [CommentController::class, 'allow_comment'])->name('allow_comment')->middleware('auth');
       
        
    });
    Route::prefix('gallery')->group(function () {
        Route::get('/add_gallery/{id}', [GalleryController::class, 'create'])->name('add_gallery')->middleware('auth');
       Route::post('/select_gallery',[GalleryController::class,'select_gallery'])->name('select_gallery');
       Route::post('/insert_gallery/{pitch_id}',[GalleryController::class,'insert_gallery'])->name('insert_gallery');
       
       Route::post('/update_galleryname',[GalleryController::class,'update_galleryname'])->name('update_galleryname');
       Route::post('/delete_gallery',[GalleryController::class,'delete_gallery'])->name('delete_gallery');
       Route::post('/update_gallery',[GalleryController::class,'update_gallery'])->name('update_gallery');



    });
});

Route::prefix('frontend')->group(function () {

    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
});
//send mail
Route::get('/sendmail', [FrontendController::class, 'sendmail'])->name('sendmail');
//Coupon
Route::post('/check_coupon', [CartController::class, 'check_coupon'])->name('check_coupon');
Route::post('/checktinhtrang', [FrontendController::class, 'checktinhtrang'])->name('checktinhtrang');
Route::post('/loadcomment', [FrontendController::class, 'loadcomment'])->name('loadcomment');
Route::post('/sendcomment', [CommentController::class, 'sendcomment'])->name('sendcomment');

Route::post('/get-order-details', [FrontendController::class, 'getOrderDetails'])->name('get-order-details');


