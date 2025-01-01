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
            width: 65mm;
            margin: 0 auto;
        }

        .margin0 {
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

    $refunded = \App\Models\Refunded::where('current_invoice_id', $id)->first();

    $user = \App\Models\User::find($invoice->user_id);
    @endphp
    <h1 class="text-center" style=" font-weight: bolder">النسيم للاعلاف</h1>

    <div class="invoice-header" style="text-align: right; font-weight: bold;">
        <span>المسلسل: {{ $invoice->id }}</span>
        <span style="float: left;">اسم العميل: {{ $invoice->customerName ?? $invoice->customer->name }}</span>

    </div>
    <div class="invoice-header" style="text-align: right;">
        <span>التاريخ : {{ $invoice->created_at->format('y-m-d') }}</span>
        <span style="float: left;">
            {{ $invoice->created_at->format('h:i') }} {{ $invoice->created_at->format('A') === 'AM' ? 'ص' : 'م' }}
        </span>
        
    </div>
    
    <div class="invoice-header" style="text-align: right; font-weight: bold;">
        <span>اسم الكاشير: الحاج مبروك</span>
    </div>
    <div class="invoice-details" style="text-align: right;">

    </div>

    <div class="invoice-items">
        <table style="width: 100%; text-align: right; border-collapse: collapse; font-size: 16px; font-weight: bold; border: 2px solid black;">
            <thead>
                <tr>
                    <th style="border: 2px solid black; padding: 5px;" class="text-center">إجمالي السعر</th>
                    <th style="border: 2px solid black; padding: 5px;" class="text-center">سعر الصنف</th>
                    <th style="border: 2px solid black; padding: 5px;" class="text-center">الكمية</th>
                    <th style="border: 2px solid black; padding: 5px;" class="text-right">الصنف</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                <tr>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center">{{ $item->qty * $item->sellPrice }}</td>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center">{{ $item->sellPrice }}</td>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center">{{ $item->qty }}</td>
                    <td style="border: 2px solid black; padding: 5px; font_size:12px;" class="text-right">{{ $item->product->name }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center">{{ $invoice->total }}</td>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center"></td>
                    <td style="border: 2px solid black; padding: 5px;" class="text-center">{{$invoice->items->sum('qty') }}</td>
                    <td colspan="2" style="font-weight: bold; text-align: right; border: 2px solid black; padding: 5px;">الإجمالي</td>
                </tr>

            </tfoot>
        </table>
    </div>

    @if ($refunded)
    @php
    $refundedMoney = \App\Models\Invoice::find($refunded->refunded_invoice_id)->total;
    @endphp
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: right; flex: 1;">المرتجع:</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: left; flex: 1;">{{ $refundedMoney }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: right; flex: 1;">الإجمالي قبل المرتجع:</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: left; flex: 1;">{{ $invoice->total + $refundedMoney }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: right; flex: 1;">الإجمالي بعد المرتجع:</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: left; flex: 1;">{{ $invoice->total }}</span>
        </div>
    </div>
    @endif

    @if ($invoice->discount)
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: left; flex: 1;">{{ $invoice->discount }}</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: right; flex: 1;">الخصم</span>
        </div>
    </div>
    @endif

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: left; flex: 1;">{{ $invoice->total }}</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: right; flex: 1;">الاجمالي</span>
        </div>
    </div>

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: left; flex: 1;">{{ $invoice->payedAmount }}</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: right; flex: 1;">المدفوع</span>
        </div>
    </div>

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-weight: bold; margin: 2px 0;">
            <span style="text-align: left; flex: 1;">{{ $invoice->still }}</span>
            <span style="margin: 0 20px; flex: 1;"></span>
            <span style="text-align: right; flex: 1;">المتبقي</span>
        </div>
    </div>






    <hr class="margin0">
    <p class="text-center margin0">السعر شامل الضريبة</p>
    <p class="text-center font-bold margin0">العنوان : هلية -ببا -بني سويف </p>
    <p class="text-center font-bold margin0">رقم الهاتف : 01115179392</p>
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