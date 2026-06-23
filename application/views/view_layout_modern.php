<?php
    $Admin = true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>ERP Tienda-en-linea - <?= isset($page_title) ? $page_title : 'Sistema' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url("assets/plugins/font-awesome/css/font-awesome.css") ?>" rel="stylesheet" type="text/css" />
    
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    
    <!-- Bootstrap 3 (compatibilidad) -->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!-- Modern Theme CSS -->
    <link href="<?= base_url("assets/css/modern-theme.css") ?>" rel="stylesheet" type="text/css" />
    
    <!-- Custom JS -->
    <script type="text/javascript" src="<?= base_url("assets/js/funciones.js") ?>"></script>

    <style type="text/css">
        /* Override Bootstrap 3 styles for modern look */
        .container-fluid {
            padding: 0;
        }
        .row {
            margin: 0;
        }
        .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            padding: 0;
        }
        /* Fix for DataTables search input */
        .dataTables_wrapper .dataTables_filter input {
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 6px 12px;
            font-size: 13px;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }
        /* Fix for DataTables length select */
        .dataTables_wrapper .dataTables_length select {
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 4px 8px;
        }
        /* Override table styles for DataTables */
        .dataTables_wrapper .dataTable {
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        .dataTables_wrapper .dataTable thead th {
            background: #f8fafc !important;
            color: var(--text-secondary) !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color) !important;
        }
        .dataTables_wrapper .dataTable tbody td {
            font-size: 13px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }
        .dataTables_wrapper .dataTable tbody tr:hover {
            background: #f8fafc !important;
        }
        /* Pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: var(--radius-sm) !important;
            padding: 6px 12px !important;
            margin: 0 2px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }
        /* Alert override for modern theme */
        .alert {
            border: none !important;
            border-radius: var(--radius-md) !important;
            font-size: 13px !important;
        }
        .alert-success {
            background: #ecfdf5 !important;
            color: #065f46 !important;
            border-left: 4px solid var(--success) !important;
        }
        .alert-warning {
            background: #fffbeb !important;
            color: #92400e !important;
            border-left: 4px solid var(--warning) !important;
        }
        .alert-danger {
            background: #fef2f2 !important;
            color: #991b1b !important;
            border-left: 4px solid var(--danger) !important;
        }
        .alert-info {
            background: #eff6ff !important;
            color: #1e40af !important;
            border-left: 4px solid var(--primary) !important;
        }
        /* Buttons override */
        .btn {
            border-radius: var(--radius-sm) !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 8px 18px !important;
            transition: var(--transition) !important;
        }
        .btn-primary {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-primary:hover {
            background: var(--primary-dark) !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
        }
        .btn-success {
            background: var(--success) !important;
            border-color: var(--success) !important;
        }
        .btn-danger {
            background: var(--danger) !important;
            border-color: var(--danger) !important;
        }
        .btn-warning {
            background: var(--warning) !important;
            border-color: var(--warning) !important;
        }
        /* Form controls */
        .form-control {
            border: 1.5px solid var(--border-color) !important;
            border-radius: var(--radius-sm) !important;
            font-size: 13px !important;
            box-shadow: none !important;
            transition: var(--transition) !important;
        }
        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        }
        /* Labels */
        label {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--text-primary) !important;
        }
        /* Panel override */
        .panel {
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: var(--shadow-sm) !important;
        }
        .panel-heading {
            background: white !important;
            border-bottom: 1px solid var(--border-color) !important;
            padding: 16px 20px !important;
        }
        .panel-heading h3 {
            font-size: 15px !important;
            font-weight: 600 !important;
            color: var(--text-primary) !important;
            margin: 0 !important;
        }
        .panel-body {
            padding: 20px !important;
        }
        /* Table override */
        .table {
            border-collapse: collapse !important;
        }
        .table thead th {
            background: #f8fafc !important;
            color: var(--text-secondary) !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color) !important;
        }
        .table tbody td {
            font-size: 13px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }
        .table tbody tr:hover {
            background: #f8fafc !important;
        }
        /* Modal override */
        .modal-content {
            border-radius: var(--radius-lg) !important;
            border: none !important;
            box-shadow: var(--shadow-xl) !important;
        }
        .modal-header {
            border-bottom: 1px solid var(--border-color) !important;
            padding: 16px 20px !important;
        }
        .modal-body {
            padding: 20px !important;
        }
        .modal-footer {
            border-top: 1px solid var(--border-color) !important;
            padding: 16px 20px !important;
        }
        /* Dropdown */
        .dropdown-menu {
            border-radius: var(--radius-md) !important;
            border: 1px solid var(--border-color) !important;
            box-shadow: var(--shadow-lg) !important;
        }
        /* Well */
        .well {
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-md) !important;
            background: #f8fafc !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body>

<div class="modern-wrapper">
    <!-- Sidebar -->
    <?= $this->fm->menu_principal2($Admin, "", ""); ?>

    <!-- Main Content -->
    <main class="modern-main">
        <!-- Header -->
        <header class="modern-header">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fa fa-bars"></i>
            </button>
            <h1 class="page-title">
                <?= isset($page_title) ? $page_title : 'Dashboard' ?>
            </h1>
            <div class="header-info">
                <span class="info-item">
                    <i class="fa fa-calendar"></i>
                    <?php echo date("d/m/Y H:i"); ?>
                </span>
                <span class="info-item">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION["usuario"] ?? 'Usuario'; ?>
                </span>
                <span class="info-item">
                    <i class="fa fa-store"></i>
                    <?php echo $_SESSION["nombre_tienda"] ?? 'Tienda'; ?>
                </span>
            </div>
        </header>

        <!-- Content -->
        <div class="modern-content">
            <?php if(isset($msg)){ ?>
            <div class="modern-alert <?= isset($rpta_msg) ? ($rpta_msg == 'success' ? 'success' : ($rpta_msg == 'warning' ? 'warning' : ($rpta_msg == 'danger' ? 'danger' : 'info'))) : 'success' ?>">
                <i class="fa fa-<?= isset($rpta_msg) ? ($rpta_msg == 'success' ? 'check-circle' : ($rpta_msg == 'warning' ? 'exclamation-triangle' : ($rpta_msg == 'danger' ? 'times-circle' : 'info-circle'))) : 'check-circle' ?>"></i>
                <?= $msg ?>
            </div>
            <?php } ?>

            <?= $contents ?>
        </div>

        <!-- Footer -->
        <footer class="modern-footer">
            &copy; <?= date('Y') ?> ERP Tienda-en-linea - Todos los derechos reservados
        </footer>
    </main>
</div>

<script type="text/javascript">
    // Sidebar toggle function (defined in Fm.php)
    // Additional mobile support
    document.addEventListener('DOMContentLoaded', function() {
        // Add mobile toggle button
        var sidebar = document.getElementById('modernSidebar');
        if (window.innerWidth <= 768) {
            sidebar.classList.add('mobile-open');
        }
    });
</script>

</body>
</html>
