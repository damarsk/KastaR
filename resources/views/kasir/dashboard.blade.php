@extends('layouts.app')
@section('title', 'KastaR - Dashboard')
@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <h2>👋 Halo, {{ Auth::user()->name }}!</h2>
            
        </div>
    </main>
@endsection
