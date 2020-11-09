<div class="modal-custom__header">★Star Rating System</div>
<div class="modal-custom__body">
    <p>We place a star rating as a guide to each woman after our initial interview with her.
        It is not so much about her looks as it is her demeanor, conversation, and attitude towards meeting new
        people.</p>
    <div class="d-block">
        @include('includes.rating', ['rating' => 100])
        <span style="font-size: .8rem">Highly Recommended</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 80])
        <span style="font-size: .8rem">Excellent</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 60])
        <span style="font-size: .8rem">Standard, No Problems</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 40])
        <span style="font-size: .8rem">Approach with care</span>
    </div>

    <div class="d-block">
        @include('includes.rating', ['rating' => 20])
        <span style="font-size: .8rem">She is either a trouble-causer, high maintenance, or has bad reviews.</span>
    </div>
    <p>
        ※ Stars are often removed for cancellations without notice. If you are concerned about a low rating please ask
        UC staff for details.
    </p>
</div>
