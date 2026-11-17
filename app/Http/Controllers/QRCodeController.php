<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\AgendaRapat;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function generateQRCode(AgendaRapat $agendaRapat)
    {
        try {
            $url = route('absensiUser.create', ['agendaRapat' => $agendaRapat]);
            $qrCode = new QrCode($url);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            return response($result->getString())->header('Content-Type', 'image/png');
        } catch (\Exception $e) {
            return response('Terjadi kesalahan saat menghasilkan QR Code', 500);
        }
    }
    public function downloadQRCode(AgendaRapat $agendaRapat)
    {
        try {
            // Membuat URL untuk absensi
            $url = route('absensiUser.create', ['agendaRapat' => $agendaRapat]);
            $qrCode = new QrCode($url);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $tempFile = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
            file_put_contents($tempFile, $result->getString());
            return response()->download($tempFile, 'QR_Code_Absensi.png')->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response('Terjadi kesalahan saat menghasilkan QR Code', 500);
        }
    }
}
