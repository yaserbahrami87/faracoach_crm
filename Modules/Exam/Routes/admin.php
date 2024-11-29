<?php
//exams
Route::get('/exam/{exam}/questions','ExamController@ExamQuetions_show');
Route::post('/exam/{exam}/questions','ExamController@ExamQuetions_store');

Route::get('/exam/{exam}/questions/create','ExamController@ExamQuetions_create');
Route::resource('exam','ExamController');

//exam Questions
Route::resource('examQuestion','ExamQuestionController');

//Take Exam
Route::resource('takeExam','TakeExamController');
