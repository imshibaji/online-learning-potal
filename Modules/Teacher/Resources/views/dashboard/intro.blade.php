<div class="card">
    <div class="card-header">Latest Updates</div>
    <div class="card-body">
        <div class="latest-updates">
            {{-- <x-video /> --}}
            <div class="card card-body mb-2">
                <h5>Welcome {{Auth::user()->fullname()}}</h5>
                <p>
                    Hello {{Auth::user()->fname}}, This is the teacher/ content creator studio.
                    From Here you can published your articles and courses from this panel.
                </p>
            </div>
            <div class="card card-body mb-2">
                <h5>Write Articles for Getting Traffic</h5>
                <p>
                    If you have any kind of knowledges. Then you can write your article also you can
                    Share your YouTube video article.
                </p>
            </div>
            <div class="card card-body mb-2">
                <h5>Create Course for Earning</h5>
                <p>
                    You can create your own course for sale. You create your your course for earning
                    money. We are taking only 30% charges per sale. And you will get 70% per sales.
                </p>
            </div>
        </div>
    </div>
</div>
<style>
    .latest-updates{
        height: 380px;
        overflow-y: scroll;
        border: 1px dotted rgb(0, 110, 255);
    }
    .latest-updates::-webkit-scrollbar {
        display: none;
    }
    .latest-updates {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
