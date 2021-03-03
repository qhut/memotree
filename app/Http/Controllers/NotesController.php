<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;
use App\NotesChildren;
use Illuminate\Support\Facades\DB;



class NotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $notes = Note::all();
        $note = $notes->last();
        $note_menu = $this->createMenu();


        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.avatar, users.email");

        return view('notes.index')
            ->with('notes', $notes)
            ->with('note', $note)
            ->with('note_menu', $note_menu)
            ->with('users', $users);
    }

    public function show($id)
    {
        $note = Note::find($id);

        return view('notes.show')->with('note',  $note)->with('title', '');
    }

    public function create()
    {
        $note_menu = $this->createMenu();

        $notes = Note::all();

        return view('notes.create')->with('notes', $notes)->with('note_menu', $note_menu);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $father_id = $request->input('note_id');

        if(!isset($father_id))
        {
            $father_id = 0;
        }

        $level_note = $request->input('note_level');

        $level_note = isset($level_note) ?  $level_note += 1 : 0;

        $txt_note = $request->input('note_content');

        $note = new Note();
        $note->name = $request->input('note_name');
        $note->content = isset($txt_note) ? $txt_note : '';
        $note->level = $level_note;
        $note->save();
        $note->notesChildren()->create(['id'=> $note->id, 'father_id'=> $father_id]);
        $note->save();
        $last_id = Note::all()->last()->id;

        return redirect('/notes')->with('note_id', $last_id);
    }

    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit')->with('note',  $note)->with('title', '');
    }

    public function update(Request $request)
    {
        //$this->validate($request, [
        //  'note_name' => 'required'
        //]);

        $note_id   = $request->input('note_id');

        $note = Note::find($note_id);
        $note->name     = $request->input('note_name');
        $note->level    = 0;
        $note->content  = $request->input('note_content');
        $note->bookmark = 0;
        $note->save();

        $note = Note::find($note_id);
        $notes = Note::all();
        $note_menu = $this->createMenu();

        return View::make('notes.index')->with('note', $note)->with('note_menu', $note_menu)->with('notes', $notes);
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $noteChild = NotesChildren::find($id);
        $noteChild->delete();
        $note->delete();

        return redirect('/notes')->with('message', 'Категорията е изтрита');
    }

    public function createMenu()
    {
        $menu = array();
        $children = NotesChildren::all();
        $nodes = Note::all();

        foreach($children as $child){
            for($i = 0; $i < count($nodes); $i++){
                if($child->id == $nodes[$i]->id){
                    $parentId = $child->father_id == 0 ? null : $child->father_id;
                    $menu[$child->id] = array('text' => $nodes[$i]->name, 'parentID' => $parentId);
                }
            }
        }

        $addedAsChildren = array();

        foreach ($menu as $id => &$menuItem) { // note that we use a reference so we don't duplicate the array
            if (!empty($menuItem['parentID'])) {
                $addedAsChildren[] = $id;

                if (!isset($menu[$menuItem['parentID']]['children'])) {
                    $menu[$menuItem['parentID']]['children'] = array($id => &$menuItem);
                } else {
                    $menu[$menuItem['parentID']]['children'][$id] = &$menuItem;
                }
            }

            unset($menuItem['parentID']); // we don't need this any more
        }

        unset($menuItem); // unset the reference

        foreach ($addedAsChildren as $itemID) {
            unset($menu[$itemID]); // remove it from root so it's only in the ['children'] subarray
        }

        return $menu;
    }
}