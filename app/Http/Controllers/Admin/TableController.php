<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::orderBy('number','asc')->paginate(10);

        return view('admin.table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['table_code'] = 'MEJA-' . str_pad((string) $validatedData['number'], 3, '0', STR_PAD_LEFT);

        Table::create($validatedData);

        return redirect()->route('admin.table.index')->with('success', 'Table created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        return view('admin.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $validatedData = $request->validated();
        $validatedData['table_code'] = 'MEJA-' . str_pad((string) $validatedData['number'], 3, '0', STR_PAD_LEFT);

        $table->update($validatedData);

        return redirect()->route('admin.table.index')->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Table::where('id',$id)->delete();
        return redirect()->route('admin.table.index')->with('success', 'Table delete successfully.');
    }
}
