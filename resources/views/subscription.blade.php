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
                    <div class="alert alert-success" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="alert alert-success" role="alert">
                        Enter payment information to subscribe for ${{$plan->price}}/month.
                    </div>
                    <small class="text-primary">Subscription automatically renews each month. No commitments, cancel anytime.</small>
                    <form id="payment-form" class="mt-3" action="{{route('subscription.save')}}" method="POST">
                        @csrf
                        <!-- plan -->
                        <input type="hidden" name="plan" id="plan" value="{{$plan->stripe_id}}">
                        <!-- payment method -->
                        <input type="hidden" name="payment-method" id="payment-method">
                        <!-- price -->
                        <!-- <input type="hidden" name="price" value="{{env('SUBSCRIPTION_PRICE')}}" /> -->
                        <!-- name -->
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardHolderFirstName" class="font-weight-bold">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="cardHolderFirstName" placeholder="First Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cardHolderLastName" class="font-weight-bold">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="cardHolderLastName" placeholder="Last Name" />
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Elements Placeholder -->
                        <div class="form-group">
                            <label for="card-element" class="font-weight-bold">Card Information</label>
                            <div id="card-element" class="form-control"></div>
                        </div>

                        <div id="card-errors" class='form-group text-danger'>
                        </div>

                        <button id="card-button" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{env("STRIPE_KEY")}}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    const FirstName = document.getElementById("cardHolderFirstName").value;
    const LastName = document.getElementById("cardHolderLastName").value;
    const cardHolderName = FirstName + ' ' + LastName;

    const displayError = document.getElementById('card-errors');

    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount('#card-element');

    // cardButton.addEventListener('change', (event) => {
    //     const displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message
    //     } else {
    //         displayError.textContent = '';
    //     }
    // })

    // Handle Form Submission
    const paymentForm = document.getElementById('payment-form');

    paymentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        displayError.textContent = '';
        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName
                    }
                }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            displayError.textContent = error.message
        } else {
            // The card has been verified successfully...

            const paymentMethodInput = document.getElementById('payment-method');
            paymentMethodInput.value = setupIntent.payment_method;
            paymentForm.submit();
        }
    });
</script>

@endpush