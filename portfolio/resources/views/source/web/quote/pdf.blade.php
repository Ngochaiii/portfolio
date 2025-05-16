<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo giá #{{ $quoteNumber }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 20px;
            margin: 0 0 5px;
            color: #2c3e50;
        }

        .quote-info {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .company-info,
        .customer-info {
            width: 48%;
            margin-bottom: 20px;
        }

        .company-info {
            float: left;
        }

        .customer-info {
            float: right;
            text-align: right;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .total-row th,
        .total-row td {
            font-weight: bold;
            font-size: 14px;
        }

        .package-includes {
            margin-bottom: 20px;
        }

        .payment-info {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="header">
        @if ($config && $config->company_logo)
            <img src="{{ public_path('storage/' . $config->company_logo) }}" alt="Logo" class="logo">
        @endif
        <h1>{{ $config->company_name ?? 'Hostist company' }}</h1>
        <div class="quote-info">
            Báo giá #{{ $quoteNumber }} - Ngày: {{ $quoteDate }}
        </div>
    </div>

    <div class="clearfix">
        <div class="company-info">
            <h3>Thông tin công ty:</h3>
            <p>{{ $config->company_name ?? 'Hostist company' }}</p>
            <p>{{ $config->company_address ?? '5335 Gate Pkwy, 2nd Floor, Jacksonville, FL 32256' }}</p>
            <p>Email: {{ $config->support_email ?? 'supposthostit@gmail.com' }}</p>
            <p>Điện thoại: {{ $config->support_phone ?? 'N/A' }}</p>
        </div>

        <div class="customer-info">
            <h3>Thông tin khách hàng:</h3>
            <p>{{ $user->name }}</p>
            <p>{{ $user->address ?? 'Chưa cung cấp địa chỉ' }}</p>
            <p>Email: {{ $user->email }}</p>
            @if ($user->customer && $user->customer->website)
                <p>Website: {{ $user->customer->website }}</p>
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mô tả</th>
                <th class="text-right">Số lượng</th>
                <th class="text-right">Đơn giá</th>
                <th class="text-right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->items as $item)
                @php
                    $options = json_decode($item->options, true) ?: [];
                    $period = $options['period'] ?? 1;
                    $productName = $item->product->name;
                    $domainName =
                        $user->customer && $user->customer->website ? $user->customer->website : 'your-domain.com';
                @endphp
                <tr>
                    <td>
                        {{ $period }} Year {{ $productName }}
                        @if ($item->product->type == 'ssl')
                            (Discounted)
                            for {{ $domainName }}
                        @endif
                    </td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                    <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Tổng phụ</th>
                <th class="text-right">{{ number_format($subtotal, 0, ',', '.') }} đ</th>
            </tr>
            <tr>
                <th colspan="3">Tín dụng</th>
                <th class="text-right">0 đ</th>
            </tr>
            <tr class="total-row">
                <th colspan="3">Tổng cộng</th>
                <th class="text-right">{{ number_format($total, 0, ',', '.') }} đ</th>
            </tr>
        </tfoot>
    </table>

    <div class="clearfix">
        <div class="package-includes" style="width: 48%; float: left;">
            <h3>Gói bao gồm</h3>
            <ul>
                @if ($cart->items[0]->product->type == 'ssl')
                    <li>Automatic Activation</li>
                    <li>Immediate Issuance (with DV certificates)</li>
                    <li>Unlimited Reissuance</li>
                    <li>Website Identity Verification</li>
                    <li>Encrypted Data Transmission</li>
                    <li>HTTPS Website Security</li>
                    <li>Improved Search Rankings</li>
                    <li>Builds Customer Trust</li>
                @else
                    <li>24/7 Technical Support</li>
                    <li>99.9% Uptime Guarantee</li>
                    <li>Free SSL Certificate</li>
                    <li>Easy Control Panel</li>
                    <li>Daily Backups</li>
                    <li>Unlimited Bandwidth</li>
                @endif
            </ul>
        </div>

        <!-- Trong phần payment info của file PDF -->
        <div class="payment-info">
            <h3>Thông tin thanh toán</h3>
            <p><strong>Số tiền:</strong> {{ number_format($total, 0, ',', '.') }} đ</p>
            <p><strong>Ngân hàng:</strong> ACB</p>
            <p><strong>Số tài khoản:</strong> {{ $config->company_bank_account_number ?? '24768' }}</p>
            <p><strong>Nội dung:</strong> {{ str_replace('QUOTE-', 'HD', $quoteNumber) }}</p>
            <p><strong>Ngày hết hạn:</strong> {{ $expireDate }}</p>

            <!-- QR code -->
            <div style="text-align: center; margin-top: 20px;">
                @if (isset($qrCodePath) && file_exists($qrCodePath))
                    <img src="{{ $qrCodePath }}" alt="QR Code" style="max-width: 150px;">
                @else
                    <p>Mã QR không khả dụng</p>
                @endif
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi. Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ
            {{ $config->support_email ?? 'supposthostit@gmail.com' }}</p>
        <p>Báo giá này có hiệu lực đến ngày {{ $expireDate }}</p>
    </div>
</body>

</html>
