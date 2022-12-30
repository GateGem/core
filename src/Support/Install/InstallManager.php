<?php

namespace GateGem\Core\Support\Install;

use Illuminate\Support\Facades\File;
use ZipArchive;

class InstallManager
{
    public function extractZip($pathZip, $targetFolder)
    {
        $zip = new ZipArchive();
        $status = $zip->open($pathZip);
        if ($status !== true) {
            throw new \Exception($status);
        } else {
            if (!File::exists($targetFolder)) {
                File::makeDirectory($targetFolder, 0755, true);
            }
            $zip->extractTo($targetFolder);
            $zip->close();
            return true;
        }
    }
    //public function
}
