<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_altaCita.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alta Tatuador</title>
</head>

<body>

    <main class="body__main">
        <form class="main__form-plantilla <?= isset($errores) && !empty($errores) ? "main__form-plantilla-error" : "" ?>"
              action="/tattooshop_php/tatuadores/alta" 
              method="post" enctype="multipart/form-data"> <!-- Enctype agregado si se sube una imagen -->

            <div class="form-plantilla__container">
                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_nombre">Nombre</label>
                    <input type="text"
                        class="shadow form-control"
                        id="input_nombre"
                        name="input_nombre"
                        value="<?= htmlspecialchars($_POST['input_nombre'] ?? '') ?>"  <!-- Mantiene el valor tras error -->
                        placeholder="Introduce el nombre del tatuador">
                    <?php if (isset($errores["error_nombre"])): ?>
                        <small class="form-text text-danger"><?= $errores["error_nombre"] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_email">Email</label>
                    <input type="email"
                        class="shadow form-control"
                        id="input_email"
                        name="input_email"
                        value="<?= htmlspecialchars($_POST['input_email'] ?? '') ?>"
                        placeholder="Introduce tu correo electrónico">
                    <?php if (isset($errores["error_email"])): ?>
                        <small class="form-text text-danger"><?= $errores["error_email"] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_password">Contraseña</label>
                    <input type="password"
                        class="shadow form-control"
                        id="input_password"
                        name="input_password"
                        placeholder="Contraseña">
                    <?php if (isset($errores["error_password"])): ?>
                        <small class="form-text text-danger"><?= $errores["error_password"] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_foto">Foto (URL o Archivo)</label>
                    <input type="text"
                        class="shadow form-control"
                        id="input_foto"
                        name="input_foto"
                        value="<?= htmlspecialchars($_POST['input_foto'] ?? '') ?>"
                        placeholder="URL de la foto">
                    <input type="file" name="foto_archivo" class="form-control mt-2">
                </div>

                <div class="container__btns-form">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </form>

        <?php if (isset($errores["error_db"])): ?>
            <p class="text-danger"><?= $errores["error_db"] ?></p>
        <?php endif; ?>
    </main>

</body>
</html>
