<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::paginate(15);
        return view("admin.categories.index" , ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categorieName' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:30'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

    
        Categorie::create($validator->validated());
        return response()->json(["success" => "Added Successfuly"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $categorie)
    {
        $categorie = Categorie::find($categorie);
        if (!$categorie) {
            abort(404); 
        }
        return view("admin.categories.edit" , ["categorie" => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $categorie)
    {
        $categorie = Categorie::find($categorie);
        if (!$categorie) {
            abort(404); 
        }
        // return $categorie;
        $fields = $request->validate([
            "categorieName" => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:30'],
        ]);
        $categorie->update([
            "categorieName" => $fields["categorieName"]
        ]);
        return to_route("categories.index")->with("success" , "Updated Successfuly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $categorie)
    {
        $categorie = Categorie::find($categorie);
        if (!$categorie) {
            abort(404); 
        }
        $categorie->delete();
        return response()->json(["deleted" => "Deleted Successfuly"]);
    }
}
