<?php

namespace App\Repositories;

use App\Models\Config;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Cache;

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
     * Cache key for config
     */
    const CACHE_KEY = 'site_config';

    /**
     * Get current config
     */
    public function getCurrent()
    {
        return Cache::remember(self::CACHE_KEY, 60 * 24, function () {
            return $this->model->first();
        });
    }

    /**
     * Get config value by key
     */
    public function get($key, $default = null)
    {
        $config = $this->getCurrent();
        return $config ? $config->{$key} : $default;
    }

    /**
     * Update config
     */
    public function updateConfig(array $data)
    {
        // Validate data
        $data = $this->validateAndClean($data, [
            'site_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'theme_color' => 'nullable|string|max:7',
            'favicon' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
            'no_thumb_image' => 'nullable|string|max:255',
            'facebook_author' => 'nullable|string|max:255',
            'facebook_page' => 'nullable|string|max:255',
            'fb_app_id' => 'nullable|string|max:255',
            'fb_admin_id' => 'nullable|string|max:255',
            'twitter_creator' => 'nullable|string|max:255',
            'adsense_platform_account' => 'nullable|string|max:255',
            'adsense_platform_domain' => 'nullable|string|max:255',
            'adsense_non_personalized' => 'boolean',
            'related_posts_num' => 'integer|min:0',
            'posts_per_page' => 'integer|min:1',
            'comments_system' => 'string|in:blogger,disqus',
            'disqus_shortname' => 'nullable|string|max:255',
            'months_name' => 'nullable|array',
            'page_of_text' => 'nullable|array',
            'show_more_text' => 'nullable|string|max:255',
            'follow_by_email_text' => 'nullable|string|max:255',
            'related_posts_text' => 'nullable|string|max:255',
            'load_more_text' => 'nullable|string|max:255',
            'cookie_message' => 'nullable|string',
            'cookie_accept_text' => 'nullable|string|max:255',
            'cookie_learn_more_text' => 'nullable|string|max:255',
            'cookie_policy_url' => 'nullable|string|max:255',
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
            'blog_service_url' => 'nullable|string|max:255',
            'profile_url' => 'nullable|string|max:255',
        ]);

        $config = $this->getCurrent();

        if (!$config) {
            $result = $this->create($data);
        } else {
            $result = $this->update($data, $config->id);
        }

        // Clear cache after update
        Cache::forget(self::CACHE_KEY);

        return $result;
    }

    /**
     * Update single config
     */
    public function updateSingle($key, $value)
    {
        $config = $this->getCurrent();
        if (!$config) {
            return $this->create([$key => $value]);
        }

        $result = $this->update([$key => $value], $config->id);
        Cache::forget(self::CACHE_KEY);

        return $result;
    }

     /**
     * Toggle boolean config value
     * @param string $key Key cần toggle
     * @return Config|null
     */
    public function toggleConfig($key)
    {
        $config = $this->getCurrent();
        if (!$config) {
            return null;
        }

        return $this->updateSingle($key, !$config->{$key});
    }

    /**
     * Override toggle method từ AbstractRepository
     * @param int $id
     * @param string $field
     * @return bool
     */
    public function toggle($id, $field = 'status')
    {
        return parent::toggle($id, $field);
    }
}
