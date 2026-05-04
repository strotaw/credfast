<?php

namespace App\Http\Controllers;

use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\JenisMotor;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Support\CreditCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('public.index', [
            'featuredMotors' => Motor::query()
                ->with('jenisMotor')
                ->where('status', Motor::STATUS_TERSEDIA)
                ->latest()
                ->take(6)
                ->get(),
            'motorCount' => Motor::query()->where('status', Motor::STATUS_TERSEDIA)->count(),
            'tenorCount' => JenisCicilan::query()->count(),
            'brandCount' => JenisMotor::query()->count(),
            'jenisMotors' => JenisMotor::query()->withCount('motor')->latest()->take(6)->get(),
            'asuransiList' => Asuransi::query()->latest()->take(4)->get(),
            'metodeBayarList' => MetodeBayar::query()->where('status', MetodeBayar::STATUS_AKTIF)->latest()->take(4)->get(),
        ]);
    }

    public function motor(Request $request): View
    {
        $motors = Motor::query()
            ->with('jenisMotor')
            ->where('status', '!=', Motor::STATUS_NONAKTIF)
            ->when($request->filled('q'), fn ($query) => $query->where('nama_motor', 'like', '%'.$request->string('q').'%'))
            ->when($request->filled('jenis_motor_id'), fn ($query) => $query->where('jenis_motor_id', $request->integer('jenis_motor_id')))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.motor.index', [
            'motors' => $motors,
            'jenisMotors' => JenisMotor::query()->orderBy('merk')->get(),
        ]);
    }

    public function motorShow(Motor $motor): View
    {
        $motor->load('jenisMotor');

        return view('public.motor.show', [
            'motor' => $motor,
            'relatedMotors' => Motor::query()
                ->with('jenisMotor')
                ->whereKeyNot($motor->id)
                ->where('status', Motor::STATUS_TERSEDIA)
                ->where('jenis_motor_id', $motor->jenis_motor_id)
                ->take(4)
                ->get(),
        ]);
    }

    public function simulasi(Request $request): View
    {
        $simulation = null;

        if ($request->filled('motor_id') && $request->filled('jenis_cicilan_id') && $request->filled('dp')) {
            $validator = Validator::make($request->all(), [
                'motor_id' => ['required', 'exists:motor,id'],
                'jenis_cicilan_id' => ['required', 'exists:jenis_cicilan,id'],
                'asuransi_id' => ['nullable', 'exists:asuransi,id'],
                'dp' => ['required', 'numeric', 'min:0'],
            ]);

            $validator->validate();

            $motor = Motor::query()->findOrFail($request->integer('motor_id'));
            $jenisCicilan = JenisCicilan::query()->findOrFail($request->integer('jenis_cicilan_id'));
            $asuransi = $request->filled('asuransi_id')
                ? Asuransi::query()->findOrFail($request->integer('asuransi_id'))
                : null;

            abort_if($motor->status !== Motor::STATUS_TERSEDIA || $motor->stok <= 0, 422, 'Motor tidak tersedia.');

            $simulation = CreditCalculator::calculate($motor->harga_jual, $request->input('dp'), $jenisCicilan, $asuransi);
            $simulation['motor'] = $motor;
            $simulation['jenisCicilan'] = $jenisCicilan;
            $simulation['asuransi'] = $asuransi;
        }

        return view('public.simulasi', [
            'motors' => Motor::query()->with('jenisMotor')->where('status', Motor::STATUS_TERSEDIA)->get(),
            'jenisCicilan' => JenisCicilan::query()->orderBy('lama_cicilan')->get(),
            'asuransi' => Asuransi::query()->orderBy('nama_asuransi')->get(),
            'simulation' => $simulation,
        ]);
    }

    public function tentang(): View
    {
        return view('public.tentang');
    }

    public function kontak(): View
    {
        return view('public.kontak');
    }
}
