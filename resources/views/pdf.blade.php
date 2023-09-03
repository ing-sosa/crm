<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: '';
            display: table;
            clear: both;
        }

        a {
            color: #485cf3;
            ;
            text-decoration: none;
        }

        body {
            position: relative;
            margin: 0 auto;
            color: #555555;
            background: #ffffff;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #aaaaaa;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-bottom: 20px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #485cf3;
            ;
            float: left;
        }

        #client .to {
            color: #777777;
        }


        .title {
            font-size: 1em;
            color: #000000;
        }

        #emisor {
            padding-right: 6px;
            border-right: 6px solid #485cf3;
            float: right;
            text-align: right;
        }

        #emisor .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #company h1 {
            color: #36454f;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #company .date {
            font-size: 0.8em;
            line-height: 1em;
            color: #777777;
        }

        #company .date .title {
            font-size: 1em;
            line-height: 1em;
            color: #000000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 0px;
        }

        table th,
        table td {
            padding: 10px;
            /* background: #eeeeee; */
            text-align: center;
            border-bottom: 1px solid #ffffff;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            font-weight: normal;
            margin: 0 0 0.2em 0;
            /* color: #485cf3;
            font-size: 1.2em;
            */
        }

        table .no {
            color: #ffffff;
            font-size: 1.6em;
            background: #485cf3;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #dddddd;
        }

        table .qty {}

        table .obj {
            text-align: center;
        }

        table .total {
            background: #485cf3;
            color: #ffffff;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.1em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 5px 10px;
            background: #ffffff;
            border-bottom: none;
            font-size: 1.1em;
            white-space: nowrap;
            border-top: 1px solid #aaaaaa;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #485cf3;
            font-size: 1.4em;
            border-top: 1px solid #485cf3;
        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #485cf3;
            ;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #aaaaaa;
            padding: 8px 0;
            text-align: center;
        }


        .taxes {
            color: #777777;
            font-size: 0.6em;
            line-height: 1em;
        }

        .final {
            /* border: 1px solid cyan !important; */
            padding: 0;
            margin: 0;
            width: 100%;
            height: 250px;
            position: absolute;
            bottom: 0;
        }

        .final td {
            padding: 0;
            max-width: 700px;
            text-align: left;
        }

        .final .cadena,
        .final .selloCFD {
            margin: 0px;
            word-wrap: break-word;
            max-width: 720px;
            font-size: 10px;
            padding-bottom: 1px;
            /* border: 1px solid purple; */
        }

        .final .title {
            margin: 0px;
            color: #000;
            font-size: 12px;
        }

        .final .selloCFD {
            max-width: 580px;
        }

        .extra {
            font-size: 12px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="logo.png">
        </div>
        <div id="company">
            <h1>{{$comprobante['Serie']}} -
                {{ str_pad($comprobante['Folio'], 3, '0', STR_PAD_LEFT) }}
            </h1>
            <div class="date"><span class="title">Fecha y hora de emisión:</span> {{$comprobante['Fecha']}} </div>
            <div class="date"><span class="title">Fecha y hora de certificación:</span> {{$comprobante['Complemento']['TimbreFiscalDigital']['FechaTimbrado']}}</div>
            <div class="date"><span class="title">Código postal de expedición:</span> {{$comprobante['LugarExpedicion']}}</div>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">RECEPTOR:</div>
                <h2 class="name">{{$comprobante['Receptor']['Nombre']}}</h2>
                <div class="datos"><span class="title">RFC:</span> {{$comprobante['Receptor']['Rfc']}}</div>
                <div class="datos"><span class="title">Uso CFDI:</span> {{$comprobante['Receptor']['UsoCFDI']}}</div>
                <div class="datos"><span class="title">Domicilio fiscal:</span> {{$comprobante['Receptor']['DomicilioFiscalReceptor']}}</div>
                <div class="datos"><span class="title">Régimen fiscal:</span> {{$comprobante['Receptor']['RegimenFiscalReceptor']}}</div>
            </div>
            <div id="emisor">
                <div class="to">EMISOR:</div>
                <h2 class="name">{{$comprobante['Emisor']['Nombre']}}</h2>
                <div class="datos"><span class="title">RFC:</span> {{$comprobante['Emisor']['Rfc']}}</div>
                <div class="datos"><span class="title">Régimen:</span> 626 Régimen Simplificado de
                    Confianza</div>
                <div class="datos"><span class="title">Telefono:</span> (33) 2581 8053</div>
                <div><a href="mailto:contacto@webmeapp.com">contacto@webmeapp.com</a></div>
            </div>
        </div>

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr style="background: #EEEEEE;">
                    <th class="qty">Clave</th>
                    <th class="qty">Unidad</th>
                    <th class="desc">Descripción</th>
                    <th class="unit">Valor unitario</th>
                    <th class="qty">Cant</th>
                    <th class="qty">Objeto impuesto</th>
                    <th class="total">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comprobante['Conceptos']['Concepto'] as $index => $row)
                <tr style="background: #EEEEEE;">
                    <td class="qty">{{ $row['ClaveProdServ'] }}</td>
                    <th class="qty">{{ $row['ClaveUnidad'] }} <br>Unidad de servicio</th>
                    <td class="desc">
                        <h3>{{ $row['Descripcion'] }}</h3>
                        <div class="taxes">IVA Trasladado {{ $row['Impuestos']['Traslados']['Traslado']['TipoFactor'] . ' ' .$row['Impuestos']['Traslados']['Traslado']['TasaOCuota'] }}
                        </div>
                        <div class="taxes">Base: {{ '$' . number_format( $row['Impuestos']['Traslados']['Traslado']['Base'], 2) . ' Importe: $' . number_format( $row['Impuestos']['Traslados']['Traslado']['Importe'], 2) }}
                        </div>
                    </td>
                    <td class="unit">{{ '$' . number_format($row['ValorUnitario'], 2) }}</td>
                    <td class="qty">{{ $row['Cantidad'] }}</td>
                    <td class="obj">Sí objeto de impuesto</td>
                    <td class="total">{{ '$' . number_format($row['Importe'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" rowspan="4" class="extra"><span class="title">Moneda:</span> Peso Mexicano<br>
                        <span class="title">Forma de pago:</span> Transferencia electrónica de fondos (incluye SPEI)<br>
                        <span class="title">Método de pago:</span> Pago en una sola exhibición
                    </td>
                    <td colspan="2" class="title">Subtotal</td>
                    <td>{{ '$' . number_format($comprobante['SubTotal'], 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="title">IVA 16.00%</td>
                    <td>{{ '$' . number_format($comprobante['Impuestos']['TotalImpuestosTrasladados'], 2) }}</td>
                </tr>
                @foreach($row['Impuestos']['Retenciones']['Retencion'] as $retencion)
                <tr>
                    <td colspan="2" class="title">{{ $retencion['Impuesto'] == "002" ? "IVA  Retenido" : "ISR Retenido"}} {{number_format($retencion['TasaOCuota']*100, 2)."%"}}
                    </td>
                    <td>{{ '$' . number_format($retencion['Importe'], 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td colspan="2">TOTAL</td>
                    <td>{{ '$' . number_format($comprobante['Total'], 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </main>
    <table class="final">
        <tr>
            <td colspan="2">
                <p class="title">
                    Sello digital del CFDI:
                </p>
                <p class="cadena">{{$comprobante['Complemento']['TimbreFiscalDigital']['SelloCFD']}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="title">Sello SAT:</p>
                <p class="cadena">{{$comprobante['Sello']}}</p>
            </td>
        </tr>
        <tr style="vertical-align: top;">
            <td class="qr"><img src="qr.png" width="120px" alt="Código QR"></td>
            <td>
                <p class="title">Cadena Original del complemento de certificación digital del SAT:</p>
                <p class="selloCFD">{{$comprobante['Complemento']['TimbreFiscalDigital']['SelloCFD']}}</p>
                <p class="selloCFD">
                <div style="float:left"><span class="title">RFC del proveedor de certificación:</span> {{$comprobante['Complemento']['TimbreFiscalDigital']['RfcProvCertif']}}</div>
                <div style="float:right"><span class="title">No. de serie del certificado SAT:</span> {{$comprobante['Complemento']['TimbreFiscalDigital']['NoCertificadoSAT']}}</div>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>