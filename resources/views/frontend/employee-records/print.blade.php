{{-- Print View Details
src: resources/views/pages/employee-records/print.blade.php
--}}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        /* ===== MOBILE RESPONSIVE ===== */
@media screen and (max-width: 640px) {
    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    .print-actions {
        top: .5rem;
        gap: .35rem;
    }

    .btn-print,
    .btn-back {
        padding: .35rem .75rem;
        font-size: .78rem;
    }

    #page-container {
        position: relative !important;
        width: 100vw;
        overflow: hidden !important;
        /* height injected by JS */
    }

    .pf {
        position: relative !important;
        transform-origin: top left;
        margin: 0 !important;
        /* transform injected by JS */
    }

    .pc {
        overflow: visible !important;
    }
}
    </style>
    <script>
    (function () {
        var A4_W = 595.28;   // pt width the page was built for
        var A4_H = 841.89;

        function scalePage() {
            if (window.innerWidth >= 641) {
                // reset any inline styles set by this script on desktop
                var pf = document.querySelector('.pf');
                var pc = document.getElementById('page-container');
                if (pf) pf.style.cssText = '';
                if (pc) pc.style.height = '';
                return;
            }

            var vw    = window.innerWidth;
            var scale = vw / A4_W;

            var pf = document.querySelector('.pf');
            var pc = document.getElementById('page-container');

            if (pf) {
                pf.style.transform       = 'scale(' + scale + ')';
                pf.style.transformOrigin = 'top left';
                pf.style.width           = A4_W + 'px';
            }

            // collapse the dead space created by the scale shrink
            if (pc) {
                pc.style.height = Math.ceil(A4_H * scale + 48) + 'px'; // +48 for action bar
            }
        }

        scalePage();
        window.addEventListener('resize', scalePage);
    })();
