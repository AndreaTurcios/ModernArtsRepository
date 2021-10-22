<?php
require('report.php');
require('../../models/reportes.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de clientes');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Categorias;
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readReportClientes()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(35, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(35, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, utf8_decode('Dui'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, utf8_decode('Teléfono'), 1, 1, 'C', 1);

                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(35, 10, utf8_decode($rowProducto['nombre_cliente']), 1, 0);
                    $pdf->Cell(35, 10, utf8_decode($rowProducto['apellidos_cliente']), 1, 0);
                    $pdf->Cell(30, 10, utf8_decode($rowProducto['dui_cliente']), 1, 0);
                    $pdf->Cell(55, 10, utf8_decode($rowProducto['correo_cliente']), 1, 0);
                    $pdf->Cell(30, 10, utf8_decode($rowProducto['telefono_cliente']), 1, 1);

                }
                // Se agrega un salto de línea para mostrar el contenido principal del documento.
                $pdf->Ln(5);
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay pedidos para este cliente'), 1, 1);
            }


// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>