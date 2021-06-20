<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(){
        $article = Article::active()->orderBy('updated_at', 'desc')->first();
        $course = Course::active()->orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'article' => $article,
            'course' => $course,
        ])->header('Content-Type', 'text/xml');

    }

    public function urls(){
        $routesInfo = Route::getRoutes();
        $routes = [];
        foreach($routesInfo as $r){
            array_push($routes, [
                'url' => $r->uri,
                'domain' => $r->action['domain'] ?? '',
                'method' => $r->methods[0],
                'middleware' => $r->action['middleware']
            ]);
            // array_push($routes, $r);
        }
        return $routes;
    }
}
