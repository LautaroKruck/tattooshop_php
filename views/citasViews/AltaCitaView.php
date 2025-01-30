<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_altaCita.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Alta Cita</title>
</head>

<body>

    <main class="body__main">
        <form class="main__form-plantilla <?= isset($errores) && !empty($errores) ? "main__form-plantilla-error" : "" ?>"
              action="/tattooshop_php/citas/alta"
              method="post">

            <div class="form-plantilla__container">
                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_descripcion">Descripción</label>
                    <input type="text"
                        class="shadow form-control"
                        id="input_descripcion"
                        name="input_descripcion"
                        value="<?= htmlspecialchars($_POST['input_descripcion'] ?? '') ?>"
                        placeholder="Introduce la descripción de la cita">
                    <?php if (isset($errores["error_descripcion"])): ?>
                        <small class="form-text text-danger"><?= $errores["error_descripcion"] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_fecha_cita">Fecha y Hora</label>
                    <input type="datetime-local"
                        class="shadow form-control"
                        id="input_fecha_cita"
                        name="input_fecha_cita"
                        value="<?= htmlspecialchars($_POST['input_fecha_cita'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_cliente">Nombre Cliente</label>
                    <input type="text"
                        class="shadow form-control"
                        id="input_cliente"
                        name="input_cliente"
                        value="<?= htmlspecialchars($_POST['input_cliente'] ?? '') ?>"
                        placeholder="Nombre del cliente">
                </div>

                <div class="form-group">
                    <label class="fw-lighter text-white" for="input_tatuador">Tatuador</label>
                    <select class="shadow form-control" id="input_tatuador" name="input_tatuador">
                        <option value="">Seleccione un tatuador</option>
                        <?php foreach ($tatuadores as $tatuador): ?>
                            <option value="<?= $tatuador['id'] ?>"><?= $tatuador['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="container__btns-form">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </form>
    </main>

</body>
</html>
