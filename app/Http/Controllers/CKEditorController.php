<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function uploadImage(Request $request)
    {

        // Mendapatkan indeks jawaban dari request
        $answerIndex = $request->input('answer_index', 0);

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathInfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $uploadType = $request->input('upload_type');

            switch ($uploadType) {
                case 'answer':
                    $uploadPath = 'answers_' . $answerIndex;
                    break;
                case 'question':
                    $uploadPath = 'questions';
                    break;
                case 'materi':
                    $uploadPath = 'materials';
                    break;
                // Add more cases as needed for additional types
                default:
                    $uploadPath = 'default';
                    break;
            }

            $request->file('upload')->move(public_path("images/media/$uploadPath"), $fileName);

            $url = asset("images/media/$uploadPath/$fileName");

            // Simpan URL ke dalam sesi
            $uploadedImages = session("uploaded_images_$uploadPath", []);
            $uploadedImages[] = $url;
            session(["uploaded_images_$uploadPath" => $uploadedImages]);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
