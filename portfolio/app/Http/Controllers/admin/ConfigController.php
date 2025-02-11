<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ConfigRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            // Log data trước khi update
            Log::info('Config update data:', $request->all());

            // Xử lý các trường boolean
            $data = $request->all();
            $booleanFields = [
                'enable_rss', 'enable_adsense', 'enable_twitter',
                'enable_youtube', 'enable_instagram', 'enable_pinterest',
                'enable_linkedin', 'enable_disqus', 'enable_github',
                'enable_gravatar', 'adsense_non_personalized'
            ];

            foreach ($booleanFields as $field) {
                $data[$field] = $request->has($field);
            }

            // Xử lý các trường JSON
            if ($request->has('months_name')) {
                $data['months_name'] = json_decode($request->months_name, true);
            }
            if ($request->has('page_of_text')) {
                $data['page_of_text'] = json_decode($request->page_of_text, true);
            }

            // Update config
            $config = $this->configRepository->updateConfig($data);

            // Log kết quả
            Log::info('Config updated successfully:', [
                'config_id' => $config->id,
                'updated_data' => $config->toArray()
            ]);

            return redirect()->back()->with('success', 'Cập nhật cấu hình thành công');
        } catch (\Exception $e) {
            Log::error('Config update failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
