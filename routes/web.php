<?php

use App\Http\Controllers\Admin\AngsuranController as AdminAngsuranController;
use App\Http\Controllers\Admin\AsuransiController as AdminAsuransiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JenisCicilanController as AdminJenisCicilanController;
use App\Http\Controllers\Admin\JenisMotorController as AdminJenisMotorController;
use App\Http\Controllers\Admin\KreditController as AdminKreditController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\MetodeBayarController as AdminMetodeBayarController;
use App\Http\Controllers\Admin\MotorController as AdminMotorController;
use App\Http\Controllers\Admin\PengajuanKreditController as AdminPengajuanKreditController;
use App\Http\Controllers\Admin\PengirimanController as AdminPengirimanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CEO\LaporanController as CEOLaporanController;
use App\Http\Controllers\Marketing\DashboardController as MarketingDashboardController;
use App\Http\Controllers\Marketing\FollowUpController as MarketingFollowUpController;
use App\Http\Controllers\Marketing\PengajuanKreditController as MarketingPengajuanKreditController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\AngsuranController as UserAngsuranController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KreditController as UserKreditController;
use App\Http\Controllers\User\PengajuanKreditController as UserPengajuanKreditController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Support\RoleRedirect;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/motor', [PublicController::class, 'motor'])->name('public.motor');
Route::get('/motor/{motor}', [PublicController::class, 'motorShow'])->name('public.motor.show');
Route::get('/simulasi-kredit', [PublicController::class, 'simulasi'])->name('public.simulasi');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('public.tentang');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', fn () => redirect(RoleRedirect::dashboard(auth()->user()->role)))->name('dashboard');
});

Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengajuan', [UserPengajuanKreditController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/create/{motor}', [UserPengajuanKreditController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [UserPengajuanKreditController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{pengajuan}', [UserPengajuanKreditController::class, 'show'])->name('pengajuan.show');
    Route::get('/kredit', [UserKreditController::class, 'index'])->name('kredit.index');
    Route::get('/kredit/{kredit}', [UserKreditController::class, 'show'])->name('kredit.show');
    Route::get('/angsuran', [UserAngsuranController::class, 'index'])->name('angsuran.index');
    Route::get('/angsuran/{angsuran}/receipt', [UserAngsuranController::class, 'receipt'])->name('angsuran.receipt');
    Route::get('/angsuran/{angsuran}', [UserAngsuranController::class, 'show'])->name('angsuran.show');
    Route::post('/angsuran/{angsuran}/upload-bukti', [UserAngsuranController::class, 'uploadBukti'])->name('angsuran.upload-bukti');
    Route::get('/pembayaran', [UserAngsuranController::class, 'pembayaran'])->name('pembayaran.index');
    Route::get('/profil', [UserProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [UserProfileController::class, 'update'])->name('profil.update');
});

Route::prefix('marketing')->name('marketing.')->middleware(['auth', 'role:marketing'])->group(function () {
    Route::get('/dashboard', [MarketingDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengajuan/offline/create', [MarketingPengajuanKreditController::class, 'createOffline'])->name('pengajuan.offline.create');
    Route::post('/pengajuan/offline', [MarketingPengajuanKreditController::class, 'storeOffline'])->name('pengajuan.offline.store');
    Route::get('/pengajuan', [MarketingPengajuanKreditController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{pengajuan}', [MarketingPengajuanKreditController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{pengajuan}/status', [MarketingPengajuanKreditController::class, 'updateStatus'])->name('pengajuan.status');
    Route::put('/pengajuan/{pengajuan}/catatan', [MarketingPengajuanKreditController::class, 'updateCatatan'])->name('pengajuan.catatan');
    Route::get('/follow-up', [MarketingFollowUpController::class, 'index'])->name('follow-up.index');
    Route::get('/user-potensial', [MarketingFollowUpController::class, 'userPotensial'])->name('user-potensial.index');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('jenis-motor', AdminJenisMotorController::class);
    Route::resource('motor', AdminMotorController::class);
    Route::resource('jenis-cicilan', AdminJenisCicilanController::class);
    Route::resource('asuransi', AdminAsuransiController::class);
    Route::resource('metode-bayar', AdminMetodeBayarController::class);
    Route::get('/pengajuan/create-offline', [AdminPengajuanKreditController::class, 'createOffline'])->name('pengajuan.offline.create');
    Route::post('/pengajuan/offline', [AdminPengajuanKreditController::class, 'storeOffline'])->name('pengajuan.offline.store');
    Route::get('/pengajuan', [AdminPengajuanKreditController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{pengajuan}', [AdminPengajuanKreditController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{pengajuan}/approve', [AdminPengajuanKreditController::class, 'approve'])->name('pengajuan.approve');
    Route::put('/pengajuan/{pengajuan}/reject', [AdminPengajuanKreditController::class, 'reject'])->name('pengajuan.reject');
    Route::get('/kredit', [AdminKreditController::class, 'index'])->name('kredit.index');
    Route::get('/kredit/{kredit}', [AdminKreditController::class, 'show'])->name('kredit.show');
    Route::put('/kredit/{kredit}/status', [AdminKreditController::class, 'updateStatus'])->name('kredit.status');
    Route::get('/angsuran', [AdminAngsuranController::class, 'index'])->name('angsuran.index');
    Route::get('/angsuran/{angsuran}', [AdminAngsuranController::class, 'show'])->name('angsuran.show');
    Route::put('/angsuran/{angsuran}/validasi', [AdminAngsuranController::class, 'validasi'])->name('angsuran.validasi');
    Route::put('/angsuran/{angsuran}/tolak', [AdminAngsuranController::class, 'tolak'])->name('angsuran.tolak');
    Route::resource('pengiriman', AdminPengirimanController::class)->except(['create', 'store', 'destroy']);
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [AdminLaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
    Route::get('/laporan/export-excel', [AdminLaporanController::class, 'exportExcel'])->name('laporan.export-excel');
});

Route::prefix('ceo')->name('ceo.')->middleware(['auth', 'role:ceo'])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('ceo.laporan.penjualan'))->name('dashboard');
    Route::get('/laporan-penjualan', [CEOLaporanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('/laporan/export-pdf', [CEOLaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
    Route::get('/laporan/export-excel', [CEOLaporanController::class, 'exportExcel'])->name('laporan.export-excel');
});
