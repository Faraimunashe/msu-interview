<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company', [
            'companies' => Company::paginate(10)
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:companies,email'],
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'website' => ['required']
        ]);

        try{
            $destinationPath = 'images';
            $myimage = $request->logo->getClientOriginalName();
            $finalname = $myimage;
            $request->logo->move(public_path($destinationPath), $finalname);
            //$name = $request->file('logo')->getClientOriginalName();

           //$path = $request->file('logo')->store('public/images');

            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $finalname;
            $company->website = $request->website;

            //upload file her
            $company->save();
            return redirect()->back()->with('success', 'You have added company successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'logo' => ['file', 'required'],
            'website' => ['required']
        ]);

        try{
            $destinationPath = 'images';
            $myimage = $request->logo->getClientOriginalName();
            $finalname = $myimage;
            $request->logo->move(public_path($destinationPath), $finalname);
            //$name = $request->file('logo')->getClientOriginalName();

           //$path = $request->file('logo')->store('public/images');

            $company = Company::find($request->company_id);
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $finalname;
            $company->website = $request->website;

            //upload file her
            $company->save();
            return redirect()->back()->with('success', 'You have updated company successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'company_id' => ['required', 'numeric']
        ]);

        try{
            $company = Company::find($request->company_id);
            //upload file her
            $company->delete();
            return redirect()->back()->with('success', 'You have deleted company successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
        }
    }
}
