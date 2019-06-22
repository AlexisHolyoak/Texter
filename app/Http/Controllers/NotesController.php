<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        $children=array();

        foreach ($notes as $note) {
            $tmp = array("text"=> $note->title,                          
                         "id" => $note->id,
                         "imageHtml" =>'<i class="material-icons">insert_drive_file</i>'
                        );
            array_push($children, $tmp);                  
        }
        
        $response = array(['text' => 'Archivos','id' => 0,'children'=>$children]);
        return json_encode($response);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load()
    {                
        return view('index');
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
        $note = new Note();
        
        $note->title = $request->title;

        if (is_null($request->content)){
            $note->content = "";
        }else{
            $note->content = $request->content;    
        }
        
        $note-> save();
        return $note->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $note = DB::table('notes')->where('id', $note->id)->first();
        return $note->content;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->title = $request -> title;
        $note->content = $request -> content;
        $note->save();
        return 'OK';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        
        return 'OK';
    }
    public function exportToRTF(){

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $html = '<h1>Adding element via HTML</h1>';;
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');      
        try {
            $objWriter->save(public_path('test'.'.docx'));
        } catch (Exception $th) {
            //throw $th;
        }
        
        return response()->download(public_path('test'.'.docx'));
    }
}
