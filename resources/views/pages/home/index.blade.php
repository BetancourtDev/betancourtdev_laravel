@extends('layouts.public')

@section('title', $seo['title'])
@section('meta_description', $seo['description'])

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
  <div class="gradient-bg"></div>

  @include('pages.home.sections.hero', [
    'hero'   => $landing['hero'],
    'phone'  => $brand['whatsapp_phone'],
    'waText' => $brand['whatsapp_texts']['long'],
  ])

  @include('pages.home.sections.about', [
    'about'       => $landing['about'],
    'values'      => $landing['values'],
    'phone'       => $brand['whatsapp_phone'],
    'waTextBrief' => $brand['whatsapp_texts']['brief'],
  ])

{{-- Stack / Recruiter-facing section --}}
  @include('pages.home.sections.stack', [
    'stack'  => $landing['stack'],
    'brand'  => $brand,
    'profile'=> $profile,
  ])

  @include('pages.home.sections.services', [
    'services' => $landing['services'],
    'phone'    => $brand['whatsapp_phone'],
  ])

  @include('pages.home.sections.process', [
    'process'     => $landing['process'],
    'phone'       => $brand['whatsapp_phone'],
    'waTextBrief' => $brand['whatsapp_texts']['brief'],
  ])

  @include('pages.home.sections.testimonials', [
    'testimonials' => $landing['testimonials'],
  ])

  @include('pages.home.sections.faq', [
    'faqs' => $landing['faqs'],
  ])

  @include('pages.home.sections.contact', [
    'phone'  => $brand['whatsapp_phone'],
    'waText' => $brand['whatsapp_texts']['long'],
  ])
@endsection
