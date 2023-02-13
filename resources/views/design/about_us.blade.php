@extends('layouts.navbar')
@section('content')
    <!-- banner part star -->
    <div class="blog-banner">
        <div class="banner-overlay blog-banner-content" style="height: 400px">
            <h2 class="text-center">About US</h2>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="section-margin">
            <h2 class="section-title mb-4 fs-1 text-start">About</h2>
            <p class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id pellentesque
                congue habitant. Eu neque nibh faucibus
                proin dui. Eget ege tasollicitudin pharetra volutpat nulla varius eget. Pretium, consequat pellentesque
                adipiscing elit.
                Ut id pellentesque congue habitant. Eu neque nibh fau adiiscing elit. Ut id pellentesque congue
                habitant. Eu neque nibh
                fau adipiscing elit. Ut id pellentesque congue habitant. Eu neque nibh fau adipiscing elit. Ut id
                pellentesque congue
                habitant. Eu neque nibh fau adipiscing elit. Ut id pellentesque congue habitant. Eu neque nibh fau
                adipiscing elit. Ut
                id esque congue habitant. Eu neque nibh fauadipiscing elit. Ut id pellentesque congue habitant. Eu neque
                nibh fau
                adipiscing elit <br> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id pellentesque
                congue habitant. Eu neque nibh faucibus
                proin dui. Eget ege tasollicitudin pharetra volutpat nulla varius eget. Pretium, consequat pellentesque
                adipiscing elit.
                Ut id pellentesque congue habitant. Eu neque nibh fau adiiscing elit. Ut id pellentesque congue
                habitant. Eu neque nibh
                fau adipiscing elit. <br> <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id
                pellentesque congue habitant. Eu neque nibh faucibus
                proin dui. Eget ege tasollicitudin pharetra volutpat nulla varius eget. Pretium, consequat pellentesque
                adipiscing elit.
                Ut id pellentesque congue habitant. Eu neque nibh fau adiiscing elit. Ut id pellentesque congue
                habitant. Eu neque nibh
                fau adipiscing elit. Ut id pellentesque congue habitant. Eu neque nibh fau adipiscing elit. Ut id
                pellentesque congue
                habitant. Eu neque nibh fau adipiscing elit. Ut id pellentesque congue habitant. Eu neque nibh fau
                adipiscing elit. Ut
                id esque congue habitant. Eu neque nibh fauadipiscing elit. Ut id pellentesque congue habitant. Eu neque
                nibh fau
                adipiscing elit.

            </p>
        </div>

    </div>
@endsection
@push('scripts')
    {{-- @include('frontend.workshops.script-search-workshop') --}}
    @include('frontend.workshops.scripts.nearest-workshop-script')
@endpush
