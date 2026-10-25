<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
  public function index()
  {
    $barbers = Barber::latest()->get();
    return view('admin.barbers.index', compact('barbers'));
  }

  public function create()
  {
    return view('admin.barbers.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    Barber::create($request->only('name'));

    return redirect()->route('admin.barbers.index')
      ->with('success', 'Kapster berhasil ditambahkan!');
  }

  public function edit(Barber $barber)
  {
    return view('admin.barbers.edit', compact('barber'));
  }

  public function update(Request $request, Barber $barber)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $barber->update($request->only('name'));

    return redirect()->route('admin.barbers.index')
      ->with('success', 'Kapster berhasil diperbarui!');
  }

  public function destroy(Barber $barber)
  {
    $barber->delete();

    return redirect()->route('admin.barbers.index')
      ->with('success', 'Kapster berhasil dihapus!');
  }
}
