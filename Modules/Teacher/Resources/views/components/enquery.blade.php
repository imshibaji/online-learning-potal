<div class="card card-body p-2">
    <div class="row">
        <div class="col-6 ">
            <h5><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{$name ?? 'Student Name'}}</h5>
            <small><i class="fa fa-map-o" aria-hidden="true"></i> {{$location ?? 'Kolkata, WB'}}</small>
            <div>
                <i class="fa fa-feed" aria-hidden="true"></i> {{$course ?? 'Website Designing'}}<br />
                <i class="fa fa-laptop" aria-hidden="true"></i> {{$class_mode ?? 'Online Class'}}<br />
                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>  {{$contacted ?? 0}} of {{$max_contact ?? 5}} Contacted - {{$expaire_at ?? 6}}d left
            </div>
        </div>
        <div class="col-6 text-right">
            <p>
                <small class="text-muted">{{$enq_at ?? '7min'}} before</small><br/>
                <i class="fa fa-phone-square text-success" aria-hidden="true"></i> {{$mobile ?? '89xxxx8499'}}<br/>
                <i class="fa fa-whatsapp text-success" aria-hidden="true"></i> {{$mobile ?? '89xxxx8499'}}<br/>
                <i class="fa fa-envelope-o text-primary" aria-hidden="true"></i> {{$email ?? 'ixxxg@gmail.com' }}
            </p>
        </div>
    </div>
</div>
