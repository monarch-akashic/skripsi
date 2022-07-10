<?php

namespace App\Http\Controllers;

use App\Company;
use App\Reporting;
use App\User;
use Illuminate\Http\Request;
use App\Vacancy;
use App\Verifying;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function detailReport($id){
        $reporting = Reporting::where('id',$id)->first();
        $applicant = User::where('id', $reporting->applicant_id)->first();
        $company = Company::where('id', $reporting->company_id)->first();
        $company_info = User::where('id', $company->user_id)->first();
        // return $company_info;
        // $vacancy = Vacancy::find($reporting->vacancy_id)->get();


        return view('admin.detail_report_company')->with(['title' => 'Detail Reports', 'reporting' => $reporting, 'applicant' => $applicant, 'company_info' => $company_info]);
    }

    public function processReport(Request $request, $id){
        // return $id;
        $this->validate($request,[
            'reply' => ['required', 'string', 'max:255'],
        ]);

        switch ($request->input('action')) {
            case 'Reject':
                $reporting = Reporting::where('id',$id)->first();
                $reporting->notes = $request->input('reply');
                $reporting->status = 'Rejected';
                $reporting->save();
                // return $company_info;
                // $vacancy = Vacancy::find($reporting->vacancy_id)->get();
                return redirect('/list/report')->with('success', 'Report Rejected');
            case 'Approve':
                $reporting = Reporting::where('id',$id)->first();
                $reporting->notes = $request->input('reply');
                $reporting->status = 'Approve';
                $reporting->save();

                $vacancy = Vacancy::find($reporting->vacancy_id);
                $vacancy->flag_block = 'X';
                $vacancy->save();

                return redirect('/list/report')->with('success', 'Report on process');
        }

        // return view('admin.detail_report_company')->with(['title' => 'Detail Reports', 'reporting' => $reporting, 'applicant' => $applicant, 'company_info' => $company_info]);
    }

    public function listReports(){
        $reports = Reporting::join('companies', 'companies.id', '=', 'reportings.company_id')
        ->leftjoin('users','users.id', '=' , 'companies.user_id')
        ->whereIn('reportings.status',['Check by Admin'])
        ->get(['reportings.*', 'users.name']);

        // return $reports;

        return view('admin.list_reports')->with(['title' => 'List Reports', 'reports' => $reports]);
    }

    public function validateVacancy(){
        $vacancies = Vacancy::join('city', 'city.city_id', '=', 'vacancies.kota')
        ->join('companies','companies.id', '=' , 'vacancies.company_id')
        ->join('users','users.id', '=' , 'companies.user_id')
        ->whereIn('status_open' , ['Admin'])->get(['vacancies.id','vacancies.job_name','users.name','city.city_name']);

        $vacancies = $vacancies->sortBy('vacancies.created_on')->paginate(10);
        // $vacancies = Vacancy::where('status_open', 'Admin')->get();

        // return $vacancies;

        return view('admin.check_vacancy')->with(['title' => 'Validate Vacancy', 'vacancies' => $vacancies]);
    }

    public function processCompany(Request $request){
        // return $request;
        switch ($request->input('type')) {
            case 'penalize':
                $company = Company::where('id',$request->company_id)->first();
                $company->flag_block = 'X';
                $company->save();
                // return $company;
                return redirect('/list/company')->with('success', $company->getCompanyInfo->name.' have been penalized');
            case 'unpenalize':
                $company = Company::where('id',$request->company_id)->first();
                $company->flag_block = NULL;
                $company->save();
                // return $company;
                return redirect('/list/company')->with('success', $company->getCompanyInfo->name.' have been unpenalized');
            }
    }

    public function listCompany(){
        $companies = Company::join('users', 'users.id', '=', 'companies.user_id')
        ->get(['companies.id','users.name','companies.logo', 'companies.user_id', 'companies.flag_block', 'companies.verified'])->paginate(10);

        return view('admin.list_company')->with(['title' => 'List Companies', 'companies' => $companies]);
    }

    public function showVerifyCompanyDetail($id){
        $verify_data = Verifying::where('company_id', $id)->where('status', 'Check by Admin')->first();

        if(!$verify_data){
            return redirect('/list/company')->with('error', 'Company havent sent verifying data');

        }

        $company = Company::where('id',$id)->get();
        $user = User::find($company[0]->user_id);

        // return $company;

        return view('admin.detail_verify_company')->with(['title' => 'Detail Company', 'verify_data' => $verify_data, 'company' => $company, 'user' => $user]);
    }

    public function processVerify(Request $request){
        $this->validate($request,[
            'notes' => ['required', 'string', 'min:10' ,'max:255'],
        ]);

        $verify_data = Verifying::find($request->verify);
        $company = Company::find($request->company);

        switch ($request->input('action')) {
            case 'verify':
                $company->verified = 'Yes';
                $company->save();

                $verify_data->status = 'Verified';
                $verify_data->notes = $request->input('notes');
                $verify_data->save();

                Mail::to($company->getCompanyInfo->email)->send(new \App\Mail\Verified());


                return redirect('/list/company')->with('success', $request->name.' Verified, email has been sent');
            case 'reject':
                $verify_data->status = 'Rejected';
                $verify_data->notes = $request->input('notes');
                $verify_data->save();

                return redirect('/list/company')->with('success', $request->name.' Verification Rejected');
        }
        // return $request;
    }
}
