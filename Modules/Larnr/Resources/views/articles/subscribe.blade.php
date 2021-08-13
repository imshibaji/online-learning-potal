<div id="subscribeModal" class="modal fade" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Subscribe yourself for regular updates</h5>
          <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="subs_thanks"></div>
            <form onsubmit="return subsnow(this)">
                @csrf
                @honeypot
                @captchaHTML
                    <input type="hidden" name="auid" value="{{$article->user->id}}" />
                <div class="row">
                    <div class="col-12 p-2">
                        <input type="text" name="name" required class="form-control my-1 my-md-0" placeholder="Your Name">
                    </div>
                    <div class="col-12 p-2">
                        <input type="email" name="email" required class="form-control my-1 my-md-0" placeholder="Your Email">
                    </div>
                    <div class="col-12 p-2">
                        <input type="text" name="mobile" class="form-control my-1 my-md-0" placeholder="Your Mobile Number(Optional)">
                    </div>
                    <div class="col-12 p-2 text-right">
                        <input type="submit" class="btn btn-primary my-1 my-md-0" value="Subscribe Now">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<script>
setTimeout(function(){
    $('#subscribeModal').modal('show');
}, 60000);
function subsnow(form) {
    var a = form[name="auid"].value;
    var n = form[name="name"].value;
    var e = form[name="email"].value;
    var m = form[name="mobile"].value;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    // console.log(n, e, m, CSRF_TOKEN);
    $.post('/subnow',{_token: CSRF_TOKEN, auid: a, name: n, email:e, mobile: m}).then(res=>{
        console.log(res);
        $('#subs_thanks').html(`
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            ${res.message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        `);
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500,function(){
                $('#subscribeModal').modal('hide');
            });
        });
    });
    return false;
}

</script>
