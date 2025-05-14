@extends('layouts.web.index')

@section('content')
    <section class="price_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>{{ $category->name }} Pricing</h2>
            </div>
            <div class="price_container">
                @forelse($products as $product)
                    <!-- Sản phẩm {{ $loop->iteration }} -->
                    <div class="box" style="position: relative; overflow: visible;">
                        @if ($product->sale_price && $product->price > $product->sale_price)
                            @php
                                $discount = round(100 - ($product->sale_price * 100) / $product->price);
                            @endphp
                            <div
                                style="position: absolute; top: -15px; right: -15px; background-color: #ff5722; color: white; padding: 10px; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <div style="text-align: center; line-height: 1.2;">
                                    <small style="font-size: 10px;">SAVE</small><br>
                                    <span>{{ $discount }}%</span>
                                </div>
                            </div>
                        @endif
                        <div class="detail-box">
                            <h2>
                                {{ number_format($product->sale_price ?: $product->price, 0, ',', '.') }}
                                <span>Đ
                                    @if ($product->is_recurring && $product->recurring_period)
                                        /{{ $product->recurring_period == 12 ? 'year' : ($product->recurring_period == 1 ? 'month' : $product->recurring_period . ' months') }}
                                    @endif
                                </span>
                            </h2>
                            <h6>{{ $product->name }}</h6>

                            @php
                                // Lấy các features từ description hoặc meta_data
                                $features = [];

                                // Kiểm tra nếu có meta_data và có features trong đó
                                if ($product->meta_data) {
                                    $metaData = json_decode($product->meta_data, true);
                                    if (
                                        is_array($metaData) &&
                                        isset($metaData['features']) &&
                                        is_array($metaData['features'])
                                    ) {
                                        $features = $metaData['features'];
                                    }
                                }

                                // Nếu không có features, tìm trong description
                                if (empty($features) && $product->description) {
                                    // Tìm các dòng bắt đầu bằng dấu "-" hoặc "*" trong description
                                    preg_match_all(
                                        '/[\-\*]\s*([^\n\r]+)/',
                                        strip_tags($product->description),
                                        $matches,
                                    );
                                    if (!empty($matches[1])) {
                                        $features = array_slice($matches[1], 0, 7); // Lấy tối đa 7 features
                                    }
                                }

                                // Nếu vẫn không có, tạo từ short_description
                                if (empty($features) && $product->short_description) {
                                    // Phân tách các câu bằng dấu chấm và làm sạch
                                    $sentences = array_filter(
                                        array_map('trim', explode('.', $product->short_description)),
                                        function ($item) {
                                            return !empty($item);
                                        },
                                    );

                                    // Nếu có ít nhất 1 câu, sử dụng làm features
                                    if (count($sentences) > 0) {
                                        $features = array_slice($sentences, 0, 7);
                                    }
                                }

                                // Thêm feature dựa trên thời gian nếu có
                                if ($product->is_recurring && $product->recurring_period) {
                                    if ($product->recurring_period == 12) {
                                        $features[] = '1 Year Coverage';
                                    } elseif ($product->recurring_period == 36) {
                                        $features[] = 'Extended 3-Year Coverage';
                                    } elseif ($product->recurring_period == 60) {
                                        $features[] = 'Premium 5-Year Coverage';
                                        $features[] = 'Priority Technical Support';
                                    }
                                }
                            @endphp

                            <ul class="price_features">
                                @foreach ($features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-box">
                            <a href="{{ route('service.detail', $product->slug) }}">Order Now</a>
                        </div>
                    </div>
                @empty
                    <div class="box">
                        <div class="detail-box">
                            <h6>No products available for this category</h6>
                            <p>Please check back later for new offers.</p>
                        </div>
                        <div class="btn-box">
                            <a href="{{ route('home') }}">Back to Home</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
