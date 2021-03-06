<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::paginate(10);
        $breadCrumbs = [
            [
                'text' => 'Series',
                'active' => true
            ],
        ];
        return view('front.series.index', compact('series','breadCrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $series = Series::where('title',$title)->first();

        $breadCrumbs = [
            [
                'text' => 'Series',
                'href' => route('series.index')
            ],
            [
                'text' => $series->title,
                'active' => true
            ],
        ];

        return view('front.series.show', compact('series','breadCrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        //
    }

    public function episode($title, $episodeNumber)
    {
        $series = Series::where('title',$title)->first();
        $video= $series->videos()->where('episode_number',$episodeNumber)->first();
        $nextVideo= $series->videos()->where('episode_number',$episodeNumber+1)->first();

        $nextVideoUrl = $nextVideo->url ?? null;

        $breadCrumbs = [
            [
                'text' => 'Series',
                'href' => route('series.index')
            ],
            [
                'text' => $series->title,
                'href' => route('series.show',$series->title)
            ],
            [
                'text' => $video->episode_number . "_ " . $video->title,
                'active' => true
            ],
        ];

       return view('front.series.video', compact('series','episodeNumber','video','nextVideoUrl','breadCrumbs' ));
    }
}
