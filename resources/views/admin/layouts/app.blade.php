<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">

        <title>Marhabaai| Dashboard</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/jodit/jodit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/dropzone/dropzone.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/custom.css') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ route('admin.dashboard') }}" class="brand-link bg-white" style="height: 57px;">
					<img src="{{ asset('logo.png') }}" alt="" class="w-75 ml-3" style="margin-top:-20px">
				  </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('heroSlideList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Hero Slides</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categoryList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subCategoryList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('serviceList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Services</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('companyList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Company</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reviewList') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Review</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('settings.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.logout') }}" class="nav-link">
                                    <i class='fas fa-sign-out-alt nav-icon'></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- /.content-wrapper -->


            <footer class="main-footer">
                <strong>Copyright &copy;Marhaba Ai </strong> <a href="https://www.linkedin.com/in/naimulalambd/">Develope By Naimul Alam</a>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script src="{{ asset('admin_assets/assets/plugins/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('admin_assets/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Reassign jQuery UI tooltip to avoid conflict with Bootstrap -->
        <script>
            $.widget.bridge('uitooltip', $.ui.tooltip); // Move jQuery UI's tooltip
        </script>

        <script src="{{ asset('admin_assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('admin_assets/assets/js/adminlte.min.js') }}"></script>

        <!-- Jodit (local files; no CDN) -->
        <script src="{{ asset('admin_assets/assets/plugins/jodit/jodit.min.js') }}"></script>

        <script src="{{ asset('admin_assets/assets/plugins/dropzone/dropzone.js') }}"></script>

        <script>
        // Shared Jodit instances for all Service Create/Edit forms.
        window.serviceEditors = {};

        window.initServiceEditor = function (el) {
            if (!el || window.serviceEditors[el.id]) return;
            if (typeof Jodit === 'undefined') {
                console.error('Jodit not loaded. Verify the local jodit.min.js path.');
                return;
            }

            const isArabic = el.getAttribute('dir') === 'rtl';
            const editor = Jodit.make(el, {
                height: 350,
                toolbarAdaptive: false,
                direction: isArabic ? 'rtl' : 'ltr',
                buttons: [
                    'source', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'font', 'fontsize', 'brush', '|',
                    'ul', 'ol', 'outdent', 'indent', '|',
                    'left', 'center', 'right', 'justify', '|',
                    'link', 'table', 'hr', '|',
                    'undo', 'redo', 'fullsize'
                ]
            });
            window.serviceEditors[el.id] = editor;
            editor.events.on('change', function () {
                el.value = editor.value;
            });
        };

        // Explicit sync protects existing AJAX form.serialize() handlers.
        window.syncServiceEditors = function (form) {
            if (!form) return;
            form.querySelectorAll('textarea.jodit-editor').forEach(function (el) {
                const editor = window.serviceEditors[el.id];
                if (editor) el.value = editor.value;
            });
        };

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('textarea.jodit-editor').forEach(function (el) {
                // Avoid initializing an editor in the hidden Arabic Bootstrap tab.
                if (!el.closest('.tab-pane') || el.closest('.tab-pane').classList.contains('active')) {
                    window.initServiceEditor(el);
                }
            });
            // Initialize Arabic editor when its Bootstrap tab becomes visible.
            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                document.querySelectorAll('textarea.jodit-editor').forEach(function (el) {
                    if (!el.closest('.tab-pane') || el.closest('.tab-pane').classList.contains('active')) {
                        window.initServiceEditor(el);
                    }
                });
            });
        });
        </script>

        @yield('extraJs')
    </body>
</html>
