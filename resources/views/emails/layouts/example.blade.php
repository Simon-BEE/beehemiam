@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bienvenue, {{ $name }} !</h1>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ex itaque quod pariatur, iste dolorum aut atque et porro, nesciunt dolor, eaque ab eum inventore corrupti! Deserunt quaerat consequatur est officiis nisi animi consequuntur tenetur odit blanditiis, ut vitae quasi, error, itaque optio? Reiciendis blanditiis ea distinctio nam, consectetur laborum. Nesciunt debitis dolores inventore dolore veritatis reprehenderit repudiandae sequi, beatae error aliquid natus ab et minus! Officia est cupiditate dolorem. Facilis illum officiis omnis quae cupiditate quidem vero, maiores tempore aliquam eum accusamus perferendis deleniti corrupti, incidunt aliquid? Eius praesentium tenetur commodi ipsa distinctio ad minus facilis cumque.</p>

    <!-- BUTTON -->
    @include('emails.layouts.button', ['link' => '/', 'text' => 'Button'])
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ex itaque quod pariatur, iste dolorum aut atque et porro, nesciunt dolor, eaque ab eum inventore corrupti! Deserunt quaerat consequatur est officiis nisi animi consequuntur tenetur odit blanditiis, ut vitae quasi, error, itaque optio? Reiciendis blanditiis ea distinctio nam, consectetur laborum. Nesciunt debitis dolores inventore dolore veritatis reprehenderit repudiandae sequi, beatae error aliquid natus ab et minus! Officia est cupiditate dolorem. Facilis illum officiis omnis quae cupiditate quidem vero, maiores tempore aliquam eum accusamus perferendis deleniti corrupti, incidunt aliquid? Eius praesentium tenetur commodi ipsa distinctio ad minus facilis cumque.</p>
    
    <!-- COMPONENT -->
    @include('emails.layouts.component', ['text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ex itaque quod pariatur.'])
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ex itaque quod pariatur, iste dolorum aut atque et porro, nesciunt dolor, eaque ab eum inventore corrupti! Deserunt quaerat consequatur est officiis nisi animi consequuntur tenetur odit blanditiis, ut vitae quasi, error, itaque optio? Reiciendis blanditiis ea distinctio nam, consectetur laborum. Nesciunt debitis dolores inventore dolore veritatis reprehenderit repudiandae sequi, beatae error aliquid natus ab et minus! Officia est cupiditate dolorem. Facilis illum officiis omnis quae cupiditate quidem vero, maiores tempore aliquam eum accusamus perferendis deleniti corrupti, incidunt aliquid? Eius praesentium tenetur commodi ipsa distinctio ad minus facilis cumque.</p>
    
    <!-- RESERVE LINK -->
    @include('emails.layouts.reserve-link', ['link' => '/', 'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam ex itaque quod pariatur.'])

    <!-- UNSUBSCRIBE LINK -->
    @include('emails.layouts.unsubscribe-link', ['link' => '/'])
@endsection