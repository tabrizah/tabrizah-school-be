<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Tampilkan semua kartu.
     */
    public function index()
    {
        // Ambil semua data kartu beserta user-nya
        $cards = Card::with('user')->get();
        return response()->json([
          'status' => 'success',
          'data' => $cards
      ]);
    }

    /**
     * Simpan data kartu baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
        ]);

        $card = Card::create([
            'user_id' => $request->user_id,
            // Tidak perlu mengisi 'card_uid', akan otomatis tergenerate
        ]);

        return response()->json([
            'message' => 'Card created successfully',
            'data' => $card,
        ], 201);
    }

    /**
     * Tampilkan detail kartu berdasarkan ID.
     */
    public function show($id)
    {
        $card = Card::with('user')->find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        return response()->json($card);
    }

    /**
     * Update data kartu.
     */
    public function update(Request $request, $id)
    {
        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'card_uid' => 'sometimes|unique:cards,card_uid,' . $id . '|max:100',
        ]);

        $card->update($request->only(['user_id', 'card_uid']));

        return response()->json([
            'message' => 'Card updated successfully',
            'data' => $card,
        ]);
    }

    /**
     * Hapus kartu.
     */
    public function destroy($id)
    {
        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Card not found'], 404);
        }

        $card->delete();

        return response()->json(['message' => 'Card deleted successfully']);
    }
}