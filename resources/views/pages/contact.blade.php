@extends('main')

@section('title', '| Contact')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>Contact us</h1>
            <form role="form" method="POST" action="{{route('postContact')}}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Type your message Here"></textarea>
                </div>

                <input type="submit" value="Send Message" class="btn btn-success form-control">
            </form>
        </div>
    </div>

</div>

@endsection