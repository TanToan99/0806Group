<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use Carbon\Exceptions\Exception;
use ZipArchive;
use File;

class ZipController extends Controller
{
    public function zipDownload($id)
    {
        $semester = Semester::findorFail($id);
        $missions = $semester->missions;

        $zip = new ZipArchive;
        $fileName = time() . '.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === true) {
            foreach ($missions as $mission) {
                foreach ($mission->ideas as $idea) {
                    $file = File::allfiles(storage_path('app/public/idea/' . $idea->id));
                    foreach ($file as $key => $value) {
                        $relativeNameInZipFile = basename($value);
                        $zip->addFile($value, str_replace(' ','',$mission->name) .'/'.  str_replace(' ','',$idea->title) .'/'.  $relativeNameInZipFile);
                    }
                }
            }
        }
        $zip->close();
            return response()->download(public_path($fileName));
    }
}
