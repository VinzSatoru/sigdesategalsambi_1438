<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function index()
    {
        $populations = Population::all();
        return view('admin.population.index', compact('populations'));
    }

    public function create()
    {
        return view('admin.population.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_name' => 'required',
            'total_population' => 'required|integer',
            'male_population' => 'required|integer',
            'female_population' => 'required|integer',
            'household_count' => 'required|integer',
        ]);

        Population::create($request->all());

        return redirect()->route('admin.population.index')->with('success', 'Data penduduk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $population = Population::findOrFail($id);
        return view('admin.population.edit', compact('population'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'region_name' => 'required',
            'total_population' => 'required|integer',
            'male_population' => 'required|integer',
            'female_population' => 'required|integer',
            'household_count' => 'required|integer',
        ]);

        $population = Population::findOrFail($id);
        $population->update($request->all());

        return redirect()->route('admin.population.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $population = Population::findOrFail($id);
        $population->delete();
        return redirect()->route('admin.population.index')->with('success', 'Data penduduk berhasil dihapus');
    }
}
