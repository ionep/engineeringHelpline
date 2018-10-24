<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;

class PagesController extends Controller
{
    public function index(){
        $texts=array(
            'title' => 'About Us',
            'titleInfo' => 'We help engineering students do better in their life by providing them a platform.
                            We help them understand and get the basic knowledge of subject matter.',
            'services1' => ['Syllabus of all Semester', 'Notes of all semester', 'Student Community'],
            'services2' => ['Lab Reports', 'Field Reports', 'Technical Articles'],
            'twitter' => 'https://twitter.com/helpengineer',
            'facebook' => 'https://facebook.com/engineeriinghelpline/',
            'instagram' => 'https://www.instagram.com/engineeringhelpline/'
        );
        //return view('pages.index', compact('title'));
        if(Auth::guest())
        {
            return view('pages.index')->with($texts);
        }
        else{
            return redirect('dashboard');
        }
    }

    public function about(){
        $title='About Us';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        return view('pages.services');
    }

    public function whytojoin(){
        return view('pages.whytojoin');
    }

    public function mission(){
        return view('pages.mission');
    }
    
    public function privacypolicy()
    {
        return view('pages.privacypolicy');
    }
}
