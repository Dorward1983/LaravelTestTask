@extends('layouts.app')

@section('title_block')
    Api Test
@endsection

@section('content')
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Test Api</h3>
            </div>
        </header>

        <main class="px-3">
            <h1>To get data from the api</h1>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Click here</a>
            </p>
            <p id="result" class="lead">

            </p>
        </main>
    </div>
@endsection
