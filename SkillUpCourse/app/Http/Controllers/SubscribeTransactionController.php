<?php

namespace App\Http\Controllers;

use App\Models\SubscribeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeTransactionController extends Controller
{

    public function index()
    {
        $transactions = SubscribeTransaction::with(['user'])->orderByDesc('id')->get();
        return view('admin.transactions.index', compact('transactions'));
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
            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => Carbon::now()
            ]);
        });

        return redirect()->route('admin.subscribe_transactions.show', $subscribeTransaction);
    }


    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        //
    }
}
