@extends('layouts.app')

@section('content')

    <div class="infoAlert alert d-none" role="alert">
    </div>

    <div class="links mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#donateModal">
            Donate
        </button>
    </div>

    <div class="row">
        @foreach($balance->available as $available)
            <div class="col col-6">
                <div class="card">
                    <div class="card-header">
                        Card
                    </div>
                    <div class="card-body">
                        <span class="amount">Amount: {{ $available->amount }}</span> <br>
                        <span class="currency">Currency: {{ $available->currency }}</span>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-6">
            @foreach($charges as $charge)
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="card-number">**** {{ $charge->source->last4 }}</span>
                    </div>
                    <div class="card-body">
                        <span class="card-name"><b>Card:</b> {{ $charge->source->brand }} / {{ $charge->source->funding }}</span> <br>
                        <span class="card-country"><b>Country:</b> {{ $charge->source->country }}</span> <br>
                        <span class="card-date"><b>Date:</b> {{ $charge->source->exp_month }}/{{ $charge->source->exp_year }}</span> <br>
                        <span class="amount"><b>Amount:</b> {{ substr($charge->amount, 0, -2) }}</span><br>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="donateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donateModalLabel">Donate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="donate_form" data-action="{{ route('payment') }}" data-method="POST">
                        @csrf
                        <div class="form-group email">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
                        </div>
                        <div class="form-group card-number">
                            <label for="card-number">Card number: </label>
                            <input type="number" class="form-control" id="card-number" name="card-number" placeholder="4242 4242 4242 4242" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group card-date">
                                    <label for="card-date">Card date: </label>
                                    <input type="text" class="form-control" id="card-date" name="card-date" placeholder="00/00" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group card-cvv">
                                    <label for="card-cvv">CVV: </label>
                                    <input type="password" class="form-control" id="card-cvv" name="card-cvv" placeholder="***" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group amount">
                            <div class="input-group mb-3">
                                <input type="text" name="amount" class="form-control" placeholder="100" aria-label="Amount" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group comment">
                            <label for="comment">Comment: </label>
                            <textarea name="comment" id="comment" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="donate-btn btn btn-success">Send</button>
                </div>
            </div>
        </div>
    </div>
@endsection
