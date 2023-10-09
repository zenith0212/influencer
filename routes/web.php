<?php

use App\Http\Controllers\{ProfileController, PlanController, ProductsController, CategoryController, AdminPaymentController, DashboardController, CampaignsController, UserController, TestController, ScrapInfluencer, PaymentController, FrontCommonController};
use App\Http\Controllers\Brand\{FindInfluencerController, ProductController, CampaignController, InviteCampaignController, BrandReportController};
use App\Http\Controllers\Influencers\CampaignsController as FrontendCampaignController;
use App\Http\Controllers\Influencers\ReportsController as InfluencerReportController;
use App\Http\Controllers\AdminManageContentController;
use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('frontend.main');
})->name('welcome');

// Route::get('/send-mail-queue-test', function () {
//     $emailData['user_name'] = 'TRV Narola';
//     $emailData['to_email']  = 'trv@narola.email';
//     dispatch(new App\Jobs\SendInfluencerEmailQueueJob($emailData))->delay(now()->addMinutes(1));
// });

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    echo "Clear Done";
    // toastr()->success('Clear Routes And cache');
    return redirect()->back();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pricing',                  [UserController::class, 'guestSubscription'])->name('pricing');
Route::get('/request-demo',             [UserController::class, 'requestDemo'])->name('requestDemo');
Route::get('/about-us',                 [UserController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us',               [UserController::class, 'contactUs'])->name('contactUs');
Route::get('/what-is-top-brandmate',    [UserController::class, 'whatIsTopBrandMate'])->name('whatIsTopBrandMate');
Route::get('/why-top-brandmate',        [UserController::class, 'whyTopBrandMate'])->name('whyTopBrandMate');
Route::get('/terms-of-service',         [UserController::class, 'termsOfService'])->name('termsOfService');
Route::get('/privacy',                  [UserController::class, 'privacy'])->name('privacy');
Route::get('/coming-soon',              [UserController::class, 'comingsoon'])->name('comingsoon');
Route::get('/join-us',                  [UserController::class, 'joinus'])->name('joinus');

// Store fron-end data
Route::post('store-request-demo',       [UserController::class, 'storeRequestDemo'])->name('store_request_demo');
Route::post('store-join-us',            [UserController::class, 'storeJoinUs'])->name('store_joinus');

// Billing details for both Brand / Influencer
Route::get('influencer/billing-details',        [InfluencerReportController::class,'billingDetails'])->name('billing_details');

Route::middleware('auth')->group(function () {
    // Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',        [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',       [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::middleware(['role:Super Admin'])->group(function () {
     Route::get('admin/profile',[DashboardController::class,'profile'])->name('admin.profile');

    // Routes for Plan
    Route::group(['prefix' => 'plan'], function() {
        Route::get('/list',                 [PlanController::class, 'index'])->name('plans.index');
        Route::get('/plans/getPlans',       [PlanController::class, 'getPlans'])->name('plans.getPlans');
        Route::get('create',                [PlanController::class, 'create'])->name('plans.create');
        Route::post('store',                [PlanController::class, 'store'])->name('plans.store');
        Route::get('edit/{id}',             [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('update/{id}',           [PlanController::class, 'update'])->name('plans.update');
        Route::delete('delete',             [PlanController::class, 'destroy'])->name('plans.destroy');
        Route::post('update-status',        [PlanController::class, 'changeStatus'])->name('plans.change-status');
    });

    //Routes for categories
    Route::group(['prefix' => 'category'], function() {
        Route::get('/list',                      [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/getCategories',  [CategoryController::class, 'getCategories'])->name('categories.getCategories');
        Route::get('create',                     [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store',                     [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}',                  [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('update/{id}',                [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('delete',                  [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    //Routes for products
    Route::group(['prefix' => 'product'], function() {
        Route::get('/list',                     [ProductsController::class, 'index'])->name('products.index');
        Route::get('/products/getproducts',     [ProductsController::class, 'getproducts'])->name('products.getProducts');
        Route::get('view/{id}',                 [ProductsController::class, 'show'])->name('products.show');
    });

    Route::group(['prefix' => 'campaign'], function() {
        Route::get('/list',                     [CampaignsController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/getcampaigns',   [CampaignsController::class, 'getcampaigns'])->name('campaigns.getCampaigns');
        Route::get('view/{id}',                 [CampaignsController::class, 'show'])->name('campaigns.show');
    });

    Route::group(['prefix' => 'front'], function() {
        Route::get('/common-details',     [FrontCommonController::class, 'index'])->name('front.common');
        Route::get('/get-common-details', [FrontCommonController::class, 'getCommonDetails'])->name('front.get_common_details');
        Route::get('/join-us-details',    [FrontCommonController::class, 'joinUsDetails'])->name('front.joinus');
        Route::get('/get-join-us-details',[FrontCommonController::class, 'getJoinUsDetails'])->name('front.join_us_details');
    });


    /* NPP_Development Start */
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('brand/list',[UserController::class,'index'])->name('brand_users');
    Route::get('brand_users',[UserController::class,'getBrands'])->name('brands.users');
    Route::get('influencers/tiktok-influencers',[UserController::class,'influencer_users'])->name('influencers');
    Route::get('influencers/register-influencers',[UserController::class,'registered_users'])->name('register_influencers');
    Route::get('influencers_users',[UserController::class,'getInfluencers'])->name('influencers.users');
    Route::get('get_register_users',[UserController::class,'get_register_users'])->name('get_register_influencers');
    Route::get('get_influencer/{id}',[UserController::class,'getByIdinfluencer'])->name('influencer.get_influencer');
    Route::delete('delete',[UserController::class,'destroy'])->name('admin.delete_influencers');
    Route::post('delete_brand/{id}',[UserController::class,'delete_brand'])->name('admin.delete_brand');
    Route::get('edit/{id}', [UserController::class, 'edit_brand'])->name('brand.edit');
    Route::put('update/{id}', [UserController::class, 'update_brand'])->name('brand.update');
    Route::post('brand/create', [UserController::class, 'create_brand'])->name('brand.create');
    Route::post('brand/add', [UserController::class, 'add_brand'])->name('brand.add');
    /* NPP_Development End */

    Route::get('notification',[DashboardController::class,'activityLog'])->name('activity_log');

    //Routes for payments
    Route::group(['prefix' => 'payments'], function() {
        Route::get('/list',                     [AdminPaymentController::class, 'index'])->name('payments.index');
        Route::get('/pdf-preview/{id}',              [AdminPaymentController::class, 'showPdf'])->name('payments.admin_pdf_preview');
        Route::get('/payments/getPayments',     [AdminPaymentController::class, 'getPayments'])->name('payments.getPayments');
        Route::post('view_payment',             [AdminPaymentController::class, 'viewPayment'])->name('payments.view_payment');
    });

    /* Manaage Content */
    Route::group(['prefix' => 'content'], function() {
        Route::get('/list',                     [AdminManageContentController::class, 'index'])->name('content.index');
        Route::get('/getContent',   [AdminManageContentController::class,'getContentData'])->name('content.getContentData');
        Route::get('create',                     [AdminManageContentController::class, 'create'])->name('content.create');
        Route::post('store',                     [AdminManageContentController::class, 'store'])->name('content.store');
        Route::get  ('edit/{id}',                  [AdminManageContentController::class, 'edit'])->name('content.edit');
        Route::put('update/{id}',                [AdminManageContentController::class, 'update'])->name('content.update');
        // Route::delete('delete',                  [AdminManageContentController::class, 'destroy'])->name('content.destroy');

    });
});
/* Admin Routes  */


/* Brand Roles Start  */
Route::middleware(['role:Brand', 'auth'])->group(function () {
    Route::get('brand/plans',[PaymentController::class,'index'])->name('brand_plans');
    // Route::post('brand/plans/{id}',[PaymentController::class,'index'])->name('subscribe.plans');
    Route::get('/stripe-payment/{id}',[PaymentController::class,'stripe_payment'])->name('stripe_payment');
    Route::post('/payment',[PaymentController::class,'payment'])->name('stripe.payment');
    // Route::get('/stripe_connect',[PaymentController::class,'redirect'])->name('stripe_connect');
});


Route::group([
    'middleware' => ['role:Brand','auth','subscription_plans', 'verified'],
    'prefix' => 'brand',
], function () {
    Route::get('dashboard',[DashboardController::class,'brand_dashboard'])->name('brand_dashboard');
    Route::get('profile',[DashboardController::class,'brand_profile'])->name('brand.profile');
    Route::get('profile/edit',[DashboardController::class,'brand_profile_edit'])->name('brand.profile.edit');
    Route::any('find-influencer',[FindInfluencerController::class,'index'])->name('brand.find_influencer');
    Route::get('get-influencers',[FindInfluencerController::class,'get_influencers'])->name('brand.get_influencer');
    Route::get('find-influencer/{id}',[FindInfluencerController::class,'get_single_influencers'])->name('brand.influencer_details');
    Route::post('send-invitation',[InviteCampaignController::class,'send_mail'])->name('brand.send_invitation');
    Route::post('influencers-loaddata',[FindInfluencerController::class,'loadData'])->name('brand.loadmore_influencers');
    // Route::post('store_response',[InviteCampaignController::class,'store_respose'])->name('store.respose');
    Route::post('delivery-status-change', [ProductController::class, 'changeStatus'])->name('delivery.change-status-brand');
    // product routes
    Route::get('products', [ProductController::class, 'index'])->name('brand.product.index');
    Route::get('products/sampleRequest', [ProductController::class, 'sampleRequest'])->name('brand.product.sampleRequest');
    Route::get('product/create', [ProductController::class, 'create'])->name('brand.product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('brand.product.store');
    Route::get('product/{id}', [ProductController::class, 'view'])->name('brand.product.view');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('brand.product.edit');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('brand.product.update');
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('brand.product.delete');

    Route::post('addfavourite', [FindInfluencerController::class, 'addfavourite'])->name('addtofavourite');
    Route::delete('destroyfavourite/{id}', [FindInfluencerController::class, 'destroyfavourite'])->name('deletefromfavourite');
    Route::get('favourite-influencer',[FindInfluencerController::class,'favouriteInfluencers'])->name('brand.favouriteInfluencerslist');
    Route::get('favourite-influencer-list',[FindInfluencerController::class,'favouriteInfluencersList'])->name('brand.favouriteInfluencers');


    Route::get('/guest_influencer_details/{id}', [UserController::class, 'InfluencerDetails'])->name('guest_influencer_details');

    Route::get('/product-details/{id}/campaign_id={campaign_id}',[FrontendCampaignController::class,'get_single_productcampaign'])->name('brand.campaigns.product_details');

    Route::post('accept_influencer_request', [CampaignController::class,'acceptInfluencerRequest'])->name('brand.campaign.accept_request');
    Route::post('reject_influencer_request', [CampaignController::class,'rejectInfluencerRequest'])->name('brand.campaign.reject_request');


    // Start by TRV
    // Campaign routes
    Route::get('campaigns',                         [CampaignController::class, 'index'])->name('brand.campaign.index');
    Route::get('campaigns/getCampaigns',            [CampaignController::class, 'getCampaigns'])->name('brand.campaign.getCampaigns');
    Route::get('campaigns/activeCampaignList',      [CampaignController::class, 'activeCampaignList'])->name('brand.campaign.activeCampaignList');
    Route::get('campaigns/completedCampaignList',   [CampaignController::class, 'completedCampaignList'])->name('brand.campaign.completedCampaignList');
    Route::get('campaigns/create',                  [CampaignController::class, 'create'])->name('brand.campaign.create');
    Route::post('campaigns/store',                  [CampaignController::class, 'store'])->name('brand.campaign.store');
    Route::get('campaigns/edit/{id}',               [CampaignController::class, 'edit'])->name('brand.campaign.edit');
    Route::post('campaigns/update',                 [CampaignController::class, 'update'])->name('brand.campaign.update');
    Route::get('campaigns/details/{id}',            [CampaignController::class, 'view'])->name('brand.campaign.view');
    Route::delete('delete',                         [CampaignController::class, 'destroy'])->name('brand.campaign.destroy');
    Route::get('search-influencer',                 [CampaignController::class, 'searchInfluencer'])->name('brand.campaign.search_influencer');
    Route::get('all_products',                      [CampaignController::class, 'allProducts'])->name('brand.campaign.all_products');
    Route::post('campaigns/delete_old_influencer',  [CampaignController::class, 'deleteOldInfluencer'])->name('brand.campaign.delete_old_influencer');
    Route::get('campaign/product-details/{id}',     [CampaignController::class, 'viewProduct'])->name('brand.campaign.product_details');
    Route::post('campaigns/send-offer',             [CampaignController::class, 'sendOffer'])->name('brand.campaign.send_offer');
    Route::post('campaigns/re-send-offer',          [CampaignController::class, 'resendOffer'])->name('brand.campaign.re_send_offer');
    Route::post('campaigns/re-send-offer-accept',   [CampaignController::class, 'resendOfferAccept'])->name('brand.campaign.re_send_offer_accept');
    Route::get('ratings',                           [CampaignController::class, 'ratings'])->name('ratings');
    Route::post('ratingsStore',                     [CampaignController::class, 'ratingsStore'])->name('ratingsStore');
    Route::post('campaigns/manage-common-status',   [CampaignController::class, 'manageCommonStatus'])->name('brand.campaign.manage_common_status');

    Route::get('brand_notification',[DashboardController::class,'ActivityLogs'])->name('brand_activity_log');

    // Reports
    Route::get('total-spends',                [BrandReportController::class,'index'])->name('total_spends');
    Route::get('get-total-spends',            [BrandReportController::class,'getTotalSpends'])->name('get_total_spends');
    Route::get('/pdf-stream/{id}',                  [BrandReportController::class,'pdfStream'])->name('pdf_stream');
});

/* Brand Roles End  */

Route::middleware(['role:Influencer','auth','verified'])->group(function () {
    Route::get('influencer/dashboard',              [DashboardController::class,'influencer_dashboard'])->name('influencer_dashboard');
    Route::get('influencer/payment',                [DashboardController::class,'influencerPayment'])->name('influencer_payment');
    Route::post('influencer/connect_influencer_stripe_account', [DashboardController::class,'connectInfluencerStripeAccount'])->name('connect_influencer_stripe_account');
    Route::get('influencer/find-campaign',          [FrontendCampaignController::class,'campaignDetails'])->name('campaign_details');
    Route::get('influencer/profile',                [DashboardController::class,'influencer_profile'])->name('influencer.profile');
    Route::get('influencer/profile/edit',           [DashboardController::class,'influencer_profile_edit'])->name('influencer.profile.edit');
    Route::patch('influencer/profile/update',       [DashboardController::class, 'influencer_update'])->name('influencer_profile.update');
    Route::get('influencer/campaign-details/{id}',  [FrontendCampaignController::class,'get_single_campaign'])->name('influencer.campaign_details');
    Route::get('influencer/campaign',               [FrontendCampaignController::class,'get_campaign'])->name('influencer.get_campaign');
    Route::post('campaigns/loaddata',               [FrontendCampaignController::class,'loadDataAjax'] );

    Route::get('influencer-details/{id}',           [FindInfluencerController::class,'getInfluencer'])->name('influener.influencer_details');

    Route::get('/guest_influencer_details/{id}',    [UserController::class, 'InfluencerDetails'])->name('guest_influencer_details');

    Route::get('influencer/find-product',           [FrontendCampaignController::class,'productDetails'])->name('product_details');
    Route::get('influencer/product-details/{id}',   [FrontendCampaignController::class,'get_single_product'])->name('influencer.product_details');

    Route::get('influencer/product-details/{id}/campaign_id={campaign_id}',                                            [FrontendCampaignController::class,'get_single_productcampaign'])->name('influencer.campaigns.product_details');

    Route::get('influencer/get-product',            [FrontendCampaignController::class,'get_product'])->name('influencer.get_product');
    Route::post('products/loaddata',                [FrontendCampaignController::class,'loadProductDataAjax'] );
    Route::get('apply-reason/create',               [FrontendCampaignController::class, 'applyReasonCreate'])->name('apply-reason.create');
    Route::post('apply-reason/store',               [FrontendCampaignController::class, 'applyReasonStore'])->name('apply-reason.store');
    Route::post('delivery-status',                  [FrontendCampaignController::class, 'changeStatus'])->name('delivery.change-status');
    Route::get('connected-campaigns',               [FrontendCampaignController::class, 'connectedCampaigns'])->name('connected_campaign_details');
    Route::get('influencer/get_connected_campaign',               [FrontendCampaignController::class,'get_connected_campaign'])->name('influencer.get_connected_campaign');
    Route::post('accept_campaign_offer', [FrontendCampaignController::class,'acceptCampaignOffer'])->name('influencer.campaign.accept_offer');

    Route::post('reject_campaign_offer', [FrontendCampaignController::class,'rejectCampaignOffer'])->name('influencer.campaign.reject_offer');

    Route::post('negociate_request',[FrontendCampaignController::class,'negociate_request'])->name('influencer.negociate_request');

    Route::post('complete_offer',[FrontendCampaignController::class,'completeOffer'])->name('influencer.complete_offer');

    Route::post('payment_request',[FrontendCampaignController::class,'paymentRequest'])->name('influencer.payment_request');


    Route::get('ratings-campaign',                        [FrontendCampaignController::class, 'ratings'])->name('campaign-ratings');
    Route::post('ratingsStore-campaign',                  [FrontendCampaignController::class, 'ratingsStore'])->name('campaign-ratingsStore');

    Route::get('influencer_notification',[DashboardController::class,'ActivityLogs'])->name('influencer_activity_log');


    // Reports(Total Earning)
    Route::get('influencer/total-earnings',         [InfluencerReportController::class,'index'])->name('total_earnings');
    Route::get('influencer/get-total-earnings',     [InfluencerReportController::class,'getTotalEarnings'])->name('get_total_earnings');

    Route::get('influencer/pdf-preview/{id}',                 [InfluencerReportController::class,'pdfPreview'])->name('pdf_preview');
});


/* Get all influencers records and store in database [ pLEASE do NOT RUN THIS ROUTE - NPP] */
Route::get('/get_influencers',[TestController::class,'get_data']);
Route::get('/get_more_influencers',[ScrapInfluencer::class,'get_data']);
/* Get all influencers records and store in database [ pLEASE do NOT RUN THIS ROUTE - NPP] */
Route::any('/invitemail/{campaign_id}/{influencer_id}/{status}',[InviteCampaignController::class,'invite_mail'])->name('invite.mail');
Route::post('/save-response/{id}',[InviteCampaignController::class,'save_response'])->name('save.response');



/* Paypal routes - NPP */
Route::get('paywithpaypal', [PaypalController::class,'payWithPaypal'])->name('paywithpaypal');
Route::post('paypal', [PaypalController::class,'postPaymentWithpaypal'])->name("post.paypal");
Route::get('paypal',  [PaypalController::class,'getPaymentStatus'])->name("status");

require __DIR__.'/auth.php';
