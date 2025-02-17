<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Request\editContactRequest;
use App\Http\Request\addContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contactList = Contact::all();
        return view('contacts/index')->with('contactList', $contactList);
    }

    public function add()
    {
        return view('contacts/add');
    }

    public function addSubmit(addContactRequest $request)
    {

        $data = [
            'name' => $request->name,
            'phone_number' => $request->phone,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $id = Contact::create($data)->id;

        return redirect("/")->with('success_message', 'Successfully Added.');
    }

    public function edit(Request $request)
    {
        if ($request->id) {
            $contactDetails = Contact::find($request->id);
            if (!empty($contactDetails)) {
                return view('contacts/edit')->with('contactDetails', $contactDetails);
            }
        }
        return redirect('/');
    }

    public function editSubmit(editContactRequest $request)
    {
        $contactDetails = Contact::find($request->id);
        if (!empty($contactDetails)) {
            Contact::where('id', $request->id)->update([
                'name' => $request->name,
                'phone_number' => $request->phone
            ]);
            return redirect("/")->with('success_message', 'Successfully updated.');
        }
        return redirect('/')->with('error_message', 'Something went wrong!!!');
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            Contact::where(array('id' => $request->id))->delete();
            return redirect('/')->with('success_message', 'Successfully deleted.');
        }
        return redirect('/');
    }

    public function xmlUpload(Request $req)
    {
        if ($req->isMethod("POST")) {

            if (!empty($req->file('contact_file'))) {
                $xmlDataString = file_get_contents($req->file('contact_file'));
                $xmlObject = simplexml_load_string($xmlDataString);

                $json = json_encode($xmlObject);
                $phpDataArray = json_decode($json, true);

                if (count($phpDataArray['contacts']) > 0) {

                    $dataArray = array();

                    foreach ($phpDataArray['contacts'] as $index => $data) {
                        // check duplicate phone 
                        $contactDetails = Contact::where(array('phone_number' => $data['phone_number']))->first();
                        if (empty($contactDetails)) {
                            $dataArray[] = [
                                "name" => $data['name'],
                                "phone_number" => $data['phone_number']
                            ];
                        }
                    }
                    Contact::insert($dataArray);
                    return back()->with('success_message', 'Data saved successfully and duplicate data has been ignored!');
                }
            }
        }

        //    return view("xml-data");
    }
}