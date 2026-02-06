<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table-actions {
            white-space: nowrap;
        }

        .preview-image {
            max-width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .article-title {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .status-badge {
            font-size: 0.75rem;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/index">
                <i class="fas fa-newspaper me-2"></i>Magzine Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li>
                    <a href="/admin/index" class="nav-link">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="/admin/notifikasi">
                            <i class="bi bi-bell"></i>
                             @if(auth()->user()->unreadNotifications->count())
                             <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                             {{ auth()->user()->unreadNotifications->count() }}
                             </span>
                             @endif
                        </a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/index">
                            <i class="fas fa-eye me-1"></i>Lihat Website
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" onclick="logout()">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>