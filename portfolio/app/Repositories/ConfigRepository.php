<?php

namespace App\Repositories;

use App\Models\Config;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ConfigRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     */
    public function model()
    {
        return Config::class;
    }

    /**
     * Get validation rules for config
     */
    protected function getValidationRules()
    {
        return [
            'url' => 'nullable|url',
            'theme_color' => 'nullable|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'months_name' => 'nullable|array',
            'page_of_text' => 'nullable|array',
            'adsense_non_personalized' => 'boolean',
            'enable_rss' => 'boolean',
            'enable_adsense' => 'boolean',
            'enable_twitter' => 'boolean',
            'enable_youtube' => 'boolean',
            'enable_instagram' => 'boolean',
            'enable_pinterest' => 'boolean',
            'enable_linkedin' => 'boolean',
            'enable_disqus' => 'boolean',
            'enable_github' => 'boolean',
            'enable_gravatar' => 'boolean',
            'related_posts_num' => 'integer|min:0',
            'posts_per_page' => 'integer|min:1',
        ];
    }

    /**
     * Get current config
     */
    public function getCurrent()
    {
        return $this->model->first();
    }

    /**
     * Create new config if not exists
     */
    public function createIfNotExists(array $data)
    {
        try {
            // Clean and validate data
            $data = $this->validateAndClean($data, $this->getValidationRules());

            // Check if config already exists
            if ($this->getCurrent()) {
                throw new \Exception('Config already exists. Use update instead.');
            }

            // Create new config
            $config = $this->create($data);

            Log::info('Created new config', ['data' => $config->toArray()]);

            return $config;
        } catch (ValidationException $e) {
            Log::error('Config validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to create config', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Update existing config
     */
    public function updateConfig(array $data)
    {
        try {
            // Clean and validate data
            $data = $this->validateAndClean($data, $this->getValidationRules());

            // Get current config
            $config = $this->getCurrent();
            if (!$config) {
                return $this->createIfNotExists($data);
            }

            // Update config
            $config = $this->update($data, $config->id);

            Log::info('Updated config', ['id' => $config->id, 'data' => $data]);

            return $config;
        } catch (ValidationException $e) {
            Log::error('Config update validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to update config', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Toggle boolean config value
     */
    public function toggleFeature($feature)
    {
        try {
            $config = $this->getCurrent();
            if (!$config) {
                throw new \Exception('Config not found');
            }

            // Check if feature exists and is boolean
            if (!array_key_exists($feature, $config->getCasts()) ||
                $config->getCasts()[$feature] !== 'boolean') {
                throw new \Exception("Invalid feature or feature is not boolean: {$feature}");
            }

            // Toggle the feature
            $data = [$feature => !$config->{$feature}];
            $config = $this->update($data, $config->id);

            Log::info("Toggled config feature: {$feature}", ['new_value' => $config->{$feature}]);

            return $config;
        } catch (\Exception $e) {
            Log::error('Failed to toggle feature', ['feature' => $feature, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Get config value by key
     */
    public function getValue($key, $default = null)
    {
        $config = $this->getCurrent();
        return $config ? $config->{$key} : $default;
    }
}
