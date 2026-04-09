<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sahayata Portal' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sahayata-primary: #0d3b66;
            --sahayata-secondary: #90be6d;
            --sahayata-bg: #f4f7fb;
        }

        body {
            background: radial-gradient(circle at top left, #eef5ff, var(--sahayata-bg) 35%);
        }

        .glass-nav {
            backdrop-filter: blur(12px);
            background-color: rgba(255,255,255,.85);
        }

        .s-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 14px 40px rgba(13, 59, 102, 0.1);
        }

        .metric {
            background: linear-gradient(135deg, var(--sahayata-primary), #1f5f99);
            color: white;
        }

        .btn-sahayata {
            background: var(--sahayata-primary);
            color: #fff;
            border-radius: 999px;
            padding: 0.55rem 1.2rem;
        }

        .btn-sahayata:hover {
            background: #0b3052;
            color: #fff;
        }

        .ai-chip {
            border-radius: 999px;
            font-size: .8rem;
            padding: .3rem .7rem;
            background: #e7f6eb;
            color: #1d6f42;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top glass-nav border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('team.index') }}">
            <i class="bi bi-shield-check me-1"></i>Sahayata Portal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('team.index') }}">Frontend Team</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.team.index') }}">Team Mgmt</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.members.index') }}">Member Mgmt</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4 py-lg-5">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success shadow-sm">{{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/sahayata-ai.js') }}"></script>
</body>
</html>
