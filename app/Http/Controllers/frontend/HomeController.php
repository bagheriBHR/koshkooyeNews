<?php

namespace App\Http\Controllers\frontend;

use App\Article;
use App\Category;
use App\Commercial;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Traits\CommercialTrait;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use CommercialTrait;
    public function index(Request $request)
    {
            if(count($request->all())>0){
                $locale = $locale ?? app()->getLocale();
                $query = Article::with(['categories','tags'])->where('publish_status',1);
                if($request->q){
                    $query ->where('title', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('body', 'LIKE', '%' . $request->q . '%')
                        ->orWhere('roo_titr', 'LIKE', '%' . $request->q . '%')
                        ->orWhereHas('tags',function($q) use($locale,$request){
                            $q->where("name->{$locale}", 'LIKE', '%' . $request->q . '%');})
                        ->orWhereHas('categories',function($q) use($request){
                            $q->where("name", 'LIKE', '%' . $request->q . '%');
                        });
                }
                if($request->service){
                    $query ->whereHas('categories',function($q) use($request){
                        $q->where('category_id',$request->service);
                    });
                }
                if($request->from){
                    $from = explode('/',$request->from);
                    $from = Verta::getGregorian($from[0],$from[1],$from[2]);
                    $from = implode('-',$from);
                    $query->where('publish_date','>=',$from);
                }
                if($request->end){
                    $end = explode('/',$request->end);
                    $end = Verta::getGregorian($end[0],$end[1],$end[2]);
                    $end = implode('-',$end);
                    $query->where('publish_date','<=',$end);
                }
                if($request->type){
                    $query->where('type',$request->type);
                }
                $articles = $query->paginate(20);
                $categories = Category::where('parent_id',null)->whereHas('articles')->get();
                return view('frontend.news.search',compact(['articles','categories']));
            }
            $sliders = Article::with(['categories'=>function($q){
                $q->where('parent_id',null);
            }])->where('is_carousel',1)
                ->where('publish_status',1)->orderBy('created_at','desc')->get();
            $important = Article::with(['categories'=>function($q){
                $q->where('parent_id',null);
            }])->where('is_important',1)
                ->where('publish_status',1)->orderBy('created_at','desc')->limit(4)->get();
            $importantCount = Article::with(['categories'=>function($q){
                        $q->where('parent_id',null);
                    }])->where('is_important',1)
                        ->where('publish_status',1)->orderBy('created_at','desc')->count();

            $categories = Category::with(['childrenRecursive','articles'=>function($q){
                $q->where('publish_status',1)
                    ->where('is_carousel',0)
                    ->where('is_important',0)
                    ->where('type',0)
                    ->OrWhere('type',3);
            }])->where('parent_id','=',null)
                ->whereHas('articles',function($q) {
                    $q->where('publish_status', 1)
                        ->where('is_carousel', 0)
                        ->where('type',0)
                        ->OrWhere('type',3)
                        ->where('is_important', 0);
            })->get()->each(function($category) {
                    $category->limitRelationship('articles', 7);
                });

            $photoArticles = Article::where('publish_status',1)
                ->where('type',1)
                ->orderBy('created_at','desc')
                ->where('is_carousel',0)
                ->where('is_important',0)
                ->limit(4)->get();
            $videoArticles = Article::where('publish_status',1)
                ->where('type',2)
                ->orderBy('created_at','desc')
                ->where('is_carousel',0)
                ->where('is_important',0)
                ->limit(6)->get();

            $this->handleCommercials();
            $activeCommercials = Commercial::where('status',1)->get();

            return view('frontend.home.home',compact(['sliders','important','importantCount','categories','photoArticles','videoArticles','activeCommercials']));
    }

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
        ],[
            'name.required' => 'نام و نام خانوادگی خود را وارد کنید',
            'body.required' => 'نظر خود را وارد کنید',
            'email.required' => 'پست الکترونیکی خود را وارد کنید',
            'email.email' => 'پست الکترونیکی نامعتبر است',
        ]);

        if($validator->fails()) {
            return redirect()->to(app('url')->previous()."#contactHash")->withErrors($validator)->withInput();

        }


        $contact=new Contact();
        $contact->body = $request->body;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->save();
        Session::flash('success','نظر شما با موفقیت درج گردید و در انتظار تایید مدیر است.');
        return redirect()->to(app('url')->previous()."#contactHash");
    }

    public function commercialCounter($id)
    {
        $commercial = Commercial::find($id);
        $commercial->click_count = $commercial->click_count+1;
        $commercial->save();
        $url = $commercial->url;
        return Redirect::to($url);
    }

}
