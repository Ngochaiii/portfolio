@extends('layouts.web.index')

@section('content')
<section class="service_detail_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>{{ $product->name }}</h2>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="service_info card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="short_desc">
                                    <p class="lead">{{ $product->short_description ?? Str::limit(strip_tags($product->description), 200) }}</p>
                                </div>

                                @if($product->category)
                                <div class="category mt-3">
                                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                                </div>
                                @endif

                                <div class="type mt-2">
                                    <p><strong>Type:</strong>
                                        @switch($product->type)
                                            @case('ssl')
                                                SSL Certificate
                                                @break
                                            @case('hosting')
                                                Hosting
                                                @break
                                            @case('domain')
                                                Domain Name
                                                @break
                                            @default
                                                {{ ucfirst($product->type) }}
                                        @endswitch
                                    </p>
                                </div>

                                @if($product->is_recurring)
                                <div class="billing_cycle mt-2">
                                    <p><strong>Billing Cycle:</strong> {{ $product->recurring_period }} months</p>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="price_box text-center p-4 bg-light rounded">
                                    @if($product->sale_price)
                                        <h3 class="sale_price text-success">{{ number_format($product->sale_price, 0, ',', '.') }} đ</h3>
                                        <h5 class="regular_price text-muted"><del>{{ number_format($product->price, 0, ',', '.') }} đ</del></h5>
                                    @else
                                        <h3 class="text-primary">{{ number_format($product->price, 0, ',', '.') }} đ</h3>
                                    @endif

                                    <div class="action_buttons mt-4">
                                        <a href="#" class="btn btn-primary btn-block mb-2">Add to Cart</a>
                                        <a href="#" class="btn btn-outline-primary btn-block">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">Description</h4>
                    </div>
                    <div class="card-body">
                        <div class="description-content">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($variants->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">Available Plans</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($variants as $variant)
                                    <tr>
                                        <td><strong>{{ $variant->name }}</strong></td>
                                        <td>{{ $variant->short_description ?? Str::limit(strip_tags($variant->description), 100) }}</td>
                                        <td class="text-right">{{ number_format($variant->price, 0, ',', '.') }} đ</td>
                                        <td>
                                            <a href="{{ route('service.detail', $variant->slug) }}" class="btn btn-sm btn-info">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">Related Services</h3>
            </div>

            @foreach($relatedProducts as $related)
            <div class="col-md-6 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>{{ $related->name }}</h4>
                        <p>{{ Str::limit($related->short_description ?? strip_tags($related->description), 120) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="text-primary mb-0">{{ number_format($related->price, 0, ',', '.') }} đ</h5>
                            <a href="{{ route('service.detail', $related->slug) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
