<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\SubscribeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubscribeTransactionController extends Controller
{

    public function index(Request $request)
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');

        // Ambil parameter pencarian
        $search = $request->input('search');

        // Buat query dasar
        $query = SubscribeTransaction::with(['user'])->orderByDesc('id');

        // Jika ada parameter pencarian, tambahkan kondisi pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('total_amount', 'like', '%' . $search . '%')
                    ->orWhere('is_paid', 'like', '%' . $search . '%');
            });
        }

        // Paginate hasil query
        $transactions = $query->paginate(4);

        // Return view dengan data yang diperlukane
        return view('admin.transactions.index', compact('transactions', 'successMessage', 'errorMessage'));
    }




    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    }


    public function show(SubscribeTransaction $subscribeTransaction)
    {
        return view('admin.transactions.show', compact('subscribeTransaction'));
    }

    public function edit(SubscribeTransaction $subscribeTransaction)
    {
        //
    }


    public function update(Request $request, SubscribeTransaction $subscribeTransaction)
    {
        DB::transaction(function () use ($subscribeTransaction) {
            $currentDateTime = Carbon::now();
            $startDate = $currentDateTime->copy();
            $endDate = $currentDateTime->copy()->addYear();
            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => $startDate,
                'subscription_end_date' => $endDate
            ]);

            Notification::create([
                'user_id' => $subscribeTransaction->user_id,
                'message' => 'Pembayaran Anda telah diterima',
                'status' => 'unread',
            ]);
        });

        return redirect()->route('admin.subscribe_transactions.show', $subscribeTransaction);
    }


    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        //
    }
}
