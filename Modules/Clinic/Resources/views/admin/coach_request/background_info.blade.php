<form method="post" action="/panel/coach/{{$coach_request->user->coach->id}}" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="card card-user " id="infogettingKnow">
        <div class="card-body bg-secondary-light">
            <div class="row">

                <div class="col-12 mb-2">
                    <label for="education_background">سوابق تحصیلی <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <textarea class="form-control textarea  bg-light" name="education_background" id="education_background" rows="3">{{$coach_request->user->coach->education_background}}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-2">
                    <label for="certificates">گواهینامه ها <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <textarea class="form-control textarea  bg-light" name="certificates" id="certificates" rows="3">{{$coach_request->user->coach->certificates}}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-2">
                    <label for="experience">سوابق کاری <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <textarea class="form-control textarea  bg-light" name="experience" id="experience" rows="3">{{$coach_request->user->coach->experience}}</textarea>
                    </div>
                </div>

                <div class="col-12 mb-2">
                    <label for="skills">مهارت ها <span class="text-danger">*</span></label>

                    <div class="form-group">
                        <textarea class="form-control textarea  bg-light" name="skills" id="skills" rows="3">{{$coach_request->user->coach->skills}}</textarea>
                    </div>
                </div>


                <div class="col-12 mb-2">
                    <label for="researches">سوابق علمی <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <textarea class="form-control textarea  bg-light" name="researches" id="researches" rows="3">{{$coach_request->user->coach->researches}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectpicker">گرایش های کوچ <span class="text-danger">*</span></label>
                    <div class="form-group" id="border">
                        <select class="form-control selectpicker" multiple="multiple" name="category[]" id="selectpicker" >
                            @foreach($categoryCoaches as $item)
                                <option value="{{$item->id}}" >{{$item->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="typecoach_id">سطح <span class="text-danger">*</span></label>
                    <div class="form-group" id="border">
                        <select class="form-control"  name="typecoach_id" id="typecoach_id" >
                            <option selected disabled>انتخاب کنید</option>
                            @foreach($typeCoaches as $item)
                                <option value="{{$item->id}}" @if($item->id==$coach_request->user->coach->typecoach_id) selected @endif >{{$item->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mb-5">بروزرسانی سوابق</button>

</form>
