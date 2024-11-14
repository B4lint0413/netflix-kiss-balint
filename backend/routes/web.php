<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopListController;

Route::get("/", [TopListController::class, "index"])->name("home");
Route::get("/toplist", [TopListController::class, "toplist"])->name("toplist.toplist");
Route::get("/categories/{category_name}", [TopListController::class, "category"])->name("toplist.category");
Route::get("/categories", [TopListController::class, "categories"])->name("toplist.categories");
Route::get("/films", [TopListController::class, "films"])->name("toplist.films");
Route::get("/tvs", [TopListController::class, "tvs"])->name("toplist.tvs");
Route::get("/popular", [TopListController::class, "popular"])->name("toplist.popular");
Route::get("/week/{week}", [TopListController::class, "week"])->where("week", "\b([2][0-9]|[1][9])[0-9]{2}-([1][0-2]|[0][0-9])-([3][0-1]|[0-2][0-9])\b")->name("toplist.week");
Route::get("/top1/{week}", [TopListController::class, "top1"])->where("week", "\b([2][0-9]|[1][9])[0-9]{2}-([1][0-2]|[0][0-9])-([3][0-1]|[0-2][0-9])\b")->name("toplist.top1");