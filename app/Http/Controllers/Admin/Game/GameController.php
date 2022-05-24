<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $games = Game::all();

        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.games.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GameStoreRequest $request
     * @return RedirectResponse
     */
    public function store(GameStoreRequest $request): RedirectResponse
    {
        $game = new Game();
        $game->game = $request->game;
        $game->description = $request->description;
        $game->category_id = $request->category_id;
        $game->price = $request->price;
        $game->save();

        return to_route('games.index')->with('status', 'Games toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  Game  $game
     * @return View
     */
    public function show(Game $game): View
    {
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        $categories = Category::all();
        return view('admin.games.edit', compact('game', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GameUpdateRequest  $request
     * @param  Game  $game
     * @return RedirectResponse
     */
    public function update(GameUpdateRequest $request, Game $game): RedirectResponse
    {
        $game->game = $request->game;
        $game->description = $request->description;
        $game->category_id = $request->category_id;
        $game->price = $request->price;
        $game->save();

        return to_route('games.index')->with('status', 'Game gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game  $game
     * @return View
     */
    public function delete(Game $game): View
    {
        $categories = Category::all();
        return view('admin.games.delete', compact('game', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game  $game
     * @return RedirectResponse
     */
    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();
        return to_route('games.index')->with('status', 'Game verwijderd');
    }
}
