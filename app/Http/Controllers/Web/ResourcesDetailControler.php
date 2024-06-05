<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Resources;
use App\Models\ResourcesDownload;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class ResourcesDetailControler extends Controller
{
    public function resource($title, $justReturnData = false)
    {
        $user = null;

        if (auth()->check()) {
            $this->$user = auth()->user();
        }

        $resource = Resources::where('title', $title)->first();

        $data = [
            'user' => $user,
            'resource' => $resource,
        ];

        return view('web.default.resources.index', $data);
    }

    public function download($resourceId)
    {
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        try {
            $resource = Resources::findOrFail($resourceId);
    
            $previousDownload = ResourcesDownload::where('user_id', $user->id)
                ->where('resource_id', $resourceId)
                ->first();
    
            if (!$previousDownload) {
                ResourcesDownload::create([
                    'user_id' => $user->id,
                    'resource_id' => $resourceId,
                    'date' => now(),
                ]);
            }
    
            $filePath = 'public/files/' . $resource->filename;
            if (!Storage::exists($filePath)) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh file. Silakan coba lagi nanti');
            }
    
            $fileContent = Storage::get($filePath);
    
            $downloadCount = ResourcesDownload::where('resource_id', $resourceId)->count();
    
            $formattedDownloadCount = sprintf('%07d', $downloadCount);
    
            $customText = $formattedDownloadCount . ' Personal Copy of ' . $user->full_name . ' ' . $user->nomor_anggota;
            $fileContentWithWatermark = $this->addCustomTextToPdf($fileContent, $customText);
    
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $resource->title . '.pdf"',
            ];
    
            return response($fileContentWithWatermark, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh file. Silakan coba lagi nanti');
        }
    }
    

    private function addCustomTextToPdf($fileContent, $customText)
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'pdf').'.pdf';
        file_put_contents($tempFilePath, $fileContent);

        $pdf = new FPDI();

        $pageCount = $pdf->setSourceFile($tempFilePath);
        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $pdf->AddPage();
            $template = $pdf->importPage($pageNumber);
            $pdf->useTemplate($template, 10, 10, 200);

            $pdf->SetFont('Arial');
            $pdf->SetFontSize(10);
            $pdf->SetTextColor(0, 0, 0);

            $textWidth = $pdf->GetStringWidth($customText);

            $pageWidth = $pdf->GetPageWidth();

            $xPosition = ($pageWidth - $textWidth) / 2;

            $pdf->SetXY($xPosition, 275);
            $pdf->Write(0, $customText);
        }

        $output = $pdf->Output('S');

        unlink($tempFilePath);

        return $output;
    }
}
