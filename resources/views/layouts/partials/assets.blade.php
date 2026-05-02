@if (file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap');

        body {
            color: #0f172a;
        }

        .app-shell--public,
        .app-shell--user,
        .app-shell--auth {
            font-family: 'Manrope', 'Segoe UI', sans-serif;
        }

        .app-shell--panel {
            font-family: 'Outfit', 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #f5f7ff 55%, #eef2ff 100%);
        }

        .shell-card {
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(18px);
        }

        .app-shell--panel .shell-card {
            border-color: #e2e8f0;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        }

        .shell-input,
        .shell-select,
        .shell-textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.96);
            padding: 13px 16px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .shell-input:focus,
        .shell-select:focus,
        .shell-textarea:focus {
            border-color: #7dd3fc;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
        }

        .shell-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .btn-primary,
        .btn-secondary,
        .btn-success,
        .btn-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: transform .18s ease, box-shadow .18s ease, background-color .18s ease, border-color .18s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-success:hover,
        .btn-danger:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #0f172a;
            color: #ffffff;
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        }

        .btn-primary:hover {
            background: #020617;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.96);
            border-color: #cbd5e1;
            color: #1e293b;
        }

        .btn-secondary:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }

        .btn-success {
            background: #059669;
            color: #ffffff;
        }

        .btn-danger {
            background: #e11d48;
            color: #ffffff;
        }

        .metric-card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.94);
            padding: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        }

        .app-shell--panel .metric-card {
            border-color: #e2e8f0;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .metric-card__accent {
            display: inline-flex;
            height: 44px;
            width: 44px;
            border-radius: 18px;
            background: linear-gradient(135deg, #dbeafe, #e9d5ff);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #020617;
        }

        .table-shell {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-shell th {
            padding: 14px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .28em;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .table-shell td {
            padding: 16px;
            vertical-align: top;
            color: #334155;
        }

        .table-shell tbody tr + tr td {
            border-top: 1px solid #e2e8f0;
        }
    </style>
@endif
