<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Sitemap\SitemapGenerator;

use function PHPSTORM_META\map;

class LarnrController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();
    }

    public function index()
    {
        $videos = Video::publish()->inRandomOrder()->limit(4)->get();
        $articles = Article::publish()->inRandomOrder()->limit(4)->get();
        $courses = Course::publish()->inRandomOrder()->limit(4)->get();
        // return $videos;
        return view('larnr::index', compact('videos', 'articles', 'courses'));
    }

    public function search(Request $request){
        $terms = $request->query('q');
        $terms = ($terms == 'all')? null : $terms;
        $articles = Article::where('title', 'LIKE', '%'.$terms.'%')->orWhere('keywords', 'LIKE', '%'.$terms.'%')->orderBy('id','desc')->paginate(5);
        $videos = Video::where('title', 'LIKE', '%'.$terms.'%')->orWhere('keywords', 'LIKE', '%'.$terms.'%')->orderBy('id','desc')->paginate(5);



        $title = $terms;
        // dd($videos);
        if(count($videos) > 0){
            $title = 'Search for '. ($terms ?? 'Software development tutorials');
            $keywords = implode(',', explode(' ', $terms)).',learning videos,tutorials,videos,articles';
            $description = $videos[0]->description;
            $og_url = $request->url();
            $og_image= url('storage/'.$videos[0]->image_path);
            $og_video = url('storage/'.$videos[0]->video_path);
        }else{
            $keywords = 'search video, learning videos, tutorials, videos';
            $description = 'You can search learning videos.';
            $og_url = $request->url();
            $og_image= url('images/screen.png');
            $og_video = url('videos/intro.mp4');
        }

        $query_out = [
            'q' => $request->query('q') ?? 'all',
            't' => $request->query('t'),
        ];

        $videos->appends($query_out);

        // dump($terms);

        return view('larnr::search', compact('videos', 'articles', 'title', 'keywords',
        'description', 'og_url', 'og_image', 'og_video'));
    }

    public function sitemapGen(){
         SitemapGenerator::create('https://www.larnr.com')->writeToFile(public_path('sitemap.xml'));
         return redirect('/sitemap.xml');
    }
    public function tac(){
        return view('larnr::tac');
    }
    public function privacy(){
        return view('larnr::privacy');
    }
    public function about(){
        return view('larnr::about');
    }
    public function contact(){
        return view('larnr::contact');
    }
}
