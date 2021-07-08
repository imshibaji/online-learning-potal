@extends('larnr::layouts.master')


@section('title', 'About Us | Larnr Education')
@section('keywords', 'about us, about larnr, why larnr, Larnr Courses, Larnr tutorials.')
@section('description', 'We are helping to Student with best courses. also helps educator to grow there community with us.')
@section('og_url', url('about'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 style="margin-top: 10px;">Why Lernr?</h1>
            <p>Welcome to Larnr Education.</p>

            <p>At Larnr we aim to become India's largest on-demand learning platform for skills.
                We envision that talents and tutors from all over India get a platform through
                which they can spread their knowledge and make a career out of digital course creation.
                For students, our focus is providing them with the highest quality learning
                material at a fraction of cost, and complete ease of learning.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h1>Larnr Mission & Core Values</h1>
        </div>
        <div class="col-md-4">
            <img width="100%" height="200px" alt="Co Working Space" src="https://coworker.imgix.net/photos/india/mumbai/devx-andheri-mumbai/5-1622268829.jpg?w=1200&h=0&q=90&auto=format,compress&fit=crop&mark=/template/img/wm_icon.png&markscale=5&markalign=center,middle" />
        </div>
        <div class="col-md-4">
            <img width="100%" height="200px" alt="Co Working Space" src="https://inc42.com/wp-content/uploads/2019/11/coworking-future-india.jpg" />
        </div>
        <div class="col-md-4">
            <img width="100%" height="200px" alt="Co Working Space" src="https://media.smallbiztrends.com/2019/06/Co-working-spaces.png" />
        </div>
    </div>

    <div class="row py-5">
        <div class="col-md-6 px-3">
            <h3>For Students</h3>
            <ul class="text-justify">
                <li>To provide affordable learning to students from all financial backgrounds</li>
                <li>To provide education in languages convenient to students from all regions</li>
                <li>To provide skills that helps upgrade and uplift learners intellectually and financially</li>
                <li>To generate confidence in learners and generate a sense of achievement that brings positivity in their lives</li>
                <li>To help generate employment opportunities for students</li>
                <li>To opt only for accurate and honest marketing strategies</li>
            </ul>
        </div>
        <div class="col-md-6 px-3">
            <h3>For Tutors</h3>
            <ul class="text-justify">
                <li>To give an opportunity to ALL creators of any age and background to showcase and spread their knowledge.</li>
                <li>To give an opportunity for creators to uplift themselves financially</li>
                <li>To develop the spirit of entrepreneurship amongst creators that further creates employment</li>
                <li>To allow the creators to create a legacy of their knowledge and skill base</li>
                <li>To promote creators and help them receive the recognition their work deserves</li>
            </ul>
        </div>
    </div>
</div>
@endsection
