@extends('layouts.admin.index')
@section('content')
    <section class="content">
        <form action="{{ route('admin.configs.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cơ bản</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="site_name">Tên website</label>
                                <input type="text" id="site_name" name="site_name" class="form-control"
                                    value="{{ old('site_name', $config->site_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="url" id="url" name="url" class="form-control"
                                    value="{{ old('url', $config->url ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $config->description ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="keywords">Từ khóa</label>
                                <textarea id="keywords" name="keywords" class="form-control" rows="2">{{ old('keywords', $config->keywords ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="author">Tác giả</label>
                                <input type="text" id="author" name="author" class="form-control"
                                    value="{{ old('author', $config->author ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Giao diện -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Giao diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="theme_color">Màu chủ đạo</label>
                                <input type="color" id="theme_color" name="theme_color" class="form-control"
                                    value="{{ old('theme_color', $config->theme_color ?? '#002ce6') }}">
                            </div>
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <input type="file" id="favicon" name="favicon" class="form-control">
                                @if ($config->favicon)
                                    <img src="{{ $config->favicon }}" class="mt-2" style="max-height: 32px">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="og_image">OG Image</label>
                                <input type="file" id="og_image" name="og_image" class="form-control">
                                @if ($config->og_image)
                                    <img src="{{ $config->og_image }}" class="mt-2" style="max-height: 100px">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media & Features -->
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Social Media</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="facebook_page">Facebook Page</label>
                                <input type="text" id="facebook_page" name="facebook_page" class="form-control"
                                    value="{{ old('facebook_page', $config->facebook_page ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="fb_app_id">Facebook App ID</label>
                                <input type="text" id="fb_app_id" name="fb_app_id" class="form-control"
                                    value="{{ old('fb_app_id', $config->fb_app_id ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="twitter_creator">Twitter Creator</label>
                                <input type="text" id="twitter_creator" name="twitter_creator" class="form-control"
                                    value="{{ old('twitter_creator', $config->twitter_creator ?? '') }}">
                            </div>

                            <h4 class="mt-4">Tính năng</h4>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enable_rss"
                                        name="enable_rss"
                                        {{ old('enable_rss', $config->enable_rss ?? false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_rss">Bật RSS</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enable_disqus"
                                        name="enable_disqus"
                                        {{ old('enable_disqus', $config->enable_disqus ?? false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_disqus">Bật Disqus</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cài đặt Adsense -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Google Adsense</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enable_adsense"
                                        name="enable_adsense"
                                        {{ old('enable_adsense', $config->enable_adsense ?? false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="enable_adsense">Bật Adsense</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adsense_platform_account">Tài khoản Adsense</label>
                                <input type="text" id="adsense_platform_account" name="adsense_platform_account"
                                    class="form-control"
                                    value="{{ old('adsense_platform_account', $config->adsense_platform_account ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút Submit -->
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Hủy</a>
                    <button type="submit" class="btn btn-success float-right">Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@push('css')
    <style>
        .custom-switch {
            padding-left: 2.25rem;
        }

        .card-body {
            padding: 1.25rem;
        }
    </style>
@endpush
