<?php

namespace Modules\Clinic\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Clinic\Entities\ClinicBasicInfo;

class ClinicBasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('clinic::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $services= Clinic_Basic_info::wherenull ('parent_id')
            ->get ();
        return view('clinic::admin.clinic.setting.basic_info_insert_service')
            ->with('services',$services);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate(request(),
            [
                'title'           =>'required|string',
                'pic'             =>'required|mimes:jpeg,jpg|max:600',
                'description'     =>'nullable',
                'status'          =>'required|boolean'

            ]);
        $status=Clinic_Basic_info::create($request->all());
        if ($status)
        {
            alert()->success("اطلاعات با موفقیت ذخیره شد ")->persistent('بستن');
        }
        else
        {
            alert()->error("خطا در ذخیره اطلاعات")->persistent('بستن');
        }
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('clinic::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ClinicBasicInfo $clinicBasicInfo)
    {
        return view('clinic::admin.clinic.setting.basic_info_edit_services')
                        ->with('clinicBasicInfo', $clinicBasicInfo);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,ClinicBasicInfo $clinicBasicInfo)
    {
        $request->validate(request(),
            [
                'title'           =>'required|string',
                'pic'             =>'required|mimes:jpeg,jpg|max:600',
                'description'     =>'nullable',
                'status'          =>'required|boolean',

            ]);

        $status = $clinicBasicInfo->update($request->all());
        if ($status) {
            alert()->success('به روز رسانی با موفقیت انجام شد')->persistent('بستن');
        } else {
            alert()->success('به روز رسانی با خطا مواجه شد')->persistent('بستن');
        }
        return redirect('admin/clinic_basic_info/create');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }


    public function store_speciality(Request  $request)
    {
        {
            //
            $this->validate(request(),
                [
                    'title'           =>'required|string',
                    'pic'             =>'required|mimes:jpeg,jpg|max:600',
                    'description'     =>'nullable',
                    'status'          =>'required|boolean',
                    'parent_id'       =>'required|numeric'

                ]);
            $status=Clinic_Basic_info::create($request->all());
            if ($status)
            {
                alert()->success("اطلاعات با موفقیت ذخیره شد ")->persistent('بستن');
            }
            else
            {
                alert()->error("خطا در ذخیره اطلاعات")->persistent('بستن');
            }

            return back();
        }
    }

    public function update_speciality(Request $request,ClinicBasicInfo $clinicBasicInfo)
    {

        $this->validate(request(),
            [
                'title'           =>'required|string',
                'pic'             =>'nullable|mimes:jpeg,jpg|max:600',
                'description'     =>'nullable',
                'status'          =>'required|boolean',
                'parent_id'       =>'required|numeric'

            ]);

        $status = $clinicBasicInfo->update($request->all());
        if ($status) {
            alert()->success('به روز رسانی با موفقیت انجام شد')->persistent('بستن');
        } else {
            alert()->success('به روز رسانی با خطا مواجه شد')->persistent('بستن');
        }
        return redirect('admin/clinic_basic_info/create_speciality');
    }


    public function update_orientation (Request $request,ClinicBasicInfo $clinicBasicInfo)
    {

        $this->validate(request(),
            [
                'title'           =>'required|string',
                'pic'             =>'required|mimes:jpeg,jpg|max:600',
                'description'     =>'nullable',
                'status'          =>'required|boolean',
                'parent_id'       =>'required|numeric'

            ]);

        $status = $clinicBasicInfo->update($request->all());
        if ($status) {
            alert()->success('به روز رسانی با موفقیت انجام شد')->persistent('بستن');
        } else {
            alert()->success('به روز رسانی با خطا مواجه شد')->persistent('بستن');
        }
        return redirect('admin/clinic_basic_info/create_orientation');
    }

    public function Services_all()
    {
        return  ClinicBasicInfo:: wherenull ('parent_id')
            ->get ();
    }

    public function create_speciality( )
    {
        $services_all=$this->Services_all();
        $services_id= ClinicBasicInfo:: select ('id')->wherenull ('parent_id')
            ->get ();
        $speciality=ClinicBasicInfo::whereIn('parent_id',$services_id)->get();

        return view('admin.clinic.setting.basic_info_insert_speciality')
            ->with('services_all',$services_all)
            ->with('speciality', $speciality);
    }

    public function create_orientation()
    {
        $services_all=$this->Services_all();
        $services_id= ClinicBasicInfo:: select ('id')->wherenull ('parent_id')
            ->get ();
        $speciality=ClinicBasicInfo::whereNotIn('parent_id',$services_id)->get();

        return view('admin.clinic.setting.basic_info_insert_orientation')
            ->with('services_all',$services_all)
            ->with('speciality', $speciality);
    }

    public function edit_speciality(ClinicBasicInfo $clinicBasicInfo)
    {
        $services_all=$this->Services_all();

        return view('admin.clinic.setting.basic_info_edit_speciality')
            ->with('services_all',$services_all)
            ->with('clinicBasicInfo', $clinicBasicInfo);
    }

    public function edit_orientation(ClinicBasicInfo $clinicBasicInfo)
    {

        $services_all=$this->Services_all();
        $services_id= ClinicBasicInfo:: select ('id')->wherenull ('parent_id')
            ->get ();
        $speciality=clinic_basic_info::whereIn('parent_id',$services_id)->get();
        return view('admin.clinic.setting.basic_info_edit_orientation')
            ->with('speciality',$speciality)
            ->with('clinicBasicInfo', $clinicBasicInfo);

    }

    public function ajax(ClinicBasicInfo  $clinicBasicInfo)
    {
        $parents=clinic_basic_info::where('parent_id','=',$clinicBasicInfo)
            ->get();
        return ($parents);
    }

    public function category(ClinicBasicInfo $clinicBasicInfo,Request $request)
    {


        $services=ClinicBasicInfo::whereNUll('parent_id')
            ->get();

        $category=[];
        foreach($clinicBasicInfo->children as $child)
        {
            foreach($child->children as $item )
            {
                array_push($category,$item->id);
            }
        }


        $coaches=coach::where(function($query) use ($category)
        {
            for ($i=0;$i<count($category);$i++)
            {
                $query->orwhere('category', 'like', $category[$i] . ',%')
                    ->orwhere('category', 'like', '%,' . $category[$i])
                    ->orwhere('category', 'like', '%,' . $category[$i] . ',%');
            }
        })
            ->when($request->name,function($query,$request)
            {
                $query->with('User')
                    ->wherehas('User',function($query)use($request)
                    {
                        $query->where('fname','like',"%$request%")
                            ->orwhere('lname','like',"%$request%");

                    });

            })
            ->when($request->student_coach,function($query)
            {
                $query->where('student_meeting',1);
            })
            ->when($request->gender=='man',function ($query,$request)
            {
                $query->with('User')
                    ->whereHas('user', function($query) use ($request)
                    {
                        $query->where('sex', $request);
                    });

            })
            ->when($request->gender=='woman',function ($query,$request)
            {
                $query->with('User')
                    ->whereHas('user', function($query) use ($request)
                    {
                        $query->where('sex', 0);
                    });

            })
            ->when($request->gender==2,function ($query,$request)
            {
                $query->with('User')
                    ->whereHas('user', function($query) use ($request)
                    {
                        $query->wherein('sex', [1,2,NULL]);
                    });

            })
            ->when($request->state,function($query,$request){
                $query->with('User')
                    ->whereHas('User',function ($query) use ($request)
                    {
                        $query->where('state',$request);
                    });
            })
            ->where('status',1)
            ->paginate(16);

        if($request->state)
        {
            $coaches->appends(['state'=>$request->state]);
        }

        if($request->gender)
        {
            $coaches->appends(['gender'=>$request->gender]);
        }

        if($request->student_coach)
        {
            $coaches->appends(['student_coach'=>$request->student_coach]);
        }

        $states=state::get();



        return view('clinic.clinic_coaches')
            ->with('coaches',$coaches)
            ->with('states',$states)
            ->with('services',$services)
            ->with('clinicBasicInfo',$clinicBasicInfo);
    }

}
