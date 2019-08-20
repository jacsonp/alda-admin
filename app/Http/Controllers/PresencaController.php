<?php

namespace App\Http\Controllers;

use App\Diretoria;
use App\MembroNato;
use App\Presenca;
use Illuminate\Http\Request;
use App\Agenda;
use DB;

class PresencaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in files.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $presenca = new Presenca();
            $presenca->agenda_id = $request->agenda_id;
            $presenca->diretoria = array($request->diretoria);
            $presenca->membrosnato = array($request->membrosnato);
            $presenca->save();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo $e->getTrace();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in files.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from files.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findPresencaByAgendaId($agendaId)
    {
        $agenda = Agenda::find($agendaId);


        return response()->json(['membrosNatos' => MembroNato::whereIn('id', $agenda->presenca->membrosnato)->get(),
            'diretoria' => Diretoria::whereIn('id', $agenda->presenca->diretoria)->get()]);
    }

    public function findAllMembrosById($agendaId)
    {
        return response()->json(Agenda::find($agendaId)->membrosnatos);
    }
}
