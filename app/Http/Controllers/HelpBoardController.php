<?php

namespace App\Http\Controllers;

use App\Models\HelpBoard;

class HelpBoardController extends Controller
{
    public function index()
    {
        $helpBoards = HelpBoard::all();
        return view('helpboard.index', compact('helpBoards'));
    }
}
