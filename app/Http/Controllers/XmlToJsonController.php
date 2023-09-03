<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use PDF;

class XmlToJsonController extends Controller
{
    public function showForm()
    {
        return view('xml-to-json-form');
    }

    public function convertXmlToJson(Request $request)
    {
        $xmlFile = $request->file('xml_file');
        $xmlContent = file_get_contents($xmlFile->getPathname());

        $xmlObject = simplexml_load_string($xmlContent);
        $array = $this->xmlToArray($xmlObject);

        dd($xmlFile, $xmlObject, $array);

        return response()->json($array);
    }

    public function xmlToArray($xml)
    {
        $array = [];

        foreach ($xml->attributes() as $attrName => $attrValue) {
            $array[$attrName] = (string) $attrValue;
        }

        $children = $xml->children();

        if (count($children) === 0) {
            return (string) $xml;
        }

        foreach ($children as $childName => $child) {
            if (count($child->children()) > 0) {
                $array[$childName][] = $this->xmlToArray($child);
            } else {
                $array[$childName] = (string) $child;
            }
        }

        return $array;
    }

    public function pdfDownload()
    {
        $comprobante = [
            'schemaLocation' => 'http://www.sat.gob.mx/cfd/4 http://www.sat.gob.mx/sitio_internet/cfd/4/cfdv40.xsd',
            'Version' => '4.0',
            'Serie' => 'WA',
            'Folio' => '1',
            'Fecha' => '2023-09-01T09:22:00',
            'Sello' => 'N2UYkyZdAJBorWdQEo97URSsjuqEyC6sYrRrnAVmk/Yz3hW4ObhjDRijyBcp+REcfxldXSU8iTjDUInkiLoQtc8S/CVk/XcmFIoIYzsZBJwRCKFG9MtgLNE0ieTjFApljwkSgnQfrV1NZGUxYanVG4hkXRKUBXHTynxmsACuk5gbzOeDH4arhExW4hcKoH3jcolx8eYL254YHGKNygb+1GSeVnvmFvCGlNXkBjZ04Oj3OurBBKuse9rE1FFhtc8V3s66u2Advuyey8MS2sItYNHJwTuGB0SxOkKQKwfBBo42sit1Go6kBhCSppyT42vNLkq/rcTUMVtdFrrcuGc2ew==',
            'FormaPago' => '03',
            'NoCertificado' => '00001000000504465028',
            'Certificado' => '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',
            'SubTotal' => '58500.00',
            'Moneda' => 'MXN',
            'Total' => '60888.75',
            'TipoDeComprobante' => 'I',
            'Exportacion' => '01',
            'MetodoPago' => 'PUE',
            'LugarExpedicion' => '45645',
            'Emisor' => [
                'Rfc' => 'SOMA841120394',
                'Nombre' => 'JOSE ANDRES SOSA MARTINEZ',
                'RegimenFiscal' => '626',
            ],
            'Receptor' => [
                'Rfc' => 'TEC110509N76',
                'Nombre' => 'TECNOLOGIA EDUCATIVA CIME',
                'DomicilioFiscalReceptor' => '44450',
                'RegimenFiscalReceptor' => '601',
                'UsoCFDI' => 'G03',
            ],
            'Conceptos' => [
                'Concepto' => [
                    0 => [
                        'ClaveProdServ' => '43232107',
                        'Cantidad' => '1.00',
                        'ClaveUnidad' => 'E48',
                        'Unidad' => 'Unidad de servicio',
                        'Descripcion' => 'Servicio de desarrollo web',
                        'ValorUnitario' => '58500.00',
                        'Importe' => '58500.00',
                        'ObjetoImp' => '02',
                        'Impuestos' => [
                            'Traslados' => [
                                'Traslado' => [
                                    'Base' => '58500.00',
                                    'Impuesto' => '002',
                                    'TipoFactor' => 'Tasa',
                                    'TasaOCuota' => '0.160000',
                                    'Importe' => '9360.00',
                                ],
                            ],
                            'Retenciones' => [
                                'Retencion' => [
                                    0 => [
                                        'Base' => '58500',
                                        'Impuesto' => '002',
                                        'TipoFactor' => 'Tasa',
                                        'TasaOCuota' => '0.106667',
                                        'Importe' => '6240.00',
                                    ],
                                    1 => [
                                        'Base' => '58500.00',
                                        'Impuesto' => '001',
                                        'TipoFactor' => 'Tasa',
                                        'TasaOCuota' => '0.012500',
                                        'Importe' => '731.25',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'Impuestos' => [
                'TotalImpuestosTrasladados' => '9360.00',
                'TotalImpuestosRetenidos' => '6971.25',
                'Retenciones' => [
                    'Retencion' => [
                        0 => [
                            'Impuesto' => '002',
                            'Importe' => '6240.00',
                        ],
                        1 => [
                            'Impuesto' => '001',
                            'Importe' => '731.25',
                        ],
                    ],
                ],
                'Traslados' => [
                    'Traslado' => [
                        'Base' => '58500.00',
                        'Impuesto' => '002',
                        'TipoFactor' => 'Tasa',
                        'TasaOCuota' => '0.160000',
                        'Importe' => '9360.00',
                    ],
                ],
            ],
            'Complemento' => [
                'CFDIRegistroFiscal' => [
                    'schemaLocation' => 'http://www.sat.gob.mx/registrofiscal http://www.sat.gob.mx/sitio_internet/cfd/cfdiregistrofiscal/cfdiregistrofiscal.xsd',
                    'Version' => '1.0',
                    'Folio' => '2309201000000318',
                ],
                'TimbreFiscalDigital' => [
                    'schemaLocation' => 'http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd',
                    'Version' => '1.1',
                    'UUID' => 'AAA1C325-CAB8-4723-A50D-160E5EF126CB',
                    'FechaTimbrado' => '2023-09-01T09:22:01',
                    'RfcProvCertif' => 'SAT970701NN3',
                    'SelloCFD' => 'N2UYkyZdAJBorWdQEo97URSsjuqEyC6sYrRrnAVmk/Yz3hW4ObhjDRijyBcp+REcfxldXSU8iTjDUInkiLoQtc8S/CVk/XcmFIoIYzsZBJwRCKFG9MtgLNE0ieTjFApljwkSgnQfrV1NZGUxYanVG4hkXRKUBXHTynxmsACuk5gbzOeDH4arhExW4hcKoH3jcolx8eYL254YHGKNygb+1GSeVnvmFvCGlNXkBjZ04Oj3OurBBKuse9rE1FFhtc8V3s66u2Advuyey8MS2sItYNHJwTuGB0SxOkKQKwfBBo42sit1Go6kBhCSppyT42vNLkq/rcTUMVtdFrrcuGc2ew==',
                    'NoCertificadoSAT' => '00001000000504465028',
                    'SelloSAT' => 'WuCRmgOUIai5uQymLox7/WL+ilk2fxnR36y3V0G7MT1UFRSGeNkxaDzZjgVSqRlftuLUgdoWP9sLXlsJTKGP/6hBsNDDkFQ0fQ2Ir1SKJETNzWA/3pD0YZ1DdptrfojLO9qrjsapeTtn2/MyQUGzHFpJhLLoxXHLHfTtlEtir+CDfVTAlac9w8efS/96NGd2xDdOV7bWf3JbSv6cNwEQCyJfOYJi2+69u1knnySvbxcPQPQMGXZvSGtnLrsESdwCIiWOVhn4WIVRY9ephvU+aBcDblTn/IPdGVi5KQuLTC4AeKuUdgdDRzTcmfkhSLqmz56nYLGN5BTbL/ntUPkyeQ==',
                ],
            ],
        ];

        $uuid = $comprobante['Complemento']['TimbreFiscalDigital']['UUID'];
        $rfc = $comprobante['Emisor']['Rfc'];
        $sello = $comprobante['Sello'];

        // Armar la URL con los parámetros que mencionaste
        $url = "https://verificacfdi.facturaelectronica.sat.gob.mx/?id={$uuid}&re={$rfc}&rr={$rfc}&tt={$comprobante['Total']}&fe=" . substr($sello, -8);


        // // Genera el código QR
        // $qrCode = QrCode::format('png')->size(200)->generate($url);

        // // Guarda el código QR como una imagen en el sistema de archivos de Laravel
        // $qrCodePath = public_path('qr_codes');
        // if (!file_exists($qrCodePath)) {
        //     mkdir($qrCodePath, 0777, true);
        // }
        // $qrCodeFilename = '{$uuid}.png';
        // $qrCode->store($qrCodePath, $qrCodeFilename);

        // $base64QR = base64_encode(QrCode::format('png')->generate($url));

        // dd($comprobante, $url, $base64QR);

        // return  view('pdf', compact('comprobante'));

        $pdf = PDF::loadView('pdf', compact('comprobante'));
        return $pdf->download('comprobante.pdf');
    }
}
