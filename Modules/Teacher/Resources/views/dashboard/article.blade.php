<div class="card">
    <div class="card-header">Latest Articles</div>
    <div class="card-body">
        <div class="card">
            <img height="248px" class="card-img-top" alt="{{ isset($article)? $article->title : '' }}" src="{{  (isset($article) && $article->image_path) ? url('storage/'.$article->image_path) : url('images/image-upload.jpg') }}" />
            <div class="card-body">
                <h6>{{ (isset($article) && $article->title)? Str::substr($article->title, 0, 80) : 'No Current Article'}}</h6>
                {{-- {{$article->description}} --}}
                <div class="btn-group btn-block mt-2">
                    <a class="btn btn-outline-info" href="{{ (isset($article))? route('teacherarticles.show', $article->id) : '#'}}">{{ isset($article)? $article->views : 0}} views</a>
                    <a class="btn btn-outline-primary" href="{{ (isset($article))? route('teacherarticles.show', $article->id) : '#'}}">{{ isset($article)? $article->likes : 0}} likes</a>
                </div>
            </div>
        </div>
    </div>
</div>
