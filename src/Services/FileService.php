<?php
declare(strict_types=1);

namespace App\Services;

class FileService
{
    public function listAllFileNamesInDirectory($path): array {
        $files = scandir($path);

        return array_diff($files, ['..', '.']);
    }
}