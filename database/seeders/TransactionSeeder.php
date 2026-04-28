<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'order_number' => 'ORD-0001',
            'customer_id' => 2, // Assuming this is the ID of the customer user
            'book_id' => 1, // Assuming this is the ID of a book
            'quantity' => 1,
            'total_amount' => 50000.00
        ]);
        Transaction::create([
            'order_number' => 'ORD-0002',
            'customer_id' => 2, // Assuming this is the ID of the customer user
            'book_id' => 2, // Assuming this is the ID of another book
            'quantity' => 1,
            'total_amount' => 20000.00
        ]);

        Transaction::create([
            'order_number' => 'ORD-0003',
            'customer_id' => 2, // Assuming this is the ID of the customer user
            'book_id' => 3, // Assuming this is the ID of another book
            'quantity' => 1,
            'total_amount' => 30000.00
        ]);
    }
}
