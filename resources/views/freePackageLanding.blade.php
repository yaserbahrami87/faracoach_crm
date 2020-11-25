@extends('master.index')
@section('navbarTop')
    <div class="col-12 text-center" id="logofreepackagelanding">
        <img src="{{asset('/images/white-logo.png')}}"  />
    </div>
    <div class="col-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('images/coaching-01.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/coaching-02.png')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

@endsection


@section('row1')
    <div class="container table-responsive" id="table_freepackagedownload">
        <table class="table  table-bordered table-hover text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">مبحث</th>
                <th scope="col">مدرس</th>
                <th scope="col">زمان</th>
                <th scope="col">حجم</th>
                <th scope="col">نوع فایل</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="">
            <tr>
                <th scope="row">1</th>
                <td>آشنایی با کوچینگ و تاریخچه آن</td>
                <td>استاد یاسر متحدین</td>
                <td>00:08:58</td>
                <td>144.16 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/01-1.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>در یک جلسه کوچینگ چه می‌گذرد</td>
                <td>استاد یاسر متحدین</td>
                <td>00:11:11</td>
                <td>17.86 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/01-2.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>مهارت ارتباط موثر و همدلی در کوچینگ</td>
                <td>استاد یاسر متحدین</td>
                <td>01:00:04</td>
                <td>299.64 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/02.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>مهارت گوش دادن فعال در کوچینگ</td>
                <td>محمد صادق نجات</td>
                <td>01:43:50</td>
                <td>234.58 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/03.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>معجزه پرسشگری</td>
                <td>رضا ممتاز</td>
                <td>02:10:06</td>
                <td>16.76 مگابایت</td>
                <td>MP3</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/04-1.mp3" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>هدف‌گذاری در جلسه کوچینگ</td>
                <td>محمدصادق نجات</td>
                <td>00:59:54</td>
                <td>114.82 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/04-2.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">7</th>
                <td>بازخورد، مخالفت موثر، تشویق و تبریک</td>
                <td>استاد یاسر متحدین</td>
                <td>01:25:04</td>
                <td>495.27 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/05.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">8</th>
                <td>نظام ارزش‌ها</td>
                <td>استاد یاسر متحدین</td>
                <td>01:15:03</td>
                <td>480.52 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/06.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">9</th>
                <td>مقدمه‌ای بر مدل IGROW</td>
                <td>استاد یاسر متحدین</td>
                <td>00:24:00</td>
                <td>207.91 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/07-1.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">10</th>
                <td>رول پلی جلسه کوچینگ</td>
                <td>استاد یاسر متحدین</td>
                <td>01:37:35</td>
                <td>333.4 مگابایت</td>
                <td>MP4</td>
                <td class="text-center">
                    <a class="btn btn-primary" href="https://www.faracoachdl.ir/coaching/07-2.mp4" role="button" target="_blank">دانلود
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
