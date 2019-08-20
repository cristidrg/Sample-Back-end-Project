@extends('layout')

@section('title', 'Org')

@section('content')
    <div>
        <h2 class="prop-page__type">Property</h2>
        <nav class="prop-page__breadcrumbs breadcrumb +icon +chevron">
            @if (isset($prop->org->parent->parent->parent))
                <a href={{"/org/".$prop->org->parent->parent->parent->id}}>{{$prop->org->parent->parent->parent->title}}</a>
            @endif
            @if (isset($prop->org->parent->parent))
                <a href={{"/org/".$prop->org->parent->parent->id}}>{{$prop->org->parent->parent->title}}</a>
            @endif
            @if (isset($prop->org->parent))
                <a href={{"/org/".$prop->org->parent->id}}>{{$prop->org->parent->title}}</a>
            @endif
            <a href={{"/org/".$prop->org->id}}>{{$prop->org->title}}</a>
        </nav>
    </div>
    <h1 class="prop-page__title">{{$prop->title}}</h1>
    <a href="#" class="prop-page__link">{{$prop->url}}</a>
    <div class="charts">
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="uptime"></canvas>
            </div>
            <label class="charts__label">Uptime</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="accessibility" data-score="{{$prop->a11yScore}}"></canvas>
            </div>
            <label class="charts__label">Accessibility</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="seo" data-score="{{$prop->seoScore}}"></canvas>
            </div>
            <label class="charts__label">SEO</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="performance" data-score="{{$prop->perfScore}}"></canvas>
            </div>
            <label class="charts__label">Performance</label>
        </div>
    </div>
    
    <div class="prop-page__legend">
        <div class="score-scale">
            <p class="score-scale__label">Score scale</p>
            <ol class="score-scale__ranges">
                <li class="score-scale__entry green">90-100</li>
                <li class="score-scale__entry orange">50-89</li>
                <li class="score-scale__entry red">0-49</li>
            </ol>
        </div>

        <a class="prop-page__lighthouse" href="#">Full Lighthouse Report</a>
    </div>
    <div class="prop-page__tab-wrapper bg-gray-800" role="tablist">
        <nav class="prop-page__tabs">
            <a class="prop-page__tab" href="#prop-info" data-tabs-group="prop-tabs">Information</a>
            <a class="prop-page__tab" href="#prop-tech" data-tabs-group="prop-tabs">Technology</a>
            <a class="prop-page__tab" href="#prop-contact" data-tabs-group="prop-tabs">Contact</a>
            <a class="prop-page__tab hidden-visi" href="#prop-contact2" data-tabs-group="prop-tabs">Contact</a>
        </nav>
        <div id="prop-info" class="prop-page__details">
            <p>INFO There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
        </div>
        <div id="prop-tech" class="prop-page__details">
            <p>TECH There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
        </div>
        <div id="prop-contact" class="prop-page__details">
            <p>CONTACT There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
        </div>
    </div>
@stop
