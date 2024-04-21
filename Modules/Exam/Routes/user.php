<?php

//exams
Route::get('/exam/{exam}','ExamController@show');
Route::post('/exam/{exam}','ExamController@answer_store');

Route::post('/takeExam/{takeExam}/certificate/download','TakeExamController@get_certificate_CCE');
Route::resource('takeExam','TakeExamController');
