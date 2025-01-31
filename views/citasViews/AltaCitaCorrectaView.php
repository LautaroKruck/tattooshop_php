<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/Styles/styles_altaCorrecta.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cita Confirmada</title>
</head>

<body>

    <main class="container mt-5">
        <div class="card p-4 shadow">
            <h2 class="text-center text-success">Cita Registrada con Éxito</h2>

            <div class="mt-4">
                <p><strong>Fecha y Hora:</strong> <?= htmlspecialchars($fecha_cita) ?></p>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($descripcion) ?></p>
                <p><strong>Cliente:</strong> <?= htmlspecialchars($cliente) ?></p>
            </div>

            <h4 class="mt-4">Datos del Tatuador</h4>
            <div class="d-flex align-items-center">
                <img src="<?= htmlspecialchars($tatuador_foto) ?>" alt="Foto del tatuador" width="100" class="rounded-circle me-3">
                <div>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($tatuador_nombre) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($tatuador_email) ?></p>
                </div>
            </div>

            <a href="/tattooshop_php/citas/alta" class="btn btn-primary mt-4">Volver al inicio</a>
        </div>
    </main>

</body>

</html>
