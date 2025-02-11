<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    protected $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function edit()
    {
        $config = $this->configRepository->getCurrent();
        return view('source.admin.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        try {
            $config = $this->configRepository->updateConfig($request->all());
            return redirect()->back()->with('success', 'Cập nhật cấu hình thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
