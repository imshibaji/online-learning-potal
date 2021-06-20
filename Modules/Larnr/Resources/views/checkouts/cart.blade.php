<div class="card">
    <div class="card-header">
       <h4><i class="fa fa-shopping-basket"></i> Bill and Checkout Section</h4>
    </div>
    <div class="card-body" style="min-height: 480px">
        <table class="table">
            <thead>
                <tr>
                    <th>Product Details</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="text-secondary">
                            <i class="fa fa-check text-success" aria-hidden="true"></i> {{$course->title}}
                        </span> |
                        @if($course->offer_price != null)
                            <span>Price: <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong></span>,
                            <span><strong class="text-success">₹{{ $course->offer_price }}/-</strong></span>
                        @else
                            <span><strong class="text-success">₹{{ $course->actual_price }}/-</strong></span>
                        @endif
                    </td>
                    <td class="text-right">
                        <span><strong class="text-success">₹{{ $course->offer_price ?? $course->actual_price }}/-</strong></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-info text-right">Total Payment Amount</h5>
                    </td>
                    <td>
                        <h5 class="text-info text-right">₹{{ $course->offer_price ?? $course->actual_price }}/-</h5>
                    </td>
            </tbody>
        </table>
        <hr />
        {{-- Coupon Code --}}
        <div class="container">
            <form action="" method="post">
                <div class="form-row justify-content-end">
                    <div class="col offset-4 text-right">Coupon Code:</div>
                    <div class="col p-0 input-group">
                        <input type="text" name="coupon_code" class="form-control">
                        <div class="input-group-append">
                        <button class="btn btn-info" type="submit">Apply Code</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- Coupon Code --}}
        <hr />
        {{-- Notes Code --}}
        <div class="notes">
            <p><strong>Notes:</strong></p>
            <p>{{$notes ?? ''}}</p>
        </div>
    </div>
</div>
