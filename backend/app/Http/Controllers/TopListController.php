<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TopListController extends Controller
{
    public function index(){
        $builder = DB::table("toplist");
        
        $builder->orderByDesc("weekly_hours_viewed");
        return view("toplist.index", [
            "title"=>"Netflix toplista",
            "mostWatchedTitle" => $builder->value("show_title"),
            "lastWeek" => $builder->max("week"),
            "sumHours"=> $builder->sum("weekly_hours_viewed")
        ]);
    }

    public function toplist(){
        $builder = DB::table("toplist");

        return view("toplist.table", [
            "title" => "Netlix toplista",
            "items" => $builder->paginate(10)
        ]);
    }

    public function category($category_name){
        $builder = DB::table("toplist");
        $builder->where("category", "=", $category_name);

        return view("toplist.table", [
            "title" => "Kategória: ".$category_name,
            "items" => $builder->paginate(10)
        ]);
    }

    public function categories(){
        $builder = DB::table("toplist");
        return view("toplist.categories", [
            "title" => "Kategóriák",
            "categories" => $builder->pluck("category")->unique()
        ]);
    }

    public function films(){
        $builder = DB::table("toplist");
        $builder->where("category", "like", "Films%");
        return view("toplist.table", [
            "title"=>"Netflix filmek toplista",
            "items"=>$builder->paginate(10)
        ]);
    }

    public function tvs(){
        $builder = DB::table("toplist");
        $builder->where("category", "like", "TV%");
        return view("toplist.table", [
            "title"=>"Netflix sorozatok toplista",
            "items"=>$builder->paginate(10)
        ]);
    }

    public function popular(){
        $builder = DB::table("toplist");
        $builder->where("category", "like", "TV%");
        $builder->where("cumulative_weeks_in_top_ten", ">=", 23);
        $builder->orWhere("weekly_hours_viewed", ">=", 158680000);
        $builder->orderByDesc("weekly_hours_viewed");
        return view("toplist.table", [
            "title"=>"Népszerű műsorok",
            "items"=>$builder->paginate(10)
        ]);
    }

    public function week($week, Request $request){
        $builder = DB::table("toplist");
        $builder->where("week", "=", $week);

        $order_by = $request->get("order_by");
        switch ($order_by) {
            case 'category':
            case 'weekly_rank':
                $builder->orderBy($order_by);
                break;
            case 'weekly_hours_viewed':
                $builder->orderByDesc($order_by);
                break;
        }

        return view("toplist.table", [
            "title"=>"Heti adatok: ".$week,
            "week" => $week,
            "items"=>$builder->paginate(10)
        ]);        
    }

    public function top1($week){
        $builder = DB::table("toplist");
        $builder->where("week", "=", $week);
        $builder->where("category", "=", "TV (English)");
        $builder->orderBy("weekly_rank");

        return view("toplist.top1", [
            "title"=>"Top 1 ".$week,
            "showTitle"=>$builder->value("show_title")
        ]);        
    }
}
