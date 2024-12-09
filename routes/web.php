<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileCompletionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\PayoutMethodController;
use App\Http\Controllers\SendingMoneyController;

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use App\Http\Controllers\ReportingController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profiledetails', [ProfileCompletionController::class, 'updateDetails'])->name('profile.details');
});




Route::middleware('auth','auth.admin')->group(function (){
    Route::get('/country', [CountryController::class, 'index'])->name('country.index');
    Route::get('/addcountry', [CountryController::class, 'create'])->name('country.add-country');
    Route::post('/addcountry',[CountryController::class,'store'])->name('country.add-country');

    Route::get('/editcountry/{country}',[CountryController::class,'edit'])->name('country.edit');

    Route::post('/updatecountry/{country}',[CountryController::class,'update'])->name('country.update');

    Route::get('/deletecountry/{country}',[CountryController::class,'destroy'])->name('country.destroy');
//     function ()  {
//         return "hello world";
        
//     }
// );
});

Route::middleware('auth','auth.admin')->group(function (){
    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
    Route::get('/addcurrency', [CurrencyController::class, 'create'])->name('currency.add-currency');
    
    Route::post('/addcurrency',[CurrencyController::class,'store'])->name('currency.add-currency');

    Route::get('/editcurrency/{currency}',[CurrencyController::class,'edit'])->name('currency.edit');

    Route::post('/updatecurrency/{currency}',[CurrencyController::class,'update'])->name('currency.update');

    Route::get('/deletecurrency/{currency}',[CurrencyController::class,'destroy'])->name('currency.destroy');
});
Route::middleware('auth','auth.admin')->group(function (){
    Route::get('/exchange_rates', [ExchangeRateController::class, 'index'])->name('exchange_rates.index');
    Route::get('/add_exchange_rate', [ExchangeRateController::class, 'create'])->name('exchange_rate.add-exchange_rate');
    
    Route::post('/add_exchange_rate',[ExchangeRateController::class,'store'])->name('exchange_rate.add-exchange_rate');

    Route::get('/edit_exchange_rate/{exchange_rate}',[ExchangeRateController::class,'edit'])->name('exchange_rate.edit');

    Route::put('/update_exchange_rate/{exchange_rate}',[ExchangeRateController::class,'update'])->name('exchange_rate.update');

    Route::get('/delete_exchange_rate/{exchange_rate}',[ExchangeRateController::class,'destroy'])->name('exchange_rate.destroy');
});

Route::middleware('auth','auth.admin')->group(function (){
    Route::get('/payout_methods', [PayoutMethodController::class, 'index'])->name('payout_method.index');
    Route::get('/add_payout_method', [PayoutMethodController::class, 'create'])->name('payout_method.add-payout');
    
    Route::post('/add_payout_method',[PayoutMethodController::class,'store'])->name('payout_method.add-payout');

    Route::get('/edit_payout_method/{payout_method}',[PayoutMethodController::class,'edit'])->name('payout_method.edit');

    Route::post('/update_payout_method/{payout_method}',[PayoutMethodController::class,'update'])->name('payout_method.update');

    Route::get('/delete_payout_method/{payout_method}',[PayoutMethodController::class,'destroy'])->name('payout_method.destroy');
});

Route::middleware('auth')->group(function (){
    Route::get('/wallet', [WalletController::class, 'show'])->name('wallet.show');
    Route::post('/deposit/{id}', [WalletController::class, 'updateBalance'])->name('wallet.deposit');
    Route::post('/withdraw/{id}', [WalletController::class, 'withdrawBalance'])->name('wallet.withdraw');
});
Route::middleware('auth','auth.user')->group(function () {
        Route::get('/send-money', [SendingMoneyController::class,  'conversionForm'])->name('send.money');
        Route::post('/calculate-amount', [SendingMoneyController::class, 'calculateConversion'])->name('calculate.conversion');
        Route::get('/receiver-info', [SendingMoneyController::class, 'receiverInfoForm'])->name('receiver.info');
        Route::post('/process-transaction', [SendingMoneyController::class, 'processTransaction'])->name('process.transaction');
        route::get('/transaction-summary', [SendingMoneyController::class, 'transactionSummary'])->name('transaction.summary');
        Route::post('/complete-transaction', [SendingMoneyController::class, 'completeTransaction'])->name('complete.transaction');
        Route::get('/transaction-history', [SendingMoneyController::class, 'transactionHistory'])->name('transaction.history');
        Route::post('/transaction-history', [SendingMoneyController::class, 'transactionHistory'])->name('transaction.history');
        Route::get('/send-moneyback', [SendingMoneyController::class, 'sendMoneyBack'])->name('send.moneyback');
        Route::post('/transaction/{transaction}/cancel', [SendingMoneyController::class, 'cancel'])->name('transaction.cancel');
        Route::post('/transaction/{transaction}/start', [SendingMoneyController::class, 'start'])->name('transaction.start');

        
        


});

Route::middleware('auth','auth.admin')->group(function () {
    Route::get('/transaction-admin-history', [SendingMoneyController::class, 'transactionadminhistory'])->name('transaction.admin.history');
    Route::post('/transaction-admin-history/{id}', [SendingMoneyController::class, 'transactionupdatestatus'])->name('admin.transactions.updateStatus');

    Route::get('/admin/sender-report', [ReportingController::class, 'showadmin'])->name('admin.report');

    Route::post('/admin/sender-report/filter', [ReportingController::class, 'showAdminReport'])->name('admin.sender.report');




});

Route::get('/admin/ledgers', [LedgerController::class, 'adminView'])
    ->name('admin.ledgers.View')
    ->middleware('auth','auth.admin');


    Route::get('/user/ledgers', [LedgerController::class, 'userView'])
    ->name('user.ledgers.View')
    ->middleware('auth');

    
Route::get('/admin',function(){
    return view('layouts.admin.test');
});


Route::middleware('auth','auth.user')->group(function () {

Route::get('/sender/report', [ReportingController::class, 'showReport'])->name('showReport');



Route::post('/sender/report/filter', [ReportingController::class, 'showSenderReport'])->name('showSenderReport');

}

);

Route::get('/transaction/{transaction}/invoice', [ReportingController::class, 'downloadInvoice'])->name('transaction.invoice');



require __DIR__.'/auth.php';
