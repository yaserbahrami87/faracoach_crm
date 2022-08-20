<?php

namespace App\Http\Controllers;

use App\followup;
use App\User;
use App\user_type;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\SheetCollection;

class ReportAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if (isset($_GET['range'])) {
            $this->validate($request, [
                'start_date' => 'required|string',
            ]);
            $request['start_date'] = explode(' ~ ', $request['start_date']);
        } else {
            $dateNow = verta();
            $request['start_date'] = [$dateNow->startMonth()->format('Y/m/d'), $dateNow->endMonth()->format('Y/m/d')];

        }

        if (isset($request['start_date'])) {

            $date_en = [$this->changeTimestampToMilad($request['start_date'][0]) . " 00:00:00", $this->changeTimestampToMilad($request['start_date'][1]) . " 23:59:59"];
        } else {

            $date_en = [$this->changeTimestampToMilad($request['start_date'][0]) . " 00:00:00", $this->changeTimestampToMilad($request['start_date'][1]) . " 23:59:59"];
        }
        return view('admin.reports.reportUser')
            ->with('date_fa', $request['start_date'])
            ->with('date_en', $date_en)
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allReportsUsers(Request $request)
    {
        if (isset($request['range'])) {
            $this->validate($request, [
                'start_date' => 'required|string',
            ]);
            $request['start_date'] = explode(' ~ ', $request['start_date']);
            $date_en = [$this->changeTimestampToMilad($request['start_date'][0]) . " 00:00:00", $this->changeTimestampToMilad($request['start_date'][1]) . " 23:59:59"];
            $users = User::wherebetween('created_at', $date_en)
                ->get();
            $followups = followup::wherebetween('date_fa', $request['start_date'])
                ->get();
        } else {
            $users = User::get();
            $followups = followup::get();
        }


        $v = verta();
        $ageTo20 = $users->wherebetween('datebirth', [$v->subYears(20), $v->now()]);
        $age21to30 = $users->wherebetween('datebirth', [$v->now()->subYears(30), $v->now()->subYears(21)]);
        $age31to40 = $users->wherebetween('datebirth', [$v->now()->subYears(40), $v->now()->subYears(31)]);
        $age41to50 = $users->wherebetween('datebirth', [$v->now()->subYears(50), $v->now()->subYears(41)]);
        $age51to60 = $users->wherebetween('datebirth', [$v->now()->subYears(60), $v->now()->subYears(50)]);
        $age61to70 = $users->wherebetween('datebirth', [$v->now()->subYears(70), $v->now()->subYears(61)]);
        $age71to80 = $users->wherebetween('datebirth', [$v->now()->subYears(80), $v->now()->subYears(71)]);
        $age901to81 = $users->wherebetween('datebirth', [$v->now()->subYears(90), $v->now()->subYears(81)]);
        $ages = ['ageTo20' => $ageTo20->count(), 'age21to30' => $age21to30->count(), 'age31to40' => $age31to40->count(), 'age41to50' => $age41to50->count(), 'age51to60' => $age51to60->count(), 'age61to70' => $age61to70->count(), 'age71to80' => $age71to80->count()];


        return view('admin.reports.allDatabase')
            ->with('followups', $followups)
            ->with('date_jalali', $v->now())
            ->with('ages', $ages)
            ->with('users', $users);
    }

    public function exportExcel_allReportsUsers(Request $request)
    {

        if (isset($request['range'])) {

            $this->validate($request, [
                'start_date' => 'required|string',
                'end_date' => 'required|string',
            ]);


//            $request['start_date']=explode(' ~ ',$request['start_date']);
            $date_en = [$this->changeTimestampToMilad($request['start_date']) . " 00:00:00", $this->changeTimestampToMilad($request['end_date']) . " 23:59:59"];
            $users = User::wherebetween('created_at', $date_en)
                ->get();


            $followups = followup::wherebetween('date_fa', [$request['start_date'], $request['end_date']])
                ->get();


        } else {
            $users = User::get();
            $followups = followup::get();
        }

        $v = verta();
        $ageTo20 = $users->wherebetween('datebirth', [$v->subYears(20), $v->now()]);
        $age21to30 = $users->wherebetween('datebirth', [$v->now()->subYears(30), $v->now()->subYears(21)]);
        $age31to40 = $users->wherebetween('datebirth', [$v->now()->subYears(40), $v->now()->subYears(31)]);
        $age41to50 = $users->wherebetween('datebirth', [$v->now()->subYears(50), $v->now()->subYears(41)]);
        $age51to60 = $users->wherebetween('datebirth', [$v->now()->subYears(60), $v->now()->subYears(50)]);
        $age61to70 = $users->wherebetween('datebirth', [$v->now()->subYears(70), $v->now()->subYears(61)]);
        $age71to80 = $users->wherebetween('datebirth', [$v->now()->subYears(80), $v->now()->subYears(71)]);
        $age901to81 = $users->wherebetween('datebirth', [$v->now()->subYears(90), $v->now()->subYears(81)]);
        $ages = ['ageTo20' => $ageTo20->count(), 'age21to30' => $age21to30->count(), 'age31to40' => $age31to40->count(), 'age41to50' => $age41to50->count(), 'age51to60' => $age51to60->count(), 'age61to70' => $age61to70->count(), 'age71to80' => $age71to80->count()];


        //آمار استان ها
        $list_state = [];
        foreach ($users->groupby('state') as $item) {
            if (!is_null($item[0]->get_state)) {
                array_push($list_state, ['استان' => $item[0]->get_state['name'], 'تعداد' => count($item), 'دانشجو' => $item->where('type', '=', 20)->count()]);
            } else {
                array_push($list_state, ['استان' => "نامشخص", 'تعداد' => count($item), 'دانشجو' => $item->where('type', '=', 20)->count()]);
            }
        }


        //آمار پیگیری ها
        $list_followups = [];
        foreach ($followups->groupby('course_id') as $item) {
            if (!is_null($item[0]->course)) {
                array_push($list_followups, ['دوره' => $item[0]->course['course'], 'تعداد' => count($item), 'مدت مکالمه' => round($item->sum('talktime') / 60), 'دانشجو' => $item->where('status_followups', '=', 20)->count(), 'تور پیگیری' => $item->where('status_followups', '=', 11)->count(), "انصراف" => $item->where('status_followups', '=', 12)->count(), "در انتظار تصمیم" => $item->where('status_followups', '=', 13)->count(), 'عدم پاسخگویی' => $item->where('status_followups', '=', 14)->count(), 'مارکتینگ' => $item->wherein('status_followups', [-1, -2, -3])->count(), "جلسات" => $item->where('status_followups', '=', 30)->count(), "رویداد" => $item->where('status_followups', '=', 40)->count()]);
            } else {
                array_push($list_followups, ['دوره' => "", 'تعداد' => count($item), 'مدت مکالمه' => round($item->sum('talktime') / 60), 'دانشجو' => $item->where('status_followups', '=', 20)->count(), 'تور پیگیری' => $item->where('status_followups', '=', 11)->count(), "انصراف" => $item->where('status_followups', '=', 12)->count(), "در انتظار تصمیم" => $item->where('status_followups', '=', 13)->count(), 'عدم پاسخگویی' => $item->where('status_followups', '=', 14)->count(), 'مارکتینگ' => $item->wherein('status_followups', [-1, -2, -3])->count(), "جلسات" => $item->where('status_followups', '=', 30)->count(), "رویداد" => $item->where('status_followups', '=', 40)->count()]);
            }


        }

        $list_gettingknow = [];
        foreach ($users->groupby('gettingknow') as $item) {
            if (!is_null($item[0]->get_gettingknow)) {
                array_push($list_gettingknow, ['نحوه آشنایی' => $item[0]->get_gettingknow['category'], 'تعداد' => count($item), 'دانشجو' => $item->where('type', '=', 20)->count(), 'پیگیری نشده' => $item->where('type', '=', 1)->count(), 'تور پیگیری' => $item->where('type', '=', 11)->count(), "انصراف" => $item->where('type', '=', 12)->count(), "در انتظار تصمیم" => $item->where('type', '=', 13)->count(), 'عدم پاسخگویی' => $item->where('type', '=', 14)->count(), 'مارکتینگ' => $item->wherein('type', [-1, -2, -3])->count(), "جلسات" => $item->where('type', '=', 30)->count(), "رویداد" => $item->where('type', '=', 40)->count()]);
            } else {
                array_push($list_gettingknow, ['نحوه آشنایی' => "نامشخص", 'تعداد' => count($item), 'دانشجو' => $item->where('type', '=', 20)->count(), 'پیگیری نشده' => $item->where('type', '=', 1)->count(), 'تور پیگیری' => $item->where('type', '=', 11)->count(), "انصراف" => $item->where('type', '=', 12)->count(), "در انتظار تصمیم" => $item->where('type', '=', 13)->count(), 'عدم پاسخگویی' => $item->where('type', '=', 14)->count(), 'مارکتینگ' => $item->wherein('type', [-1, -2, -3])->count(), "جلسات" => $item->where('type', '=', 30)->count(), "رویداد" => $item->where('type', '=', 40)->count()]);
            }
        }


        //جنسیت
        $list_gender = [];
        foreach ($users->groupby('sex') as $item) {
            switch ($item[0]->sex) {
                case ("1"):
                    array_push($list_gender, ['جنسیت' => 'مرد', 'تعداد' => count($item)]);
                    break;
                case ("0"):
                    array_push($list_gender, ['جنسیت' => 'زن', 'تعداد' => count($item)]);
                    break;
                default:
                    array_push($list_gender, ['جنسیت' => 'نامشخص', 'تعداد' => count($item)]);
            }

        }


        //تحصیلات
        $list_education = [];
        foreach ($users->groupby('education') as $item) {
            if (!is_null($item[0]->education)) {
                array_push($list_education, ['تحصیلات' => $item[0]->education, 'تعداد' => count($item)]);
            } else {
                array_push($list_education, ['تحصیلات' => "نامشخص", 'تعداد' => count($item)]);
            }
        }


        //تاهل
        $list_married = [];
        foreach ($users->groupby('married') as $item) {
            switch ($item[0]->married) {
                case "1":
                    array_push($list_married, ['تاهل' => 'متاهل', 'تعداد' => count($item)]);
                    break;
                case "0":
                    array_push($list_married, ['تاهل' => 'مجرد', 'تعداد' => count($item)]);
                    break;
                default:
                    array_push($list_married, ['تاهل' => 'نامشخص', 'تعداد' => count($item)]);
            }
        }


        //تفکیک سن
        $list_ages = [];
        array_push($list_ages, ['تا 20 سال' => $ageTo20->count(), '21 تا 30 سال' => $age21to30->count(), '31 تا 40 سال' => $age31to40->count(), '41 تا 50 سال' => $age41to50->count(), '51 تا 60 سال' => $age51to60->count(), '61 تا 70 سن' => $age71to80->count(), '71 تا 80 سال' => $age71to80]);


        $sheets = new SheetCollection([
            'آمار استانها' => $list_state,
            'آمار پیگیری' => $list_followups,
            'نحوه آشنایی' => $list_gettingknow,
            'جنسیت' => $list_gender,
            'تاهل' => $list_married,
            'تفکیک سن' => $list_ages,
        ]);
        $fileName = time() . ".xlsx";
        $excel = fastexcel($sheets)->export($fileName);
        return response()->download(public_path($fileName))
            ->deleteFileAfterSend(true);

    }


    public function advanceReport_create()
    {
        $states = $this->states();
        $userType = user_type::get();
        return view('admin.reports.report_advance')
            ->with('states', $states)
            ->with('userType', $userType);
    }

    public function advanceReport(Request $request)
    {

        $this->validate($request, [
            'range_date' => 'nullable|string',
            'gender' => 'nullable|array',
            'married' => 'nullable|array',
            'state' => 'nullable|array',
            'education' => 'nullable|array',
            'social' => 'nullable|array',
            'types' => 'nullable|array',
        ]);

        if (isset($request->range_date)) {
            $request['range'] = explode(' ~ ', $request['range_date']);
            $request['date_en'] = [$this->changeTimestampToMilad($request['range'][0]) . " 00:00:00", $this->changeTimestampToMilad($request['range'][1]) . " 23:59:59"];
        } else {
            $request['range'] = [$this->dateNow, $this->dateNow];
            $request['date_en'] = [$this->changeTimestampToMilad($request['range'][0]) . " 00:00:00", $this->changeTimestampToMilad($request['range'][1]) . " 23:59:59"];
        }


        $users = User::when($request->gender, function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->wherein('sex', $request->gender)
                    ->when(in_array('NULL', $request->gender), function ($query) use ($request) {
                        $query->orwhereNull('sex');
                    });
            });
            if (in_array('NULL', $request->gender)) {
                $query->orwhereNull('sex');
            }
            return $query;
        })
            ->when($request->married, function ($query) use ($request) {
                return $query->wherein('married', $request->married);
            })
            ->when($request->state, function ($query) use ($request) {
                return $query->wherein('state', $request->state);
            })
            ->when($request->education, function ($query) use ($request) {
                return $query->wherein('education', $request->education);
            })
            ->when($request->types, function ($query) use ($request) {
                return $query->wherein('type', $request->types);
            })
            ->when($request->kind == 'پیگیری', function ($query) {
           return $query->with('followups')
                       ->whereHas('followups', function($q) {
                           $q->where('status_followup', '13');
                       });
            })
            ->wherebetween('created_at', $request->date_en)
            ->get();
        dd($users);
    }
}

