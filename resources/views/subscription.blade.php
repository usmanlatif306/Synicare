@extends('layouts.account')
@section('title', 'Subscription')
@section('content')
<div class="container page-container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Subscription</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if($subscription)
                    <div class="alert alert-info" role="alert">
                        You have {{$subscription->expired_at->diffInDays(now())}} days left in your subscrition. If you
                        renew then these days will be add in your
                        next subscription
                    </div>
                    @endif
                    <span class="text-primary font-weight-bold">You will be charged
                        ${{env('SUBSCRIPTION_PRICE')}}</span>
                    <form class="mt-3" action="{{route('subscription.save')}}" method="POST" id="paymentForm" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                        @csrf
                        <input type="hidden" name="price" value="{{env('SUBSCRIPTION_PRICE')}}" />
                        <div class="form-group">
                            <label for="cardHolderName" class="font-weight-bold">Card Holder Name *</label>
                            <input type="text" name="card_holder_name" class="form-control" id="cardHolderName" placeholder="Card Holder Name" />
                        </div>
                        <div class="form-group">
                            <label for="cardNumber" class="font-weight-bold">Credit Card Number *</label>
                            <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" class="form-control" id="cardNumber" placeholder="Credit Card Number" maxlength="16" />
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mmNumber" class="font-weight-bold">Expiration * (MM)</label>
                                    <input type="number" class="form-control" id="cardMonth" placeholder="MM" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cardYear" class="font-weight-bold">Expiration *(YYYY)</label>
                                    <input type="number" class="form-control" id="cardYear" placeholder="Year" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cardCVC" class="font-weight-bold">Card CVC *</label>
                                    <input type="number" class="form-control" id="cardCVC" placeholder="CVC" />
                                </div>
                            </div>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="subscribe" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    $(document).ready(function() {
        $("#paymentForm").submit(function(e) {
            e.preventDefault();
            $("#subscribe").attr("disabled", true);
            $("#subscribe").html("<i class='fas fa-circle-notch fa-spin'></i>");
            $('.error').addClass('d-none');
            e.preventDefault();
            Stripe.setPublishableKey($("#paymentForm").data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('#cardNumber').val(),
                cvc: $('#cardCVC').val(),
                exp_month: $('#cardMonth').val(),
                exp_year: $('#cardYear').val()
            }, stripeHandleResponse);
        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
                $("#subscribe").attr("disabled", false);
                $("#subscribe").text("Subscribe");
            } else {
                var token = response['id'];
                $("#paymentForm").append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $("#paymentForm").get(0).submit();
            }
        }
    });
</script>
@endpush