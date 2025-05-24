<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImportXmlFileRequest;
use App\Models\ContactModel;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * Show the form for to upload the file.
     */
    public function index()
    {
      return view('upload-xml-file');
    }

    /**
     * Store a uploaded XML file in storage.
     */

    public function store(ImportXmlFileRequest $request)
    {
        $file = $request->file('xml_file');

        // Generate random filename
        $randomFilename = Str::random(12) . '.' . $file->getClientOriginalExtension();

        // Define path to store uploaded files
        $filePath = public_path('assets/files/xml');

        // Create directory if not exists
        if (!file_exists($filePath)) {
            mkdir($filePath, 0755, true);
        }

        // Move uploaded file to the directory
        $file->move($filePath, $randomFilename);

        // Read XML content from saved file
        $fullFilePath = $filePath . '/' . $randomFilename;
        $xmlContent = file_get_contents($fullFilePath);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent);

        if ($xml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            return redirect()->back()->withErrors(['xml_file' => 'Invalid XML file.']);
        }

        // insert into DB
        foreach ($xml->contact as $contact) {
            ContactModel::create([
                'name' => (string) $contact->name,
                'phone' => (string) $contact->phone,
            ]);
        }

        return redirect()->back()->with('success', 'Contacts imported successfully!');
    }


}
