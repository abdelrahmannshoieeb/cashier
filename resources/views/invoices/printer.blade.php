<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 80mm;
            /* Restrict the width for 80mm thermal paper */
            margin: 0 auto;
        }

        .margin0{
            margin: 0;
        }
        .invoice-header,
        .invoice-footer {
            text-align: center;
            margin-bottom: 10px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 16px;
        }

        .invoice-header p {
            margin: 0;
            font-size: 12px;
        }

        .invoice-details,
        .invoice-items {
            margin-bottom: 15px;
        }

        .invoice-details p,
        .invoice-items p {
            margin: 5px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-align: left;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>

<body>

    @php
    $id = request()->segment(2);
    $invoice = \App\Models\Invoice::find($id);
    @endphp
    <h1 class="text-center">محلات ابو المجد</h1>

    <div class="invoice-header" style="text-align: right;">
        <h1>فاتورة</h1>
        <p>تاريخ الإنشاء: {{ $invoice->created_at }}</p>
    </div>

    <div class="invoice-details" style="text-align: right;">
        <p>اسم العميل: {{ $invoice->customerName ?? $invoice->customer->name }}</p>
        <p>الحالة:
            @if($invoice->status === 'paid')
            مدفوعة
            @elseif($invoice->status === 'unpaid')
            غير مدفوعة
            @elseif($invoice->status === 'partially_paid')
            مدفوعة جزئيًا - المبلغ المتبقي: {{ $invoice->total - $invoice->payedAmount }}
            @endif
        </p>
        <p>المبلغ المدفوع: {{ $invoice->payedAmount }}</p>
        @if($invoice->notes)
        <p>ملاحظات: {{ $invoice->notes }}</p>
        @endif

    </div>

    <div class="invoice-items">
        <table style="width: 100%; text-align: right; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #ddd; padding: 5px;" class="text-center">الاسم</th>
                    <th style="border-bottom: 1px solid #ddd; padding: 5px;" class="text-center">الكمية</th>
                    <th style="border-bottom: 1px solid #ddd; padding: 5px;" class="text-center">سعر البيع</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                <tr>
                    <td style="padding: 5px;" class="text-center">{{ $item->product->name }}</td>
                    <td style="padding: 5px;" class="text-center">{{ $item->qty }}</td>
                    <td style="padding: 5px;" class="text-center">{{ $item->sellPrice }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"  style="font-weight: bold; text-align: left; padding: 5px;">الإجمالي</td>
                    <td style="padding: 5px;" class="text-center">{{ $invoice->total }}</td>
                </tr>
                @if($invoice->discount)

                <tr>
                    <td colspan="2" style="font-weight: bold; text-align: left; padding: 5px;">الخصم</td>
                    <td style="padding: 5px;">{{ $invoice->discount }}</td>
                </tr>
                @endif
            </tfoot>
        </table>
    </div>

    <div class="invoice-footer text-center margin0">
        <p class="margin0">شكرًا لتعاملكم معنا!</p>
    </div>
    <hr class="margin0">
    <p class="text-center margin0">السعر شامل الضريبة</p>
    <p class="text-center font-bold margin0">العنوان : العتبة محلات ابو المجد</p>
    <p class="text-center font-bold margin0">رقم الجوال : 01102102007</p>
    <p class="text-center">تم التطوير بواسطة <strong>Nexoria للبرمجيات</strong></p>


    <script>
        // Function to trigger printing
        function printInvoice() {
            window.print(); // Trigger the print dialog
        }

        // Wait until the page content is fully loaded, then trigger the print dialog
        window.onload = function() {
            setTimeout(function() {
                printInvoice();
            }, 500); // Delay of 500 milliseconds to ensure content has loaded
        };
    </script>

</body>

</html>