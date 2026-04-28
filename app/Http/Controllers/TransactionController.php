<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "No transactions found",
                'data' => []
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "List of Transactions",
            'data' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                'data' => $validator->errors()
            ], 422);
        }

        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized",
                'data' => null
            ], 401);
        }

        // cek stok book
        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json([
                "success" => false,
                "message" => "Insufficient stock",
                'data' => null
            ], 400);
        }

        // hitung total harga
        $totalAmount = $book->price * $request->quantity;

        // kurangi stok book
        $book->stock -= $request->quantity;
        $book->save();

        // generate order number
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // simpan data
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            "success" => true,
            "message" => "Transaction created successfully",
            'data' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json([
            "success" => true,
            "message" => "Transaction detail",
            'data' => $transaction->load(['customer', 'book'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'sometimes|exists:books,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                'data' => $validator->errors()
            ], 422);
        }

        $bookId = $request->book_id ?? $transaction->book_id;
        $quantity = $request->quantity ?? $transaction->quantity;
        $book = Book::find($bookId);

        // jika quantity berubah, return stock
        if ($quantity !== $transaction->quantity) {
            $transaction->book()->first()->increment('stock', $transaction->quantity);

            // cek stok yang baru
            if ($book->stock < $quantity) {
                $transaction->book()->first()->decrement('stock', $transaction->quantity);
                return response()->json([
                    "success" => false,
                    "message" => "Insufficient stock",
                    'data' => null
                ], 400);
            }

            // kurangi stok baru
            $book->stock -= $quantity;
            $book->save();
        }

        // hitung total harga
        $totalAmount = $book->price * $quantity;

        // update data
        $transaction->update([
            'book_id' => $bookId,
            'quantity' => $quantity,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            "success" => true,
            "message" => "Transaction updated successfully",
            'data' => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // return stock
        $transaction->book()->first()->increment('stock', $transaction->quantity);

        // delete transaction
        $transaction->delete();

        return response()->json([
            "success" => true,
            "message" => "Transaction deleted successfully",
            'data' => null
        ]);
    }
}
