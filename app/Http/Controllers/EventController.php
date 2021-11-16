<?php

namespace App\Http\Controllers;

use App\event;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = event::where('status', '=', 1)
            ->orderby('start_date', 'desc')
            ->paginate(20);
        foreach ($events as $item) {
            if ($item->start_date < $this->dateNow) {
                $item->status_event = "برگزار شد";
            } else if ($item->start_date >= $this->dateNow && ($item->capacity > 0)) {
                $item->status_event = "در حال ثبت نام";
            } else if ($item->start_date >= $this->dateNow && ($item->capacity == 0)) {
                $item->status_event = "تکمیل ظرفیت";
            }

        }
        return view('events')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panelAdmin.insertEvent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'event' => 'required|persian_alpha_num|min:3',
            'shortlink' => 'required|string|min:3|unique:events',
            'description' => 'required|string|min:3|',
            'capacity' => 'required|numeric|',
            'type' => 'required|numeric|',
            'address' => 'required_with:type,1|string|',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:600',
            'video' => 'nullable|string|min:3|',
            'start_date' => 'required|string|max:11|',
            'start_time' => 'required|string|max:6|',
            'end_date' => 'required|string|max:11|',
            'end_time' => 'required|string|max:6|',
            'duration' => 'required|string|min:3|',
            'expire_date' => 'required|string|max:11|',
            'event_text' => 'required|string|min:10|',
            'heading' => 'nullable|string|min:10|',
            'contacts' => 'nullable|string|min:10|',
            'faq' => 'nullable|string|min:10|',
            'links' => 'nullable|string|min:10|',
        ]);


        try {
            $status = event::create($request->all() + [
                    'insert_user' => Auth::user()->id,
                ]);

            if ($status) {
                if ($request->has('image') && $request->file('image')->isValid()) {
                    $file = $request->file('image');
                    $image = "event-" . time() . "." . $request->file('image')->extension();
                    $path = public_path('/documents/events/');
                    $files = $request->file('image')->move($path, $image);
                    $request->image = $image;
                }
                $status->image = $image;
                $status->update();

                alert()->success('رویداد با موفقیت ثبت شد')->persistent('بستن');
                return back();
            }
        } catch (Throwable $e) {
            alert()->error($e->errorInfo[2], 'خطا')->persistent('بستن');
            return back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        $d = explode('/', $event->start_date);
        $t = explode(':', $event->start_time);
        $v = (Verta::createJalali($d[0], $d[1], $d[2], $t[0], $t[1], 0));
        $event->eventDate = ($v->format('%d %B Y  '));

        $eventReserve = NULL;
        if (Auth::check()) {
            $eventReserve = $this->get_eventReserve(NULL, Auth::user()->id, $event->id, NULL, NULL, 'first');
        }


        if ($event->start_date < $this->dateNow) {
            $event->status_event = "برگزار شد";
        } else if (($event->start_date >= $this->dateNow) && ($event->capacity > 0)) {
            $event->status_event = "در حال ثبت نام";
        } else if ($event->start_date >= $this->dateNow && ($event->capacity == 0)) {
            $event->status_event = "تکمیل ظرفیت";
        }


        return view('event')
            ->with('event', $event)
            ->with('eventReserve', $eventReserve);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        return view('panelAdmin.editEvent')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        $this->validate($request, [
            'event' => 'required|persian_alpha_num|min:3',
            'shortlink' => 'required|unique:events,shortlink,' . $event->id,
            'description' => 'required|string|min:3|',
            'capacity' => 'required|numeric|',
            'type' => 'required|numeric|',
            'address' => 'required_with:type,1|string|',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:600',
            'video' => 'nullable|string|min:3|',
            'start_date' => 'required|string|max:11|',
            'start_time' => 'required|string|max:6|',
            'end_date' => 'required|string|max:11|',
            'end_time' => 'required|string|max:6|',
            'duration' => 'required|string|min:3|',
            'expire_date' => 'required|string|max:11|',
            'event_text' => 'required|string|min:10|',
            'heading' => 'nullable|string|min:10|',
            'contacts' => 'nullable|string|min:10|',
            'faq' => 'nullable|string|min:10|',
            'links' => 'nullable|string|min:10|',
        ]);

        try {
            $status = $event->update($request->all());

            if ($request->has('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $image = "event-" . time() . "." . $request->file('image')->extension();
                $path = public_path('/documents/events/');
                $files = $request->file('image')->move($path, $image);
                $request->image = $image;
                $status->image = $image;
                $status->update();
            }

            alert()->success('رویداد با موفقیت بروزرسانی شد')->persistent('بستن');
            return redirect('/admin/event/all');
        } catch (Throwable $e) {
            alert()->error($e->errorInfo[2], 'خطا')->persistent('بستن');
            return back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        $status = $event->delete();
        if ($status) {
            alert()->success('رویداد با موفقیت حذف شد')->persistent('بستن');
        } else {
            alert()->error('خطا در حذف رویداد')->persistent('بستن');
        }
        return back();
    }

    public function eventsListAdmin()
    {
        $events = event::get();
        foreach ($events as $item) {
            if ($item->start_date < $this->dateNow) {
                $item->status_event = "برگزار شد";
            } else if ($item->start_date >= $this->dateNow && ($item->capacity > 0)) {
                $item->status_event = "در حال ثبت نام";
            } else if (($item->start_date >= $this->dateNow) && ($item->capacity == 0)) {
                $item->status_event = "تکمیل ظرفیت";
            }

        }
        return view('panelAdmin.events')
            ->with('events', $events);
    }

    public function usersEvent(event $event)
    {
        $users = event::join('eventreserves', 'events.id', '=', 'eventreserves.event_id')
            ->join('users', 'eventreserves.user_id', '=', 'users.id')
            ->where('eventreserves.event_id', '=', $event->id)
            ->orderby('eventreserves.id', 'asc')
            ->select('users.*', 'eventreserves.date_fa', 'eventreserves.time_fa')
            ->simplePaginate(20);
        return view('panelAdmin.listEventReserveUsers')
            ->with('event', $event)
            ->with('users', $users);
    }

    public function updateStatus(Request $request, event $event)
    {

        $this->validate($request,[
            'status'    =>'required|boolean'
        ]);

        $status=$event->update($request->all());

        if($status)
        {
            if($request->status==1)
            {
                return " رویداد ".$event->event." فعال شد ";
            }
            else
            {
                return " رویداد ".$event->event." غیرفعال شد ";
            }

        }
    }

}
