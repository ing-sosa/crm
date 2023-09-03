<!DOCTYPE html>
<html>
<head>
    <title>Formatear Factura - Convertir XML a JSON</title>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Formatear Factura - Convertir XML a JSON
            </div>

            <form action="{{ route('convert-xml-to-json') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="xml_file">Selecciona un archivo XML:</label>
                    <input type="file" name="xml_file" accept=".xml" required>
                </div>
                <br>
                <div>
                    <button type="submit">Convertir a JSON</button>
                </div>
            </form>

            @if(session('converted_data'))
                <div>
                    <h2>Datos JSON convertidos:</h2>
                    <pre>{{ session('converted_data') }}</pre>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
