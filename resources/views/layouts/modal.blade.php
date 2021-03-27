<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="ModalTitle">{{$modalTitle ?? 'Default Title'}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="ModalBody" class="modal-body">
        {!! $modalBody ?? 'Default Content' !!}
    </div>
    <div class="modal-footer">
        <button type="button" id="cancelBtn" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="okBtn" class="btn btn-primary">Checkout Now</button>
    </div>
    </div>
</div>
</div>

<script>
function modal(title, body, callback){
    var stat = false;
    $('#ModalTitle').html(title);
    $('#ModalBody').html(body);
    $('#ModalCenter').modal();
    
    $('#okBtn').click(()=>{
        $('#ModalCenter').modal('hide');
        if(typeof callback === 'function' && stat == false){
            stat = true;
            callback({status: stat, message: 'Ok Btn Clecked'});
        }
    });
    $('#cancelBtn').click(()=>{
        $('#ModalCenter').modal('hide');
        if(typeof callback === 'function' && stat == false){
            stat = true;
            callback({status: false, message: 'Cancel Btn Clecked'});
        }
    });
}

// Generel Purpose
function modalBtn(title, body){
    modal(title, pbody, function(e){
        console.log(e);
    });
}

// It use for Checkout
function checkout(title, amt){
    // var balAmt = parseFloat('{!! Auth::user()->money()->get()->last()->balance_amt ?? 0 !!}');
    var name = '{{Auth::user()->fname }} {{Auth::user()->lname }}';
    var email = '{{ Auth::user()->email }}';
    var mobile = '{{ Auth::user()->mobile }}';
    // var email = 'imshibaji@gmail.com';
    // var mobile = '8981009499';
    var courseAmt = amt;

    pbody =`
        <div class="text-center h4">Course Name: <strong>${title}</strong>.</div>
        <div class="text-center h6">Course Amount: <strong>₹${courseAmt}</strong>.</div>
        <div class="text-center h6">Your Email: <strong>${email}</strong>.</div>
        <div class="text-center h6">Your Mobile: <strong>${mobile}</strong>.</div>
    `;
    
    modal(title, pbody, function(e){
        var data = '{{url("/")}}/payment';
        data += '?pps='+ title;
        data += '&amt='+ courseAmt;
        data += '&name='+ name;
        data += '&email='+ email;
        data += '&mobile='+ mobile;

        if(e.status == true){
            window.location.replace(data);
        }
        // 
        // console.log(e, courseAmt); 
    });
}
</script>