<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Báo giá</title>
    <style type="text/css">
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.2;
            color: #333333;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
        }

        .header {
            font-size: 20pt;
            font-weight: bold;
            text-align: center;
        }

        .subheader {
            font-size: 11pt;
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .bg-gray {
            background-color: #f2f2f2;
        }

        .border-top {
            border-top: 1px solid #dddddd;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-italic {
            font-style: italic;
        }

        .signature-space {
            height: 50px;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td align="left" valign="top" width="50%">
                Logo
            </td>
            <td align="right" valign="top" width="50%"></td>
        </tr>
        <tr>
            <td align="center" valign="top" colspan="2" class="header">
                QUOTATION
            </td>
        </tr>
        <tr>
            <td align="center" valign="top" colspan="2" class="subheader">
                CREATED DATE: {{ $quoteDate ?? '20/05/2025' }}<br />
                VALID FOR: {{ $validity ?? '30 days' }}
            </td>
        </tr>
    </table>

    <!-- Company and customer information -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
        <tr>
            <td width="49%" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#dddddd">
                    <tr>
                        <td class="bg-gray bold">PROVIDER</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $config->company_name ?? 'Hostist company' }}<br />
                            {{ $config->company_address ?? '5335 Gate Pkwy, 2nd Floor, Jacksonville, FL 32256' }}<br />
                            Email: {{ $config->support_email ?? 'supporthostit@gmail.com' }}<br />
                            URL: {{ $config->website ?? 'www.hostist.com' }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="2%"></td>
            <td width="49%" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#dddddd">
                    <tr>
                        <td class="bg-gray bold">CLIENT</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $user->name ?? 'Customer' }}<br />
                            Address: {{ $user->address ?? 'Address not provided' }}<br />
                            Phone: {{ $user->phone ?? 'N/A' }}<br />
                            Email: {{ $user->email ?? '' }}<br />
                            @if (isset($user->customer) && isset($user->customer->website))
                                URL: {{ $user->customer->website }}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Tiêu đề nội dung -->
    <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#dddddd"
        style="margin-top: 10px;">
        <tr>
            <td align="center" class="bg-gray bold">
                CONTENTS: QUOTATION FOR {{ strtoupper($cart->items[0]->product->type ?? 'SSL') }} PACKAGE FOR WEBSITE
            </td>
        </tr>
    </table>

    <!-- Bảng sản phẩm -->
    <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#dddddd" style="margin-top: 0px;">
        <tr class="bg-gray bold">
            <td width="3%" align="center">#</td>
            <td width="45%" align="center">DESCRIPTION</td>
            <td width="7%" align="center">QUANTITY</td>
            <td width="7%" align="center">DURATION<br />(YEAR)</td>
            <td width="10%" align="center">SERVER</td>
            <td width="10%" align="center">KEYPAIR</td>
            <td width="9%" align="center">UNIT PRICE<br />(VND)</td>
            <td width="9%" align="center">AMOUNT<br />(VND)</td>
        </tr>

        @foreach ($cart->items as $index => $item)
            @php
                $options = json_decode($item->options, true) ?: [];
                $period = $options['period'] ?? 1;
                $domain = $options['domain'] ?? null;
                $server = isset($options['server']) ? $options['server'] : 'Không giới hạn';
                $keypair = isset($options['keypair']) ? $options['keypair'] : 'Không giới hạn';
            @endphp
            <tr>
                <td align="center" valign="top">{{ $index + 1 }}</td>
                <td valign="top"> Providing international public digital certificate
                    {{ $item->product->name ?? 'SSL' }} for website domain.<br /> - Package: 01
                    {{ $item->product->name ?? 'SSL Certificate' }}<br /> - Domain in use:
                    {{ $domain ? '*.' . $domain : 'N/A' }}<br /> - Verification level: Domain verification<br /><br />
                    Included:<br /> - Direct certificate management account access (https://gcc.globalsign.com)<br /> -
                    Unlimited server installations<br /> - Unlimited keypairs for server use<br /> - Support and
                    troubleshooting within 24 hours<br /> - Valid products/services with genuine origin, receiving
                    technical support and after-sales warranty service according to supplier standards. </td>
                <td align="center" valign="middle">{{ $item->quantity }}</td>
                <td align="center" valign="middle">{{ $period }} year</td>
                <td align="center" valign="middle">{{ $server }}</td>
                <td align="center" valign="middle">{{ $keypair }}</td>
                <td align="right" valign="middle">{{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                <td align="right" valign="middle">{{ number_format($item->subtotal, 0, ',', '.') }} đ</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="6"></td>
            <td align="right" class="bold">Total</td>
            <td align="right" class="bold">{{ number_format($total, 0, ',', '.') }} đ</td>
        </tr>

        @if (isset($discount) && $discount > 0)
            <tr>
                <td colspan="6"></td>
                <td align="right">Giảm giá</td>
                <td align="right">{{ number_format($discount, 0, ',', '.') }} đ</td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td align="right" class="bold">Total after discount</td>
                <td align="right" class="bold">{{ number_format($total - $discount, 0, ',', '.') }} đ</td>
            </tr>
        @endif
    </table>

    <!-- Amount in words -->
    <table width="100%" border="0" cellpadding="5" cellspacing="0" style="margin-top: 5px;">
        <tr>
            <td align="center" class="text-italic">
                Amount in words: {{ $total_in_words ?? 'Contact us for more details' }}
            </td>
        </tr>
        <tr>
            <td align="center" class="text-italic" style="font-size: 9pt;">
                (Quotation includes all applicable taxes and fees)
            </td>
        </tr>
    </table>

    <!-- Technical specifications and payment -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
        <tr>
            <td width="58%" valign="top">
                <table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <tr>
                        <td><b>Standard Technical Specifications:</b></td>
                    </tr>
                    <tr>
                        <td>
                            <ul style="margin: 0; padding-left: 20px;">
                                @if (isset($cart->items[0]->product) && $cart->items[0]->product->type == 'ssl')
                                    <li>Certificate Type: {{ $cart->items[0]->product->name ?? 'SSL Certificate' }}
                                    </li>
                                    <li>Website domain verification</li>
                                    <li>Key length from 2048 bit</li>
                                    <li>Security standard from 128 bit to 256 bit - RSA & DSA Algorithm Support</li>
                                    @if (strpos(strtolower($cart->items[0]->product->name ?? ''), 'wildcard') !== false)
                                        <li>Wildcard extension support</li>
                                    @endif
                                    <li>Secure Site Seal:
                                        {{ strpos(strtolower($cart->items[0]->product->name ?? ''), 'alpha') !== false ? 'Alpha Seal' : 'Secure Seal' }}
                                    </li>
                                    <li>Unlimited reissues and number of digital certificates issued</li>
                                    @if (strpos(strtolower($cart->items[0]->product->name ?? ''), 'wildcard') !== false)
                                        <li>Unlimited first-level subdomains using digital certificate (*.*)</li>
                                    @endif
                                    <li>Compatible with 99.999% of browsers and operating systems</li>
                                    <li>Certificate warranty coverage of $10,000 USD</li>
                                @elseif (isset($cart->items[0]->product) && $cart->items[0]->product->type == 'hosting')
                                    <li>Operating System: Linux</li>
                                    <li>Control Panel: cPanel</li>
                                    <li>PHP 5.6 - 8.2</li>
                                    <li>MySQL 5.7+</li>
                                    <li>Free Let's Encrypt SSL</li>
                                    <li>Daily Backup</li>
                                    <li>Anti-DDoS Protection</li>
                                    <li>99.9% Uptime Guarantee</li>
                                    <li>24/7 Technical Support</li>
                                @elseif (isset($cart->items[0]->product) && $cart->items[0]->product->type == 'domain')
                                    <li>Full DNS management</li>
                                    <li>Domain theft protection</li>
                                    <li>Email forwarding</li>
                                    <li>URL forwarding</li>
                                    <li>Custom nameservers</li>
                                    <li>Domain lock against unauthorized transfers</li>
                                    <li>Auto-renewal (optional)</li>
                                @else
                                    <li>24/7 technical support</li>
                                    <li>Warranty according to manufacturer standards</li>
                                    <li>Latest version updates</li>
                                    <li>User documentation</li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="2%"></td>
            <td width="40%" valign="top">
                <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#dddddd"
                    bgcolor="#f9f9f9">
                    <tr>
                        <td>
                            <p><b>Payment Information</b></p>
                            <p><b>Amount:</b> {{ number_format($total, 0, ',', '.') }} đ</p>
                            <p><b>Bank:</b> {{ $config->bank_name ?? 'ACB' }}</p>
                            <p><b>Account Number:</b> {{ $config->company_bank_account_number ?? '218906666' }}</p>
                            <p><b>Account Holder:</b> {{ $config->company_name ?? 'Hostist company' }}</p>
                            <p><b>Reference:</b> {{ str_replace('QUOTE-', 'INV', $quoteNumber) }}</p>
                            <p><b>Expiration Date:</b> {{ $expireDate }}</p>

                            <div align="center" style="margin-top: 5px;">
                                <p>QR Code:</p>
                                @if (isset($qrCodePath) && file_exists($qrCodePath))
                                    <img src="{{ $qrCodePath }}" alt="QR Code"
                                        style="width: 80px; height: 80px; border: 1px solid #ddd; padding: 3px; background-color: white;" />
                                @else
                                    <div
                                        style="width: 80px; height: 80px; border: 1px solid #ddd; padding: 3px; background-color: white; margin: 0 auto;">
                                        QR Code</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="border-top"
        style="margin-top: 20px;">
        <tr>
            <td align="center" style="font-size: 9pt;">
                Thank you for choosing our services. If you have any questions, please contact
                {{ $config->support_email ?? 'supporthostit@gmail.com' }}
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 9pt;">
                This quotation is valid until {{ $expireDate }}
            </td>
        </tr>
    </table>
</body>

</html>