</script>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/pdf/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pdf/css/outline.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/pdf/css/main.css') }}"/>
    <style>
        .print-actions {
            position: fixed;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: .5rem;
            z-index: 9999;
        }
        .btn-print {
            padding: .45rem 1.1rem;
            background: #0d6efd;
            color: #fff;
            border: none;
            border-radius: .375rem;
            font-size: .9rem;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }
        .btn-print:hover { background: #0b5ed7; }
        .btn-back {
            padding: .45rem 1.1rem;
            background: #6c757d;
            color: #fff;
            border: none;
            border-radius: .375rem;
            font-size: .9rem;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }
        .btn-back:hover { background: #5c636a; }

        @media print {
            .print-actions { display: none !important; }
        }
    </style>
</head>
<body>
@auth
<div class="print-actions">
    <a href="{{ route('employee-records.show', $employeeRecord) }}" class="btn-back">
        &#8592; Back
    </a>
    <button class="btn-print" onclick="window.print()">
        &#128438; Print
    </button>
</div>
@endauth
<div id="page-container">
    <div id="pf1" class="pf w0 h0" data-page-no="1">
        <div class="pc pc1 w0 h0">
            <!-- Background Image -->
            <img class="bi x0 y0 w1 h1" alt="" src="{{ asset('assets/pdf/img/bg.png') }}"/>
            <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">ﻦﻣ ﻖﻘﺤﺘﻠﻟو ﺔﻴﻏﻻ ﺮﺒﺘﻌﺗ ﺔﻘﻴﺛﻮﻟا ﻰﻠﻋ ﻞﻳﺪﻌﺗ وأ ﻂﺸﻛ وأ ﺔﻓﺎﺿإ يأو ةﺪﺟ ﺔﻓﺮﻏ لﺎﻤﻋأ ﺔﺑاﻮﺑ لﻼﺧ ﻦﻣ ﺔﻓﺮﻐﻟا ﻰﻠﻋ ﺔﻴﻟوﺆﺴﻣ ﻰﻧدأ نود ﺎﻫراﺪﺻإ ﻢﺗﺪﻗ ﺔﻘﻴﺛﻮﻟا هﺬﻫ</div>
            <div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0"><a style="text-decoration: none; color: #000" href="https://es.jcci.org.sa/Home">https://es.jcci.org.sa/Home</a> ﻲﻧو<span class="_ _0"></span>ﺮﺘﻜﻟﻻا ﻊﻗﻮﻤﻟا ةرﺎﻳ<span class="_ _0"></span>ز ﻰﺟ<span class="_ _1"></span>ﺮﻳ ﺎﻫاﻮﺘﺤﻣ</div>
            <div class="t m0 x3 h3 y3 ff2 fs1 fc0 sc0 ls0 ws0" style="font-weight: bold">1 ﻦﻣ 1 ﺔﺤﻔﺻ</div>

            <!-- ===== HEADER INFO TABLE ===== -->
            <table class="info-table">
                <!-- Row 1: Company Name -->
                <tr>
                    <td class="col-en" style="font-weight:bold;">
                        {{ $employeeRecord->company_name }}
                    </td>
                    <td class="col-qr" rowspan="6">
                        <img class="qrcode" src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}">
                    </td>
                    <td class="col-ar" style="font-weight:bold; text-align:right;direction: rtl;">
                       {{ $employeeRecord->company_name_ar }}
                    </td>
                </tr>

                <!-- Row 2: Applicant -->
                <tr>
                    <td class="col-en">
                        Applicant : {{ $employeeRecord->applicant ?? '-' }}
                    </td>
                    <td class="col-ar" style="text-align:right;">
                        {{ $employeeRecord->applicant_ar ?? '-' }} :  ﺐﻠﻄﻟا مﺪﻘﻣ
                    </td>
                </tr>

                <!-- Row 3: Subscriber ID + Unified Number -->
                <tr>
                    <td class="col-en">
                        <table class="inner-table">
                            <tr>
                                <td style="width:45%; text-align:left;">Subscriber ID : {{ $employeeRecord->subscriber_id }}</td>
                                <td style="text-align:left;">Unified number : {{ $employeeRecord->unified_number }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="col-ar">
                        <table class="inner-table">
                            <tr>
                                <td style="width:50%; text-align:right;">{{ $employeeRecord->unified_number }} : ﺪﺣﻮﻤﻟا ﻢﻗﺮﻟا</td>
                                <td style="text-align:right;">{{ $employeeRecord->subscriber_id }} : كاﺮﺘﺷﻹا ﻢﻗر</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Row 4: C.R + Phone Number -->
                <tr>
                    <td class="col-en">
                        <table class="inner-table">
                            <tr>
                                <td style="width:45%; text-align:left;">C.R : {{ $employeeRecord->cr_number }}</td>
                                <td style="text-align:left;">Phone Number : {{ $employeeRecord->phone_number ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="col-ar">
                        <table class="inner-table">
                            <tr>
                                <td style="width:50%; text-align:right;">{{ $employeeRecord->phone_number ?? '-' }} : ﻒﺗﺎﻬﻟا ﻢﻗر</td>
                                <td style="text-align:right;">{{ $employeeRecord->cr_number }} : يرﺎﺠﺘﻟا ﻞﺠﺴﻟا</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Row 5: Date + Request Number -->
                <tr>
                    <td class="col-en">
                        <table class="inner-table">
                            <tr>
                                <td style="width:45%; text-align:left;">Date : {{ $employeeRecord->date->format('d/m/Y') }}</td>
                                <td style="text-align:left;">Request number : {{ $employeeRecord->request_number }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="col-ar">
                        <table class="inner-table">
                            <tr>
                                <td style="width:50%; text-align:right;">{{ $employeeRecord->date->format('d/m/Y') }} : ﺦﻳرﺎﺘﻟا</td>
                                <td style="text-align:right;">{{ $employeeRecord->request_number }} : ﺐﻠﻄﻟا ﻢﻗر</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Row 6: Employee -->
                <tr>
                    <td class="col-en">
                        Employee : {{ $employeeRecord->employee ?? '-' }}
                    </td>
                    <td class="col-ar" style="text-align:right;">
                        {{ $employeeRecord->employee ?? '-' }} : ﻒﻇﻮﻤﻟا
                    </td>
                </tr>

            </table>
            <div class="letter-body">
                {!! nl2br(($employeeRecord->letter_content)) !!}
            </div>
        </div>
    </div>
</div>
</body>
</html>
