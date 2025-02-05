<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();

            // Thông tin cơ bản website
            $table->string('site_name')->nullable();
            $table->string('url')->nullable();
            $table->string('domain')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('author')->nullable();

            // Theme và Giao diện
            $table->string('theme_color')->default('#002ce6');
            $table->string('favicon')->nullable();
            $table->string('og_image')->nullable();
            $table->string('no_thumb_image')->nullable();

            // Social Media & Sharing
            $table->string('facebook_author')->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('fb_app_id')->nullable();
            $table->string('fb_admin_id')->nullable();
            $table->string('twitter_creator')->nullable();

            // Google Adsense
            $table->string('adsense_platform_account')->nullable();
            $table->string('adsense_platform_domain')->nullable();
            $table->boolean('adsense_non_personalized')->default(1);

            // Blog/Content Settings
            $table->integer('related_posts_num')->default(3);
            $table->integer('posts_per_page')->default(6);
            $table->string('comments_system')->default('blogger');
            $table->string('disqus_shortname')->nullable();

            // Cài đặt ngôn ngữ
            $table->json('months_name')->nullable();
            $table->json('page_of_text')->nullable();

            // Text UI
            $table->string('show_more_text')->nullable();
            $table->string('follow_by_email_text')->nullable();
            $table->string('related_posts_text')->nullable();
            $table->string('load_more_text')->nullable();

            // Cookie Consent
            $table->text('cookie_message')->nullable();
            $table->string('cookie_accept_text')->nullable();
            $table->string('cookie_learn_more_text')->nullable();
            $table->string('cookie_policy_url')->nullable();

            // Feature Flags
            $table->boolean('enable_rss')->default(false);
            $table->boolean('enable_adsense')->default(false);
            $table->boolean('enable_twitter')->default(false);
            $table->boolean('enable_youtube')->default(false);
            $table->boolean('enable_instagram')->default(false);
            $table->boolean('enable_pinterest')->default(false);
            $table->boolean('enable_linkedin')->default(false);
            $table->boolean('enable_disqus')->default(false);
            $table->boolean('enable_github')->default(false);
            $table->boolean('enable_gravatar')->default(false);

            // Additional URLs
            $table->string('blog_service_url')->nullable();
            $table->string('profile_url')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configs');
    }
};
