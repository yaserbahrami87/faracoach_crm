
    <div class="card card-user shadow-lg">
        <div class="image"></div>
        <div class="card-body">
            <div class="author">
                <a href="{{asset('/panel/profile')}}">
                    @if(is_null(Auth::user()->personal_image))
                        <img class="avatar border-gray border-2 border" src={{asset("/images/default-avatar.jpg")}} alt="..." />
                    @else
                        <img class="avatar border-gray border-2 border" src={{asset("/documents/users/".Auth::user()->personal_image)}} alt="..." />
                    @endif
                    <h5 class="title">{{Auth::user()->fname}} {{Auth::user()->lname}}</h5>
                </a>

            </div>
            <p class="description text-center">
                Everyone needs a coach
            </p>
        </div>

    </div>

