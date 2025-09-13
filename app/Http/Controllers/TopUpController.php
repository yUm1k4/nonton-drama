<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopUpRequest;
use App\Interfaces\CoinPackageRepositoryInterface;
use App\Interfaces\TopUpRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopUpController extends Controller
{
    protected $coinPackageRepository;
    protected $topUpRepository;

    public function __construct(
        CoinPackageRepositoryInterface $coinPackageRepository,
        TopUpRepositoryInterface $topUpRepository
    )
    {
        $this->coinPackageRepository = $coinPackageRepository;
        $this->topUpRepository = $topUpRepository;
    }

    public function index(Request $request)
    {
        $coinPackages = $this->coinPackageRepository->getAll();
        $returnUrl = $request->query('redirect_url');

        if (Str::contains($returnUrl, 'series')) {
            $text = 'Lanjutkan Menonton';
            $icon = false;
        } else {
            $returnUrl = route('profile');
            $text = 'Lihat Dompet Saya';
            $icon = true;
        }

        $action = [
            'url' => $returnUrl,
            'text' => $text,
            'icon' => $icon,
        ];

        session(['after_payment_action' => $action]);

        return view('pages.topup.index', compact('coinPackages'));
    }

    public function store(TopUpRequest $request)
    {
        $data = $request->validated();

        $paymentUrl = $this->topUpRepository->create($data);

        return redirect($paymentUrl);
    }

    public function success()
    {
        return view('pages.topup.success');
    }
}
