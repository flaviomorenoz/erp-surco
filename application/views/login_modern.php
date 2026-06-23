<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP Tienda-en-linea - Iniciar Sesión</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url("assets/plugins/font-awesome/css/font-awesome.css") ?>" rel="stylesheet" type="text/css" />
    
    <!-- Modern Theme CSS -->
    <link href="<?= base_url("assets/css/modern-theme.css") ?>" rel="stylesheet" type="text/css" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body>

<div class="login-modern">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <i class="fa fa-cube"></i>
            </div>
            <h1>ERP Tienda-en-linea</h1>
            <p>Sistema de Ventas, Compras e Inventario</p>
        </div>

        <form id="form_login" name="form_login" method="post" action="<?= base_url("welcome/inicia_sesion") ?>">
            <div class="form-group">
                <label for="usuario">
                    <i class="fa fa-user"></i> Usuario
                </label>
                <div class="input-wrapper">
                    <i class="fa fa-user"></i>
                    <input type="text" name="usuario" id="usuario" value="admin" placeholder="Ingrese su usuario" autocomplete="username">
                </div>
            </div>

            <div class="form-group">
                <label for="pass">
                    <i class="fa fa-lock"></i> Contraseña
                </label>
                <div class="input-wrapper">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="pass" id="pass" placeholder="Ingrese su contraseña" autocomplete="current-password">
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa fa-sign-in"></i> Ingresar
            </button>
        </form>

        <?php if(isset($message) && strlen($message) > 0){ ?>
        <div class="login-message error">
            <i class="fa fa-exclamation-circle"></i> <?= $message ?>
        </div>
        <?php } ?>

        <div class="login-footer">
            &copy; <?= date('Y') ?> ERP Tienda-en-linea - Todos los derechos reservados
        </div>
    </div>
</div>

</body>
</html>
