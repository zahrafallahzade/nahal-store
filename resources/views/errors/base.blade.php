<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') | @yield('title')</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            font-family: Tahoma, sans-serif;
            color: #212529;
        }
        .box { text-align: center; padding: 2rem; max-width: 480px; }
        .code { font-size: 6rem; font-weight: 700; color: #6c757d; margin: 0; }
        h1 { font-size: 1.5rem; margin: 0.5rem 0; }
        p { color: #6c757d; line-height: 2; }
        .back { display: inline-block; margin-top: 1rem; padding: 0.6rem 1.5rem; background: #16a34a; color: #fff; text-decoration: none; border-radius: 0.5rem; }

        .art { width: 140px; height: 140px; margin-bottom: 0.5rem; transform-origin: center; }
        .art .piece { fill: #16a34a; }
        .art .notch { fill: #f8f9fa; }
        .art .stroke { fill: none; stroke: #16a34a; stroke-width: 9; stroke-linecap: round; stroke-linejoin: round; }
        .art .thin { stroke-width: 5; }
        .art .slot { fill: none; stroke: #16a34a; stroke-width: 3; stroke-dasharray: 6 5; }
        .art .crack { fill: none; stroke: #f8f9fa; stroke-width: 4; stroke-linecap: round; stroke-linejoin: round; }
        .art g { transform-box: fill-box; transform-origin: center; }

        .a-float { animation: float 3s ease-in-out infinite; }
        .a-swing { animation: swing 3s ease-in-out infinite; }
        .a-shake { animation: shake 2.5s ease-in-out infinite; }
        .a-flip { animation: flip 4s ease-in-out infinite; }
        .a-spin { animation: spin 8s linear infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes swing {
            0%, 100% { transform: rotate(-6deg); }
            50% { transform: rotate(6deg); }
        }
        @keyframes shake {
            0%, 60%, 100% { transform: translateX(0); }
            65% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
            85% { transform: translateX(-4px); }
            95% { transform: translateX(3px); }
        }
        @keyframes flip {
            0%, 55% { transform: rotate(0deg); }
            100% { transform: rotate(180deg); }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @media (prefers-reduced-motion: reduce) {
            .a-float, .a-swing, .a-shake, .a-flip, .a-spin { animation: none; }
        }
    </style>
</head>
<body>
<div class="box">
    @yield('art')
    <p class="code">@yield('code')</p>
    <h1>@yield('title')</h1>
    <p>@yield('message')</p>
    <a class="back" href="@yield('link', url('/'))">@yield('button', 'بازگشت به صفحه اصلی')</a>
</div>
</body>
</html>
